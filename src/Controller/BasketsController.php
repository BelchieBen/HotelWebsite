<?php

namespace App\Controller;

use App\Controller\AppController;

class BasketsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

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
		$basketItem = $this->BasketItems->get($id);

    	if ($this->request->is(['post','put']))
    	{

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
		$booking = $this->Bookings->newEmptyEntity();
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
			debug($item);
			foreach ($item as $i) 
			{
				$room = $this->Rooms->find()->where(['roon_id' => $i->room_id]); 
				$room = $room->toArray();
				foreach ($room as $r) 
				{
					$booking->hotel_id = $r->hotel_id;
					$booking->room_id = $i->room_id;
					$booking->user_id = $user->id;
					$booking->booking_start = $i->start_date;
					$booking->booking_end = $i->end_date;
					$booking->total = $i->total;
					debug($booking);
					$this->Bookings->save($booking);
				}
			}
			
		}

		
	}
}