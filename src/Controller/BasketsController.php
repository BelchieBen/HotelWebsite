<?php

namespace App\Controller;

use App\Controller\AppController;

class BasketsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		// Loading required database models
		$room =  $this->loadModel('Rooms');
		$basket = $this->loadModel('Baskets');
		$basketItems = $this->loadModel('BasketItems');
		$booking = $this->loadModel('Bookings');
		
	}

	public function index()
	{
		$user = $this->request->getAttribute('identity');
		$redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

		// Validation to ensure a user is logged in to view their basket, this prevents database errors
	 	if (is_null($user))
		{
			$this->Flash->error(__('You need to log in to view your basket'));
        	$this->redirect($redirect);
		}
		else
		{
			// Find the users basket
			$basket = $this->Baskets->find()->where(['user_id' => $user->id])->contain(['BasketItems']);	
			$basket = $basket->toArray();

			// Adding the basket items to an array
			$items = [];
			foreach($basket as $basketItems)
			{
				array_push($items, $basketItems->basket_items);
			}

			// Finding all the rooms in the users basket and adding them to an array
			$rooms = [];
			foreach ($items as $item)
			{
				foreach ($item as $i)
				{
					$room = $this->Rooms->find()->where(['roon_id' => $i->room_id]);
					$room = $room->toArray();

					$item_id = $i->item_id;
					
					$from = $i->start_date;
					$to = $i->end_date;

					$total = $i->total;

					$customArr = [];
					foreach ($room as $r) 
					{
						// Creating a custom array to pass to view file, making it easier to display the data
						$customArr += [
							"item_id" => $item_id,
							"roon_id" => $r->roon_id, 
							"roon_number" => $r->roon_number,
							"room_category" => $r->room_category,
							"rate" => $r->rate,
							"room_img" => $r->room_img,
							"hotel_id" => $r->hotel_id,
							"from" => $from->format("d/m/Y"),
							"to" => $to->format("d/m/Y"),
							"total" => $total,
						];
					}
					array_push($rooms, $customArr);
				}
			}
			$this->set(['user'=> $user, 'rooms' => $rooms]);

		}
	}

	public function remove($id=null)
	{
		// Get the users backet item from the id passed in from the URL paramaters
		$basketItem = $this->BasketItems->get($id);

    	if ($this->request->is(['post','put']))
    	{
    		// The delete function returns a bool value so if deletion is successful redirect & show notification
    		if ($this->BasketItems->delete($basketItem))
    		{
    			$this->Flash->success("You have removed an item from your basket");
    			return $this->redirect(['action' => 'index']);
    		}
    		$this->Flash->error("Unable to remove that item");
    	}
    	$this->set('basketItem', $basketItem);
	}

	public function checkout()
	{
		$user = $this->request->getAttribute('identity');

		// Getting the users basket
		$basket = $this->Baskets->find()->where(['user_id' => $user->id])->contain(['BasketItems']);
		$basket = $basket->toArray();

		$items = [];
		foreach($basket as $basketItems)
		{
			array_push($items, $basketItems->basket_items);
		}

		foreach ($items as $item) 
		{
			foreach ($item as $i) 
			{
				// Creating the booking 
				$booking = $this->Bookings->newEmptyEntity();
				$booking->booking_id = uniqid();
				$booking->hotel_id = $i->hotel_id;
				$booking->room_id = $i->room_id;
				$booking->user_id = $user->id;
				$booking->booking_start = $i->start_date;
				$booking->booking_end = $i->end_date;
				$booking->total = $i->total;
				if($this->Bookings->save($booking))
				{
					// Removing the item after checkout
					$this->BasketItems->delete($i);
				}
				else
				{
					$this->Flash->error("Unable to checkout");
				}	
			}
		}
	}
}