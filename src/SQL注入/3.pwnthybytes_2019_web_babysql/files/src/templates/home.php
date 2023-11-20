<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">

    <title>home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap-combined.min.css" rel="stylesheet"
          id="bootstrap-css">
    <style type="text/css">

    </style>
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <?php
    include 'db.php';

    if (isset($_SESSION["username"])):
        die('<div class="alert alert-warning" id="msg-verify" role="alert"><strong>Hope this site is secure! I did my best to protect against some attacks. New sections will be available soon.</strong></div>');
    else:
        die('<meta http-equiv="refresh" content="0; url=?p=login" />');
    endif;

    ?>
</div>
</body>

</html>