<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Domains\User\Jobs\ValidateUpdateUserInputJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Domains\User\Jobs\UpdateUserJob;

class UpdateUserFeature extends Feature
{
  public $validationStatusCode = 400;
  public $successStatusCode = 200;
  protected $id;
  public function __construct($id)
  {
    $this->id = $id;
  } 
  public function handle(Request $request)
  {
    try
    {
      $this->run(ValidateUpdateUserInputJob::class, [
        'data' => $request->all(),
      ]);

     $this->run(UpdateUserJob::class, [
        'data' => $request->all(),
        'id' => $this->id
      ]);

      $jsonOutput = array (
        "status"=>"SUCCESS",
        "code"  => $this->successStatusCode,
        "response" => "user update successfully"
      );
      return response()->json($jsonOutput, $this->successStatusCode);

    }
    catch(ValidationException $e){        
        $jsonOutput = array (
          "status"=>"FAIL",
          "code"  => $this->validationStatusCode,
          "errorMessage" => $e->errors()
        );
        return response()->json($jsonOutput, $this->validationStatusCode);
    } 
    catch(ModelNotFoundException $e){        
      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => $this->validationStatusCode,
        "errorMessage" => "Records not exist"
      );
      return response()->json($jsonOutput, $this->validationStatusCode);
    }
    catch(\Exception $e){        
      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => 800,
        "errorMessage" => $e->getMessage()
      );
      return response()->json($jsonOutput, 200);
    }
  }
}
