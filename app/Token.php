<?php

namespace Example\App;

use Example\Core\TokenProvider;

class Token extends TokenProvider
{

  public function __sleep(): void
  {
    $this->saveToken();
  }

  public function __wakeup(): void
  {
    $this->restoreToken();
  }

  protected function saveToken(): void
  {
    session_start();
    $_SESSION['dropbox-token'] = $this->token;
    session_write_close();
  }

  protected function restoreToken(): void
  {
    session_start();
    $this->token = $_SESSION['dropbox-token'];
    session_write_close();
  }
}
