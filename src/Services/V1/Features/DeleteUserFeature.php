<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Domains\User\Jobs\DeleteUserJob;

class DeleteUserFeature extends Feature
{
  protected  $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function handle(Request $request)
  {
    try
    {
      $this->run(DeleteUserJob::class,[
        'id' => $this->id,
        'data' => $request->input($this->id),
      ]);

      $jsonOutput = array (
        "status"=>"SUCCESS",
        "code"  => 200,
        "response" => "user deleted successfully"
      );
      return response()->json($jsonOutput, 200);

    } catch(ModelNotFoundException $e){        
      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => 400,
        "errorMessage" => "Records not exist"
      );
      return response()->json($jsonOutput, 400);
    } catch(\Exception $e){        
      $jsonOutput = array (
        "status"=>"FAIL",
        "code"  => 800,
        "errorMessage" => $e->getMessage()
      );
      return response()->json($jsonOutput, 200);
    }
  }
}
