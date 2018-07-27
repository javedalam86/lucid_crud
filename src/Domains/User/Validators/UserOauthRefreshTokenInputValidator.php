<?php
namespace App\Domains\User\Validators;

use App\Foundation\AppValidator;

class UserOauthRefreshTokenInputValidator extends AppValidator {
  protected $rules = [   
    'refresh_token' => 'required',
  ];
}