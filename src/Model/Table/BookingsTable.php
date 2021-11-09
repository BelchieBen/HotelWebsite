<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BookingsTable extends Table
{
    public function initialize(array $config): void
    {
    	$this->belongsTo('Rooms');
        $this->belongsTo('Hotels');
    }
}
