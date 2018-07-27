<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Domains\User\Jobs\ValidateUserInputJob;
use App\Domains\User\Jobs\CreatUserJob;

class AddUserFeature extends Feature
{
   
    public $validationStatusCode = 400;
    public $successStatusCode = 200;
    public $failSaveStatusCode = 700;
    public $failSaveErrorMessage = 'Fail To Save Data';
    public $failUnknownStatusCode = 800;
    public $failUnknownErrorMessage = 'Unknown Error';
    public function handle(Request $request)
    {
      try{
        //Validate input job
        $this->run(ValidateUserInputJob::class, [
          'data' => $request->all(),
        ]);
        //Create New user job
        $this->run(CreatUserJob::class, [
          'data' => $request->all(),
        ]);

        $jsonOutput = array (
          "status"=>"SUCCESS",
          "code"  => $this->successStatusCode,
          "response" => "user added successfully"
        );
        return response()->json($jsonOutput, $this->successStatusCode);

      } catch(ValidationException $e){        
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => $this->validationStatusCode,
          "errorMessage" => $e->errors()
        );
        return response()->json($jsonOutput, $this->validationStatusCode);
      }
      catch(\Exception $e){        
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => 500,
          "errorMessage" => $e->getMessage()
        );
        return response()->json($jsonOutput, $this->validationStatusCode);
      }
    }
}
