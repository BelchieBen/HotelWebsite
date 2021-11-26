<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BasketItemsTable extends Table
{
    public function initialize(array $config): void
    {
        // Specifying the relationship to the Rooms table
    	$this->hasOne('Room', ['className' => 'Rooms']);
    }
}
