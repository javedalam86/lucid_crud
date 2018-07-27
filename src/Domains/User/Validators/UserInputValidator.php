<?php
namespace App\Domains\User\Validators;

use App\Foundation\AppValidator;

class UserInputValidator extends AppValidator {
    protected $rules = [   
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6|confirmed',  
    ];
}