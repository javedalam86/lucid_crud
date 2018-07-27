<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;

class RetriveSingleUserJob extends Job
{
 
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(UserRepository $repo)
    {
        //abort(401, 'User not found');
        //abort(403, 'Unauthorized action.');
        //throw new AuthenticationException('User not found2');
        return $repo->find($this->id);
    }
}
