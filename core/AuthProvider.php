<?php

namespace Example\Core;

use Stevenmaguire\OAuth2\Client\Provider\Dropbox;

class AuthProvider extends Dropbox
{

  public function getBaseAuthorizationUrl(): string
  {
    return 'https://www.dropbox.com/oauth2/authorize';
  }

  public function getAuthorizationUrl(array $options = []): string
  {
    $options['token_access_type'] = 'offline';
    return parent::getAuthorizationUrl($options);
  }

  public function getScopeSeparator(): string
  {
    return ' ';
  }

  public function getDefaultScopes(): array
  {
    return [
      'account_info.write',
      'account_info.read',
      'files.metadata.write',
      'files.metadata.read',
      'files.content.write',
      'files.content.read',
      'sharing.write',
      'sharing.read',
      'file_requests.write',
      'file_requests.read',
      'contacts.write',
    ];
  }
}
