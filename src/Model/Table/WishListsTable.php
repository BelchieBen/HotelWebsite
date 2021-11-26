<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class WishListsTable extends Table
{
    public function initialize(array $config): void
    {
        // Specifying relationships
    	$this->hasOne('User', ['className' => 'Users']);
        $this->hasMany('WishListItems');
    }
}
