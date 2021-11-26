<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login','register']);
    }

    public function initialize():void
    {
        parent::initialize();

        $bookings = $this->loadModel('Bookings');
        $rooms = $this->loadModel('Rooms');
        $hotels = $this->loadModel('Hotels');
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /home after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

            $user = $this->Authentication->getIdentity()->getOriginalData();
            $user = $this->Users->patchEntity($user, $this->getRequest()->getData());
            if ($this->Users->save($user)) {
                $this->Authentication->setIdentity($user); // ----- > update identity data
                $this->Flash->success(__('Welcome '.$user->firstname));
            }
            else{       
                $this->Flash->error(__('The user could not be saved. Please try again.'));
            }

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function index()
    {
        $this->set('users', $this->Users->find()->all());
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function register()
    {
        // Creating a new users object
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // Calling patch entity will apply the formdata to the new object
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    // This method of adding a user is only applied for admins
    public function add()
    {
        // Checking if the user is an admin, this function is for admins only. If the user isnt an admin they will be redirected and shown an error
        if ($this->request->getAttribute('identity')['role'] != 'admin')
        {
            $this->Flash->error(__('You are not authorized to visit this page'));
            $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Admin','action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    // This method of adding a user is only applied for admins
     public function update($id=null)
    {
        // Checking if the user is an admin, this function is for admins only. If the user isnt an admin they will be redirected and shown an error
        if ($this->request->getAttribute('identity')['role'] != 'admin')
        {
            $this->Flash->error(__('You are not authorized to visit this page'));
            $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        // Getting the user from the ID passed in the URL params
        $user = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been updated.'));
                return $this->redirect(['controller' => 'Admin','action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    public function profile()
    {
        $currentlyLoggedInUser = $this->request->getAttribute('identity');
        $user = $this->Users->get($currentlyLoggedInUser->id);
        $bookings = $this->Bookings->find()->where(['user_id' => $user->id])->order(['date_booked' => 'DESC']);
        $bookings = $bookings->toArray();

        $recentBookings = [];

        $rooms = [];
        foreach ($bookings as $booking) 
        {
            $days = ($booking->booking_start)->diff($booking->booking_end)->days;
            $room = $this->Rooms->get($booking->room_id);
            $hotel = $this->Hotels->get($booking->hotel_id);
            // Creating a custom array from multiple data models to easily display the data on the profile page
            $bookingArray = [
                'room_number' => $room->roon_number,
                'room_img' => $room->room_img,
                'booking_id' => $booking->booking_id,
                'total' => $booking->total,
                'check_in' => $booking->booking_start,
                'check_out' => $booking->booking_end,
                'hotel_name' => $hotel->hotel_name,
                'room_category' => $room->room_category,
                'hotel_contact' => $hotel->contact_number,
                'days' => $days,
            ];
            array_push($recentBookings, $bookingArray);
        }

        if ($this->request->is(['post', 'put']))
        {
            // Getting data from a profile change
            $formData = $this->request->getData();
            $profileImg = $this->request->getUploadedFiles();
            $filename = $formData['profile_img']->getClientFilename();

            // If the user has changed thier profile picture
            if (!empty($formData['profile_img']->getClientFilename()))
            {
                foreach ($profileImg as $img) 
                {
                    debug($formData['profile_img']->getClientFilename());
                    $formData['profile_img'] = $img->getClientFilename();
                    $targetPath = WWW_ROOT. 'img'. DS . 'Profiles'. DS. $img->getClientFilename();
                    $img->moveTo($targetPath);
                }
            }

            // If they havent changed thir profile picture, only update the nessessary attributes
            if (empty($filename))
            {
                $user->firstname = $this->request->getData('firstname');
                $user->surname = $this->request->getData('surname');
                $user->email = $this->request->getData('email');
            }

            else
            {
                // Follows on from user changing thier profile picture
                $user = $this->Users->patchEntity($user, $formData);
            }

            if ($this->Users->save($user))
            {
                $this->Flash->success("You have updated your profile!");
            }

            else
            {
                $this->Flash->error("There was an error updating your profile");
            }
        }

        $this->set(['user' => $user, 'recentBookings' => $recentBookings]);
    }

    public function changePassword()
    {
        $currentlyLoggedInUser = $this->request->getAttribute('identity');
        $user = $this->Users->get($currentlyLoggedInUser->id);

        if ($this->request->is(['post','put']))
        {
            // Get the new password from the form
            $formData = $this->request->getData();
            $user = $this->Users->patchEntity($user, $formData);

            if ($this->Users->save($user))
            {
                $this->Flash->success("You have successfully changed your password");
                return $this->redirect(['action' => 'profile']);
            }
        }
    }

    public function delete($id=null)
    {
        if ($this->request->getAttribute('identity')['role'] != 'admin')
        {
            $this->Flash->error(__('You are not authorized to visit this page'));
            $this->redirect(['controller' => 'Home','action' => 'index']);
        }
        $user = $this->Users->get($id);
        if ($this->request->is(['post','put']))
        {

            if ($this->Users->delete($user))
            {
                $this->Flash->success("You have removed ".$user->firstname);
                return $this->redirect(['controller' => 'Admin','action' => 'index']);
            }
            $this->Flash->error("Unable to remove ".$user->firstname);
        }
        $this->set('user', $user);
    }
}
