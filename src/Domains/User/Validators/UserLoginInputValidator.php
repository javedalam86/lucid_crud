<?php
namespace App\Domains\User\Validators;

use App\Foundation\AppValidator;

class UserLoginInputValidator extends AppValidator {
  protected $rules = [   
    'email' => 'required|email',
    'password' => 'required',  
  ];
}