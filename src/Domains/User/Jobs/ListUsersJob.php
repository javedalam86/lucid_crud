<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

class ListUsersJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $userRepo)
    {       
       return $userRepo->all();
    }
}
