<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class BookingsController extends AppController
{
	// Only method in this class is cancel as the booking is made in the baskets controller
	public function cancel($id=null)
	{
		$booking = $this->Bookings->get($id);

		if ($this->request->is(['post','put']))
    	{
    		// The delete function returns a bool value so if deletion is successful redirect & show notification
    		if ($this->Bookings->delete($booking))
    		{
    			$this->Flash->success("You have cancelled booking ".$booking->booking_id);
    			return $this->redirect(['controller' => 'Users','action' => 'profile']);
    		}
    		$this->Flash->error("Unable to remove that item");
    	}
    	$this->set('booking', $booking);
	}
}