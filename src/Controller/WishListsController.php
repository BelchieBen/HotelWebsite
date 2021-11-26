<?php

namespace App\Controller;

use App\Controller\AppController;

class WishlistsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		// Loading the required data model
		$room =  $this->loadModel('Rooms');
		$wishlist = $this->loadModel('WishLists');
		$wishlistitems = $this->loadModel('WishListItems');
		$basketItems = $this->loadModel('BasketItems');
		$booking = $this->loadModel('Bookings');
		$hotel = $this->loadModel('Hotels');
		
	}

	public function index()
	{
		$user = $this->request->getAttribute('identity');
		$redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

		// If no user is logged in, redirect them and show an error
	 	if (is_null($user))
		{
			$this->Flash->error(__('You need to log in to view your wish list'));
        	$this->redirect($redirect);
		}
		else
		{
			// Check if the user has a wish list
			$userWishList =  $this->WishLists->find()->where(['user_id' => $user->id]);
			$userWishList = $userWishList->first();

			if (is_null($userWishList))
	    	{
	    		// Create a new wishlist if the user doesnt have one
	    		$userWishList = $this->WishLists->newEmptyEntity();
	    		$userWishList->user_id = $user->id;
	    		$this->WishLists->save($userWishList);
	    	}

	    	// Getting that new wish list or their existing one
	    	$wishList = $this->WishLists->find()->where(['user_id' => $user->id])->contain(['WishListItems']);	

			// Adding the wish list items to an array
			$items = [];
			foreach($wishList as $wishListItems)
			{
				array_push($items, $wishListItems->wish_list_items);
			}

			// Finding all the rooms in the users wish list and adding them to an array
			$hotels = [];
			foreach ($items as $item)
			{
				foreach ($item as $i)
				{
					$hotel = $this->Hotels->find()->where(['id' => $i->hotel_id]);
					$hotel = $hotel->toArray();

					$item_id = $i->item_id;

					$customArr = [];
					foreach ($hotel as $h) 
					{
						// Creating a custom array to easily display data on the webpage
						$customArr += [
							"item_id" => $item_id,
							"hotel_id" => $h->id,
							"hotel_name" => $h->hotel_name, 
							"hotel_contact" => $h->contact_number,
							"description" => $h->description,
							"hotel_img" => $h->hotel_img,
							"tags" => $h->tags,
						];
					}
					array_push($hotels, $customArr);
				}
			}
			$this->set(['user'=> $user, 'hotels' => $hotels]);

		}
	}

	public function add($id=null)
	{
		$user = $this->request->getAttribute('identity');
		$hotel = $this->Hotels->get($id);

		// Check if the user has a wish list
		$userWishList =  $this->WishLists->find()->where(['user_id' => $user->id]);
		$userWishList = $userWishList->first();

		if (is_null($userWishList))
    	{
    		// Creating a wishlist if the user doesnt have one
    		$userWishList = $this->WishLists->newEmptyEntity();
    		$userWishList->user_id = $user->id;
    		$this->WishLists->save($userWishList);
    	}

		$wishList = $this->WishLists->find()->where(['user_id' => $user->id]);
		$wishList = $wishList->first();

		// Creating the wishlist & adding the requested hotel to that list
		$wishListItem = $this->WishListItems->newEmptyEntity();
		$wishListItem->hotel_id = $hotel->id;
		$wishListItem->wish_list_id = $wishList->wish_list_id;

		if ($this->WishListItems->save($wishListItem))
		{
			$this->Flash->success("You have added an item to your wish list");
			return $this->redirect(['action' => 'index']);
		}
	}

	public function remove($id=null)
	{
		$wishListItem = $this->WishListItems->get($id);

    	if ($this->request->is(['post','put']))
    	{

    		if ($this->WishListItems->delete($wishListItem))
    		{
    			$this->Flash->success("You have removed an item from your wish list");
    			return $this->redirect(['action' => 'index']);
    		}
    		$this->Flash->error("Unable to remove that item");
    	}
    	$this->set('wishListItem', $wishListItem);
	}
}