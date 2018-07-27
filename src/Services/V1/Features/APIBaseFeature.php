<?php
namespace App\Services\V1\Features;

use Lucid\Foundation\Feature;

class APIBaseFeature extends Feature
{
  public $successStatusCode = 200;
  public $unauthorisedStatusCode = 401;
  public $unauthoriseErrorMessage = 'Unauthorized';
  public $failUnknownStatusCode = 800;
  public $failUnknownErrorMessage = 'Unknown Error';
  public $validationStatusCode = 400;
  public $validationErrorMessage = 'Required field is missing';

  public $successStatus = 'SUCCESS';
  public $failStatus = 'FAIL';
}
