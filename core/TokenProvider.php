<?php

namespace Example\Core;

use League\OAuth2\Client\Token\AccessToken;

abstract class TokenProvider
{

  protected ?AccessToken $token = null;

  protected AuthProvider $auth;

  abstract protected function saveToken(): void;

  abstract protected function restoreToken(): void;

  public function setAuthProvider(AuthProvider $auth): void
  {
    $this->auth = $auth;
  }

  public function createToken(string $auth_code): string
  {
    $this->token = $this->auth->getAccessToken(
      'authorization_code',
      [
        'code' => $auth_code,
      ]
    );

    $this->saveToken();

    return $this->token->getToken();
  }

  protected function refreshToken(): void
  {
    $this->token = $this->auth->getAccessToken(
      'refresh_token',
      [
        'refresh_token' => $this->token->getRefreshToken(),
      ]
    );

    $this->saveToken();
  }

  public function getToken(): string
  {
    if (!$this->token) {
      $this->restoreToken();
    }

    if ($this->token->hasExpired()) {
      $this->refreshToken();
    }

    return $this->token->getToken();
  }
}
