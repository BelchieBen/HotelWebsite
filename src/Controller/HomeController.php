<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class HomeController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

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