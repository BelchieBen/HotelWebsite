<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class BasketsTable extends Table
{
    public function initialize(array $config): void
    {
    	$this->hasOne('User', ['className' => 'Users']);
        $this->hasMany('BasketItems');
    }
}
