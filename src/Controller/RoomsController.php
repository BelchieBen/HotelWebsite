<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class RoomsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		$hotel =  $this->loadModel('Hotels');
	}

	public function index()
	{
	}

	public function add()
	 {
	 	$redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

	 	// Checking if the user is an admin, this function is for admins only. If the user isnt an admin they will be redirected and shown an error
	 	if ($this->request->getAttribute('identity')['role'] != 'admin')
		{
			$this->Flash->error(__('You are not authorized to visit this page'));
        	$this->redirect($redirect);
		}
		else
		{
			// Creating a new hotel object
			$hotel = $this->Hotels->newEmptyEntity();

			$categories = [];
			$categories += [
				"Single" => "Single",
				"Double" => "Double",
				"King" => "King",
				"Family" => "Family"
			];

			// Getting a list of hotel names to use in select input
			$hotels = $this->Rooms->Hotels->find();
			$hotels = $hotels->toArray();
			$hotelNames = [];
			foreach ($hotels as $hotel) 
			{
				$hotelNames += [$hotel->id => $hotel->hotel_name];
			}

			$room = $this->Rooms->newEmptyEntity();

		 	if ($this->request->is('post'))
		 	{
		 		// Getting all the form data
		 		$formData = $this->request->getData();
		 
		 		// Getting the from files
		 		$roomImg = $this->request->getUploadedFiles();

		 		// Making an array for all the filenames
		 		$roomImages = array();
		 		
		 		// Looping through associative array to access file objects
		 		foreach ($roomImg as $img)
		 		{
		 			// Looping through file objects to get thier filenames
		 			foreach ($img as $i)
		 			{
			 			$imgName = $i->getClientFilename();
			 			array_push($roomImages, $imgName);		
		 			}
		 		}

		 		$roomImages = implode(",",$roomImages);

		 		// If there are no images uploaded leave hotel_img column empty
		 		if (empty($roomImages))
		 		{
		 			$formData['room_img'] = $imgName;
		 			$room = $this->Rooms->patchEntity($room, $formData);
		 			$room['room_category'] = $formData['room_category'];
		 		}
		 		else
		 		{	
		 			// Looping through associative array to access file objects 
		 			foreach ($roomImg as $name)
		 			{
		 				foreach ($name as $id => $item)
		 				{
		 					$targetPath = WWW_ROOT. 'img'. DS . 'Rooms'. DS. $item->getClientFilename();
			 				$item->moveTo($targetPath);
		 				}
		 			}

		 			// Applying the image name to the form data
			 		$formData['room_img'] = $roomImages;

			 		//debug($formData);
			 		
			 		// Filling the enity with the form data
			 		$room = $this->Rooms->patchEntity($room, $formData);
			 		$room['room_category'] = $formData['room_category'];
		 		}

		 		if ($this->Rooms->save($room))
		 		{
		 			$this->Flash->success(__('Room: '.$room->roon_number.' has been added.'));
	                return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
		 		}
		 		$this->Flash->error(__('Unable to save room '.$room->room_number.'.'));
		 	}
		 	$this->set(['room'=> $room, 'hotelNames' => $hotelNames, 'categories' => $categories]);
		}

	 	
	 }

	public function view($hotel_id=null)
    {
    	$hotel = $this->Hotels->get($hotel_id);
        $room = $this->Rooms->get($id);
        $this->set(compact('room'));
    }

    public function update($id=null)
    {
    	$room = $this->Rooms->get($id);

    	if ($this->request->is(['post','put']))
	 	{	
	 		// Getting all the form data
	 		$formData = $this->request->getData();

	 		// Getting the from files
	 		$roomImg = $this->request->getUploadedFiles();

	 		// Making an array for all the filenames
	 		$roomImages = array();
	 		
	 		// Looping through associative array to access file objects
	 		foreach ($roomImg as $img)
	 		{
	 			// Looping through file objects to get thier filenames
	 			foreach ($img as $i)
	 			{
		 			$imgName = $i->getClientFilename();
		 			array_push($roomImages, $imgName);		
	 			}
	 		}

	 		$roomImages = implode(",",$roomImages);

	 		// If there are no images uploaded leave hotel_img column empty
	 		if (empty($roomImages))
	 		{
	 			// Manually updating attributes to preserve image name in database
	 			$room->room_number = $this->request->getData('room_number');
	 			$room->room_category = $this->request->getData('room_category');
	 			$room->rate = $this->request->getData('rate');
	 		}
	 		else
	 		{
	 			// Looping through associative array to access file objects 
	 			foreach ($roomImg as $name)
	 			{
	 				foreach ($name as $id => $item)
	 				{
	 					$targetPath = WWW_ROOT. 'img'. DS . 'Rooms'. DS. $item->getClientFilename();
		 				$item->moveTo($targetPath);
	 				}
	 			}

	 			// Applying the image name to the form data
		 		$formData['room_img'] = $roomImages;
		 		
		 		// Filling the enity with the form data
		 		$room = $this->Rooms->patchEntity($room, $formData);
		 		$room->room_category = $this->request->getData('room_category');
	 		}
	 		
	 		if ($this->Rooms->save($room))
	 		{
	 			$this->Flash->success(__('You have updated room: '.$room->roon_number.'.'));
                return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
	 		}
	 		$this->Flash->error(__('Unable to save room '.$room->roon_number.'.'));
	 	}
	 	$this->set('room', $room);

    }

    public function delete($id=null)
    {
    	$room = $this->Rooms->get($id);

    	if ($this->request->is(['post','put']))
    	{
    		if ($this->Rooms->delete($room))
    		{
    			$this->Flash->success($room->room_number." has been deleted");
    			return $this->redirect(['controller' => 'admin', 'action' => 'index']);
    		}
    		$this->Flash->error("Unable to delete ".$room->room_number);
    	}
    	$this->set('room', $room);
    }
}