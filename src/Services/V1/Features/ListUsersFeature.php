<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Domains\User\Jobs\ListUsersjob;

class ListUsersFeature extends Feature
{
    public $successStatusCode = 200; 
    public $failUnknownStatusCode=800;  

    public function handle(Request $request)
    {       
      try{
        $response = $this->run(ListUsersjob::class);
        $jsonOutput = array (
          "status"=>"SUCCESS",
          "code"  => $this->successStatusCode,
          "response" => $response
        );
        return response()->json($jsonOutput, $this->successStatusCode);
      }
      catch(\Exception $e){
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => $this->failUnknownStatusCode,
          "errorMessage" => $e->getMessage()
        );
        return response()->json($jsonOutput, $this->successStatusCode);
      }   
    }
}
