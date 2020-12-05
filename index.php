<?php require_once 'bootstrap.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dropbox OAuth2 Example With Refresh Tokens</title>
</head>

<body>

  <p>
    <a target="_blank" href="<?= $dropbox->getSetupUrl() ?>">
      Get Authorization Code From Dropbox
    </a>
  </p>

  <p>
    <form action="<?= basename(__FILE__) ?>" method="POST">
      <input type="text" name="auth-code" id="auth-code" required>
      <input type="hidden" name="oauth2-action" value="obtain-token">
      <input type="submit" value="Get Token">
    </form>
  </p>

  <p>
    <form action="<?= basename(__FILE__) ?>" method="POST">
      <input type="text" name="folder-path" id="folder-path">
      <input type="hidden" name="oauth2-action" value="list-folders">
      <input type="submit" value="List Folders">
    </form>
  </p>

  <p>
    <form action="<?= basename(__FILE__) ?>" method="POST">
      <input type="text" name="file-path" id="file-path" required>
      <input type="hidden" name="oauth2-action" value="download-file">
      <input type="submit" value="Download File">
    </form>
  </p>

</body>

</html>
