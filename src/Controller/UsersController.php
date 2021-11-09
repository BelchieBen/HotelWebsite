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
            // redirect to /articles after login success
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
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
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
            $formData = $this->request->getData();
            $profileImg = $this->request->getUploadedFiles();

            foreach ($profileImg as $img) 
            {
                $formData['profile_img'] = $img->getClientFilename();
                $targetPath = WWW_ROOT. 'img'. DS . 'Profiles'. DS. $img->getClientFilename();
                $img->moveTo($targetPath);
            }

            if (empty($profileImg))
            {
                $user->firstname = $this->request->getData('firstname');
                $user->surname = $this->request->getData('surname');
                $user->email = $this->request->getData('email');
            }

            else
            {
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
}
