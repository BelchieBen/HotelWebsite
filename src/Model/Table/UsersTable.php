<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->hasOne('Basket', ['className' => 'Baskets']);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator
            ->notEmpty('email', 'An email is required')
            ->email('email')
            ->notEmpty('password', 'A password is required');
    }
}
