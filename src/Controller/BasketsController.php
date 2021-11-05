<?php

namespace App\Controller;

use App\Controller\AppController;

class BasketsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		$room =  $this->loadModel('Rooms');
		$booking = $this->loadModel('Bookings');
		$basket = $this->loadModel('Baskets');
		
	}

	public function index()
	{
		$user = $this->request->getAttribute('identity');
		$redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

	 	if ($user == null)
		{
			$this->Flash->error(__('You need to log in to view your basket'));
        	$this->redirect($redirect);
		}
		else
		{
			$basketItems = $this->Baskets->find()->where(['user_id' => $user->id])->contain(['BookingItems']);	
			foreach ($bookings as $booking)
			{
				debug($booking);
			}
			$this->set(['user'=> $user, 'basketItems' => $basketItems]);

		}
	}
}