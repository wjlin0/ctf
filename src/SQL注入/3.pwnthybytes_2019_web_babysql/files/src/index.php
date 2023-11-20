<?php
session_start();

foreach ($_SESSION as $key => $value): $_SESSION[$key] = filter($value); endforeach;
foreach ($_GET as $key => $value): $_GET[$key] = filter($value); endforeach;
foreach ($_POST as $key => $value): $_POST[$key] = filter($value); endforeach;
foreach ($_REQUEST as $key => $value): $_REQUEST[$key] = filter($value); endforeach;

function filter($value)
{
    !is_string($value) AND die("Hacking attempt!");

    return addslashes($value);
}

isset($_GET['p']) AND $_GET['p'] === "register" AND $_SERVER['REQUEST_METHOD'] === 'POST' AND isset($_POST['username']) AND isset($_POST['password']) AND @include('templates/register.php');
isset($_GET['p']) AND $_GET['p'] === "login" AND $_SERVER['REQUEST_METHOD'] === 'GET' AND isset($_GET['username']) AND isset($_GET['password']) AND @include('templates/login.php');
isset($_GET['p']) AND $_GET['p'] === "home" AND @include('templates/home.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">

    <title>Login/Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap-combined.min.css" rel="stylesheet"
          id="bootstrap-css">
    <style type="text/css">

    </style>
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function () {
        };
        var defaultCSS = document.getElementById('bootstrap-css');

        function changeCSS(css) {
            if (css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="' + css + '" type="text/css" />');
            else $('head > link').filter(':first').replaceWith(defaultCSS);
        }

        $(document).ready(function () {
            var iframe_height = parseInt($('html').height());
            window.parent.postMessage(iframe_height, 'http://bootsnipp.com');
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="" id="loginModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3>Have an Account?</h3>
                </div>
                <div class="modal-body">
                    <div class="well">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                            <li><a href="#create" data-toggle="tab">Create Account</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active in" id="login">
                                <form class="form-horizontal" method="GET">
                                    <fieldset>
                                        <div id="legend">
                                            <legend class="">Login</legend>
                                        </div>
                                        <div class="control-group">
                                            <!-- Username -->
                                            <label class="control-label" for="username">Username</label>
                                            <div class="controls">
                                                <input type="text" id="username" name="username" placeholder=""
                                                       class="input-xlarge">
                                            </div>
                                        </div>
                                        <input type="hidden" name="p" value="login"/>
                                        <div class="control-group">
                                            <!-- Password-->
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="password" id="password" name="password" placeholder=""
                                                       class="input-xlarge">
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <!-- Button -->
                                            <div class="controls">
                                                <button class="btn btn-success">Login</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="create">
                                <label>Username</label>
                                <input type="text" name="reg-username" id="reg-username" value="" class="input-xlarge">
                                <label>Password</label>
                                <input type="text" name="reg-password" id="reg-password" value="" class="input-xlarge">
                                <div>
                                    <button id="reg" class="btn btn-primary" onclick="register();">Create Account
                                    </button>
                                </div>
                                <br/>
                                <div id="register-msg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function register() {
            $.ajax({
                type: "POST",
                url: "?p=register",
                data: "username=" + $("#reg-username").val() + "&password=" + $("#reg-password").val(),
                success: function (data) {
                    if (data.indexOf('successfully') > -1) {
                        var msg2 = '<div class="alert alert-success" id="msg-verify" role="alert"><strong>' + data + '</div>';
                        $("#msg-verify").remove();
                        $("#register-msg").append(msg2);
                        $("#msg-verify").delay(3200).fadeOut(2000);
                    }

                    if (data.indexOf('paranoid') > -1) {
                        var msg2 = '<div class="alert alert-warning" id="msg-verify" role="alert"><strong>' + data + '</div>';
                        $("#msg-verify").remove();
                        $("#register-msg").append(msg2);
                        $("#msg-verify").delay(3200).fadeOut(2000);
                    }

                    if (data.indexOf('Error') > -1) {
                        var msg2 = '<div class="alert alert-info" id="msg-verify" role="alert"><strong>' + data + '</div>';
                        $("#msg-verify").remove();
                        $("#register-msg").append(msg2);
                        $("#msg-verify").delay(3200).fadeOut(2000);
                    }

                }
            });
        }
    </script>
    <!-- /source.zip -->
</body>
</html>
