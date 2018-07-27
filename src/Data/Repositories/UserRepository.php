<?php

namespace App\Data\Repositories;

use Framework\User;


/**
 * Base Repository.
 */
class UserRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    public function __construct()
    {
        $this->model = new User;
        parent::__construct($this->model);
    }

   
}
