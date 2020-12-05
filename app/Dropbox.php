<?php

namespace Example\App;

use Example\Core\AuthProvider;
use Example\Core\TokenProvider;
use League\OAuth2\Client\Provider\AbstractProvider;
use Spatie\Dropbox\Client as ApiProvider;

class Dropbox
{

  protected AbstractProvider $auth;

  protected TokenProvider $token;

  protected ApiProvider $api;

  public function __construct(
    string $app_key,
    string $app_secret,
    TokenProvider $token
  ) {

    $this->auth = new AuthProvider(['clientId'          => $app_key,
      'clientSecret'      => $app_secret,
    ]);

    $this->token = $token;
    $this->token->setAuthProvider($this->auth);

    $this->api = new ApiProvider();
  }

  public function getSetupUrl(): string
  {
    return $this->auth->getAuthorizationUrl();
  }

  public function setUp(string $auth_code): void
  {
    $token = $this->token->createToken($auth_code);
    $this->api->setAccessToken($token);
  }

  public function getApi(): ApiProvider
  {
    $token = $this->token->getToken();
    $this->api->setAccessToken($token);
    return $this->api;
  }
}
