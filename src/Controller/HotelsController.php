<?php

namespace App\Controller;

use App\Controller\AppController;
use DateTime;
use DatePeriod;
use DateInterval;

class HotelsController extends AppController
{
	public function initialize():void
	{
		parent::initialize();

		$room =  $this->loadModel('Rooms');
		$booking = $this->loadModel('Bookings');
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

	 	if ($this->request->getAttribute('identity')['role'] != 'admin')
		{
			$this->Flash->error(__('You are not authorized to visit this page'));
        	$this->redirect($redirect);
		}
		else
		{
			$hotel = $this->Hotels->newEmptyEntity();
		 	if ($this->request->is('post'))
		 	{
		 		// Getting all the form data
		 		$formData = $this->request->getData();

		 		// Getting the from files
		 		$hotelImg = $this->request->getUploadedFiles();

		 		// Making an array for all the filenames
		 		$hotelImages = array();
		 		
		 		// Looping through associative array to access file objects
		 		foreach ($hotelImg as $img)
		 		{
		 			// Looping through file objects to get thier filenames
		 			foreach ($img as $i)
		 			{
			 			$imgName = $i->getClientFilename();
			 			array_push($hotelImages, $imgName);		
		 			}
		 		}

		 		$hotelImages = implode(",",$hotelImages);

		 		// If there are no images uploaded leave hotel_img column empty
		 		if (empty($hotelImages))
		 		{
		 			$formData['hotel_img'] = $imgName;
		 			$hotel = $this->Hotels->patchEntity($hotel, $formData);
		 		}
		 		else
		 		{	
		 			// Looping through associative array to access file objects 
		 			foreach ($hotelImg as $name)
		 			{
		 				foreach ($name as $id => $item)
		 				{
		 					$targetPath = WWW_ROOT. 'img'. DS . 'Hotels'. DS. $item->getClientFilename();
			 				$item->moveTo($targetPath);
		 				}
		 			}

		 			// Applying the image name to the form data
			 		$formData['hotel_img'] = $hotelImages;

			 		//debug($formData);
			 		
			 		// Filling the enity with the form data
			 		$hotel = $this->Hotels->patchEntity($hotel, $formData);
		 		}

		 		if ($this->Hotels->save($hotel))
		 		{
		 			$this->Flash->success(__('The hotel has been added.'));
	                return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
		 		}
		 		$this->Flash->error(__('Unable to save that hotel.'));
         
                $this->Flash->error("Error with file upload");
		 	}
		 	$this->set('hotel', $hotel);
		}

	 	
	 }

	public function view($id=null)
    {
        $hotel = $this->Hotels->get($id);
        $rooms = $this->Rooms->find()->where(['hotel_id' => $id])->contain(['Bookings']);

		// Getting all rooms at the hotel user is viewing

		// $roomBookingArr = []; 
		// $roomBookings = [];
		
		$datesRoomBooked = [];

        foreach ($rooms as $room)
        {
        	$newRoomBookings = [];
        	$roomObj = $room->bookings;
        	foreach ($room->bookings as $roomBooks)
        	{
        		$roomDates = [];
        		$interval = new DateInterval('P1D');
        		$roomDateR = new DatePeriod($roomBooks->booking_start, $interval, $roomBooks->booking_end);
        		foreach ($roomDateR as $date)
        		{
        			array_push($roomDates, $date->format("d/m/Y"));	
        		}
        		$newRoomBookings +=["Booking ".$roomBooks->booking_id => $roomDates];
        	}

        	$datesRoomBooked += [$room->roon_number => $newRoomBookings];
        }

        // Getting an array of dates between 
        if ($this->request->is('ajax'))
		{	
			// Getting Data from Ajax request
			$selectedDates =$this->request->getData();
			$dates = $selectedDates['datesUserSelected'];
			$dates = str_replace(['[',']','"'], '', $dates);

			// Putting that data into an array
			$newDates = [];
			$d = explode(",", $dates);
			foreach ($d as $date)
			{
				array_push($newDates, $date);
			}

			$fromDate = $newDates[0];
			$toDate = end($newDates);

			echo("<h3>Available Rooms</h3><hr>");
			echo("<div class='row'>");

			// Comparing users date selection to all rooms booking dates to determine what rooms are available
			foreach ($datesRoomBooked as $room => $bookings) 
			{
				foreach ($bookings as $bookedDates) 
				{
					$compareArrays = array_diff($newDates, $bookedDates);
					if($newDates != $compareArrays)
					{
						// Room unavailable
					}
					else
					{
						// Room available
						$rooms = $this->Rooms->find()->where(['roon_number' => $room]);
							foreach ($rooms as $room) 
							{
								echo (
									"<div class='col1'>
										<img src='/HotelWebsite/img/Rooms/$room->room_img' class='roomImg' />
										<br>
										<b>Room</b> $room->roon_number <br>
										<b>Room Type:</b> $room->room_category <br><br>
										<form method='post' action='/HotelWebsite/hotels/book/$room->roon_id'>
											<button type='submit' class='bookBtn'>Book</button>
											<input type='hidden' name='fromDate' value='$fromDate' />
											<input type='hidden' name='toDate' value='$toDate' />
										</form>
									</div>");
							}
					}
				}
			}
			echo("</div>");
			$this->set('rooms', $rooms);
			exit;
		}	

        $this->set(compact('hotel'));
    }

    public function update($id=null)
    {
    	$hotel = $this->Hotels->get($id);

    	if ($this->request->is(['post','put']))
	 	{	
	 		// Getting all the form data
	 		$formData = $this->request->getData();

	 		// Getting the from files
	 		$hotelImg = $this->request->getUploadedFiles();

	 		// Making an array for all the filenames
	 		$hotelImages = array();
	 		
	 		// Looping through associative array to access file objects
	 		foreach ($hotelImg as $img)
	 		{
	 			// Looping through file objects to get thier filenames
	 			foreach ($img as $i)
	 			{
		 			$imgName = $i->getClientFilename();
		 			array_push($hotelImages, $imgName);		
	 			}
	 		}

	 		$hotelImages = implode(",",$hotelImages);

	 		// If there are no images uploaded leave hotel_img column empty
	 		if (empty($hotelImages))
	 		{
	 			// Manually updating attributes to preserve image name in database
	 			$hotel->hotel_name = $this->request->getData('hotel_name');
	 			$hotel->description = $this->request->getData('description');
	 			$hotel->tags = $this->request->getData('tags');
	 			debug($hotel->tags);
	 			$hotel->contact_number = $this->request->getData('contact_number');
	 			debug($hotel);
	 		}
	 		else
	 		{
	 			// Looping through associative array to access file objects 
	 			foreach ($hotelImg as $name)
	 			{
	 				foreach ($name as $id => $item)
	 				{
	 					$targetPath = WWW_ROOT. 'img'. DS . 'Hotels'. DS. $item->getClientFilename();
		 				$item->moveTo($targetPath);
	 				}
	 			}

	 			// Applying the image name to the form data
		 		$formData['hotel_img'] = $hotelImages;

		 		//debug($formData);
		 		
		 		// Filling the enity with the form data
		 		$hotel = $this->Hotels->patchEntity($hotel, $formData);
	 		}
	 		
	 		if ($this->Hotels->save($hotel))
	 		{
	 			$this->Flash->success(__('You have updated the: '.$hotel->hotel_name.'.'));
                return $this->redirect(['controller' => 'Admin', 'action' => 'index']);
	 		}
	 		$this->Flash->error(__('Unable to save that hotel.'));
	 	}
	 	$this->set('hotel', $hotel);

    }

    public function delete($id=null)
    {
    	$hotel = $this->Hotels->get($id);

    	if ($this->request->is(['post','put']))
    	{

    		if ($this->Hotels->delete($hotel))
    		{
    			$this->Flash->success($hotel->hotel_name." has been deleted");
    			return $this->redirect(['controller' => 'admin', 'action' => 'index']);
    		}
    		$this->Flash->error("Unable to delete ".$hotel->hotel_name);
    	}
    	$this->set('hotel', $hotel);
    }

    public function book($id=null)
    {
    	$room = $this->Rooms->get($id);
    	debug($this->request->getData());
    	// $str_arr = unserialize(urldecode($_GET['str']));
    	// debug($str_arr);
    }
}