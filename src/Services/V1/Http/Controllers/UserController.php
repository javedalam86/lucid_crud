<?php
namespace App\Services\V1\Http\Controllers;

use Illuminate\Http\Request;
use Lucid\Foundation\Http\Controller;
use App\Services\V1\Features\ListUsersFeature;
use App\Services\V1\Features\AddUserFeature;
use App\Services\V1\Features\ViewUserFeature;
use App\Services\V1\Features\UpdateUserFeature;
use App\Services\V1\Features\DeleteUserFeature;
use App\Services\V1\Features\UserLoginFeature;
use App\Services\V1\Features\UserOauthTokenFeature;
use App\Services\V1\Features\UserOauthRefreshTokenFeature;

class UserController extends Controller
{
  public function index()
  {   
    return $this->serve(ListUsersFeature::class);
  }

  public function create(Request $request)
  {  
    return $this-> serve(AddUserFeature::class);
  }

  public function show($id)
  {
    return $this-> serve(ViewUserFeature::class, [
      'id' => $id
    ]);
  }

  public function update(Request $request, $id)
  {
    return $this->serve(UpdateUserFeature::class, [
      'id' => $id
    ]);
  }

  public function destroy($id)
  {
    return $this->serve(DeleteUserFeature::class,[
      'id' => $id
    ]);
  }

  public function POST_login(Request $request)
  {   
    return $this->serve(UserLoginFeature::class);
  }

  public function POST_oauth_token(Request $request)
  {
    return $this->serve(UserOauthTokenFeature::class);
  }

  public function POST_oauth_refresh_token(Request $request)
  {
    return $this->serve(UserOauthRefreshTokenFeature::class);
  }
  
}