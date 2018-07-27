<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;
use App\Domains\User\Jobs\RetriveSingleUserjob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;

class ViewUserFeature extends Feature
{
  public $successStatusCode = 200;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function handle()
  {
    try {
      $user = $this->run(RetriveSingleUserjob::class, [
      'id' => $this->id
      ]);
      $jsonOutput = array (
        "status"=>"SUCCESS",
        "code"  => $this->successStatusCode,
        "response" =>$user
      );
      return response()->json($jsonOutput, $this->successStatusCode);
      
    } catch(ModelNotFoundException $e){        
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => 400,
          "errorMessage" => "Records not exist"
        );
        return response()->json($jsonOutput, 400);
      }
      catch(AuthenticationException $e){        
        $jsonOutput = array (
          "status"=>"FAILL1",
          "code"  => $e->getStatusCode(),
          "errorMessage" => $e->getMessage()
        );
        return response()->json($jsonOutput, 200);
      }
      catch(AuthorizationException $e){        
        $jsonOutput = array (
          "status"=>"FAILL2",
          "code"  => $e->getStatusCode(),
          "errorMessage" => $e->getMessage()
        );
        return response()->json($jsonOutput, 200);
      }
      catch(\Exception $e){        
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => $e->getStatusCode(),
          "errorMessage" => $e->getMessage()
        );
        return response()->json($jsonOutput, $e->getStatusCode());
      }
    
  }
}
