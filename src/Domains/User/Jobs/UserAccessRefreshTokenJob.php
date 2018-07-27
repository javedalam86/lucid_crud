<?php
namespace App\Domains\User\Jobs;

use Lucid\Foundation\Job;
use App\Foundation\Helper\OauthHelper;
use Illuminate\Auth\AuthenticationException;

class UserAccessRefreshTokenJob extends Job
{
    protected $data;   
    protected $unauthorisedStatusCode = 401;
    protected $successStatusCode = 200;
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
    public function handle(OauthHelper $helper)
    {
        $input = [
            'grant_type' => 'refresh_token',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'refresh_token' => $this->data['refresh_token'],
        ];

        $method = 'POST';
        $urlPart = env('APP_URL').'/oauth/token';
        $response = $helper->resourceApi($urlPart, $input,$method);  
             
        if($response->getStatusCode() == $this->successStatusCode) {
            $result = json_decode($response->getBody(), true);
            $authentication = [
            'access_token'  => isset($result['access_token'])?$result['access_token']:'',
            'refresh_token'  => isset($result['refresh_token'])?$result['refresh_token']:''
            ];  
            return $authentication;         
        } 

        if($response->getStatusCode() == $this->unauthorisedStatusCode) {
            throw new AuthenticationException('Unauthorized');
        } 

        throw new \Exception('Unknown Error');  
       
    }
}
