<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class BookingItem extends Entity
{
    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'item_id' => false
    ];
}
