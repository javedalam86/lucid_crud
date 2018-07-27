<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Data\Repositories\UserRepository;

class UpdateUserJob extends Job
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
        $this->data['password'] = bcrypt($this->data['password']);
        if($repo->find($this->id)){
            return $repo->model->whereId($this->id)->update($this->data);
        }
    }
}
