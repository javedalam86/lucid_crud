<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Domains\User\Validators\UserOauthTokenInputValidator;

class ValidateUserOauthTokenInputJob extends Job
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
    public function handle(UserOauthTokenInputValidator $validator)
    {
       return $validator->validate($this->data);
    }
}
