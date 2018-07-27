<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

class DeleteUserJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $data;
    protected $id;

    public function __construct($data, $id)
    {
        $this->data = $data;
        $this->id = $id;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $repo)
    {
        $user = $repo->find($this->id);
        $user->delete();
       //$repo->model->whereId($this->id)->delete($this->data);
    }
}
