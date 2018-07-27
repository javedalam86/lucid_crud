<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Domains\User\Validators\UserUpdateInputValidator;

class ValidateUpdateUserInputJob extends Job
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
    public function handle(UserUpdateInputValidator $validator)
    {
       return $validator->validate($this->data);
    }
}
