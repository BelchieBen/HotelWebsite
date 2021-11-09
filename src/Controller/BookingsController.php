<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class BookingsController extends AppController
{
	public function cancel($id=null)
	{
		$booking = $this->Bookings->get($id);

		if ($this->request->is(['post','put']))
    	{

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