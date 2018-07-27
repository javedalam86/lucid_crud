<?php
namespace App\Foundation;

use Lucid\Foundation\Validation;
use Lucid\Foundation\InvalidInputException;
use Illuminate\Validation\ValidationException;

/**
 * Base Validator class, to be extended by specific validators.
 * Decorates the process of validating input. Simply declare
 * the $rules and call validate($attributes) and you have an
 * \Illuminate\Validation\Validator instance.
 */
class AppValidator
{
    protected $rules = [];
    protected $messages = [];

    protected $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

   
    public function validate($input, array $rules = [])
    {
        $validation = $this->validation($input, $rules);
        if ($validation->fails()) {         
            throw new ValidationException($validation);
        }

        return true;
    }
    
    public function validation($input, array $rules = [])
    {
        if (empty($rules)) {
            $rules = $this->rules;
        }        
        if (empty($messages)) {
            $messages = $this->messages;
        }
        return $this->validation->make($input, $rules, $messages);
    }
}