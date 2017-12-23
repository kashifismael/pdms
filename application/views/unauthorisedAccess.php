<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url("css/stylesheet.css") ?>">
        <link href="<?= base_url("images/unidissIcon.ico") ?>" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Unauthorised Access</title>
    </head>
    <body style="padding-top: 70px;">
        <nav class="navbar navbar-inner navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <span><img id="logo"  src="<?= base_url("images/unidissLogo.png") ?>" height="28">
                            UniDiss</span></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="#">Dashboard</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>   
        <div class="container">   

            <div class="alert alert-danger">
                <strong>You are not authorised to access this content</strong>
            </div>
        </div>

    </body>
</html>
