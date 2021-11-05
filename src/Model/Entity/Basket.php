<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Basket extends Entity
{
    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'basket_id' => false
    ];
}
