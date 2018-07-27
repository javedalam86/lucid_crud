<?php

namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

class CreatUserJob extends Job
{
    protected $data;
    
    /**
    * Create a new job instance.
    *
    * @return void
    */     

    public function __construct($data)
    {      
        $this->data = $data;
    }

    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle(UserRepository $userObj)
    {
        $this->data['password'] = bcrypt($this->data['password']);
        if(!$userObj->model->create($this->data)){
            throw new \Exception('User Save Error Message');
        }
    }
}
