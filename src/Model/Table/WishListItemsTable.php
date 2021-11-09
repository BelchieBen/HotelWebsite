<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class WishListItemsTable extends Table
{
    public function initialize(array $config): void
    {
    	$this->hasOne('Hotel', ['className' => 'Hotels']);
    }
}
