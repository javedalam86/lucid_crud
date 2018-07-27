<?php
namespace App\Services\V1\Features;

use Illuminate\Http\Request;
use App\Domains\User\Jobs\UserLoginJob;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Domains\User\Jobs\ValidateUserLoginInputJob;
use Exception;

class UserLoginFeature extends APIBaseFeature
{
  public function handle(Request $request)
  {
    try{   
       
     $this->run(ValidateUserLoginInputJob::class, [
        'data' => $request->all(),
      ]);

      $token = $this->run(UserLoginJob::class, [
        'data' => $request->all(),
      ]);

      $jsonOutput = array (       
        "token" => $token
      );
      return response()->json($jsonOutput, $this->successStatusCode);

    } catch(ValidationException $e){

        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => $this->validationStatusCode,
          "errorMessage" => $this->validationErrorMessage//$e->errors()
        );
        return response()->json($jsonOutput, $this->validationStatusCode);

    } catch(AuthenticationException $e){
      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => $this->unauthorisedStatusCode,
        "errorMessage" => $this->unauthoriseErrorMessage
      );
      return response()->json($jsonOutput, $this->unauthorisedStatusCode);

    } catch(Exception $e){

      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => $this->failUnknownStatusCode,
        "errorMessage" => $this->failUnknownErrorMessage
      );
      return response()->json($jsonOutput, $this->successStatusCode);

    }
  }
}
