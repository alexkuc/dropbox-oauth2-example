<?php

ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');

use Dotenv\Dotenv;
use Example\App\Dropbox;
use Example\App\Token;

require_once 'vendor/autoload.php';

require_once 'dd.php';

(Dotenv::createImmutable(__DIR__))->load();

$token = new Token();

$dropbox = new Dropbox(
  $_ENV['APP_KEY'],
  $_ENV['APP_SECRET'],
  $token
);

if (!isset($_REQUEST['oauth2-action'])) {
  return;
}

$action = $_REQUEST['oauth2-action'];

if ($action === 'obtain-token') {
  $auth_code = $_REQUEST['auth-code'];
  $dropbox->setUp($auth_code);
  dd($dropbox);
}

if ($action === 'list-folders') {
  $path = $_REQUEST['folder-path'];
  $folders = $dropbox->getApi()->listFolder($path, true);
  dd($folders);
}

if ($action === 'download-file') {
  $file_path = $_REQUEST['file-path'];
  $filename = basename($file_path);
  $size = $dropbox->getApi()->getMetadata($file_path)['size'];
  $file = $dropbox->getApi()->download($file_path);

  ob_end_flush();

  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename=' . $filename);
  header('Content-Transfer-Encoding: binary');
  header('Connection: Keep-Alive');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . $size);

  fpassthru($file);

  dd();
}
