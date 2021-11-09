<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class AdminController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		$redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

		if ($this->request->getAttribute('identity')['role'] != 'admin')
		{
			$this->Flash->error(__('You are not authorized to visit this page'));
        	$this->redirect($redirect);
		}

		$hotel =  $this->loadModel('Hotels');
		$room =  $this->loadModel('Rooms');
		$booking =  $this->loadModel('Bookings');
		$user = $this->request->getAttribute('identity');
		$this->set(compact('user'));
	}

	public function index()
	{
		$hotels = $this->Paginator->paginate($this->Hotels->find());
		$bookings = $this->Paginator->paginate($this->Bookings->find()->contain(['Hotels', 'Rooms']));
		$rooms = $this->Paginator->paginate($this->Rooms->find()->contain(['Hotels']));
		$this->set(['hotels' => $hotels, 'rooms' => $rooms, 'bookings' => $bookings]);
	}
}