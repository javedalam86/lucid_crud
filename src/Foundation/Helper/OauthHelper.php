<?php
namespace App\Foundation\Helper;

use GuzzleHttp\Client;

class OauthHelper
{
  public function resourceApi($domain_url_part, $json=[], $method='POST')
  {
    $client = new Client();
    $vars = [
      'http_errors' => false,
      'verify' => 0,
      'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/vnd.siv-awesome.v1+json'],
      'json' => $json
    ];

    try
    {
      $response = $client->request($method, $domain_url_part, $vars);
      return $response;
    }
    catch ( \Exception $exception )
    {
      $response = new \stdClass();
      $response->status = 'FAIL';
      $response->code = 800;
      $response->errorMessage = $exception->getMessage();
      return $respons;
    }
  }
}