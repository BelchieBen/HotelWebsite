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
		$user = $this->request->getAttribute('identity');
		$this->set(compact('user'));
	}

	public function index()
	{
		$hotels = $this->Paginator->paginate($this->Hotels->find());
		$this->set(compact('hotels'));
	}
}