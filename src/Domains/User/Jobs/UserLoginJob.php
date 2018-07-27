<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class UserLoginJob extends Job
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
    public function handle()
    {
        if(Auth::attempt($this->data))
        {
          $user = Auth::user();
          return $user->createToken('UnifiCare')->accessToken;          
        }
        else
        {
          throw new AuthenticationException('Unauthorized');
        }
    }
}
