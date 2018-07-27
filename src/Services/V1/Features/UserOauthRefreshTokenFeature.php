<?php
namespace App\Services\V1\Features;

use Illuminate\Http\Request;
use App\Domains\User\Jobs\UserLoginJob;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Domains\User\Jobs\ValidateUserOauthRefreshTokenInputJob;
use App\Domains\User\Jobs\UserAccessRefreshTokenJob;
use Exception;;

class UserOauthRefreshTokenFeature extends APIBaseFeature
{
    public function handle(Request $request)
    {
      try {   
       
      $this->run(ValidateUserOauthRefreshTokenInputJob::class, [
        'data' => $request->all(),
      ]);

      $response = $this->run(UserAccessRefreshTokenJob::class, [
        'data' => $request->all(),
      ]);
      
      $jsonOutput = array (
          "status"=>$this->successStatus,
          "code"  => $this->successStatusCode,
          'access_token'  => isset($response['access_token'])?$response['access_token']:'',
          'refresh_token'  => isset($response['refresh_token'])?$response['refresh_token']:''
      );
       
      return response()->json($jsonOutput, $this->successStatusCode);

    } catch(ValidationException $e){

        $jsonOutput = array (
          "status"=>$this->failStatus,
          "code"  => $this->validationStatusCode,
          "errorMessage" => $this->validationErrorMessage//$e->errors()
        );
        return response()->json($jsonOutput, $this->validationStatusCode);

    } catch(AuthenticationException $e){

      $jsonOutput = array (
        "status"=>$this->failStatus,
        "code"  => $this->unauthorisedStatusCode,
        "errorMessage" => $this->unauthoriseErrorMessage
      );
      return response()->json($jsonOutput, $this->unauthorisedStatusCode);

    } catch(Exception $e){

      $jsonOutput = array (
        "status"=>$this->failStatus,
        "code"  => $this->failUnknownStatusCode,
       // "errorMessage" => $this->failUnknownErrorMessage //$e->getMessage()
        "errorMessage" => $e->getMessage()
      );
      return response()->json($jsonOutput, $this->successStatusCode);

    }
  }
}
