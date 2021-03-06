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
                <div class="visible-xs pull-right">
                    <button data-toggle="modal"
                            data-target="#signUpModal" id="newButton"
                            class="btn btn-success navbar-btn">
                        Sign Up</button>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!-- <li class="active"><a href="#">Dashboard</a></li> -->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-xs">
                        <button data-toggle="modal"
                                data-target="#signUpModal" id="newButton"
                                class="btn btn-success navbar-btn">
                            Sign Up</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hidden-xs hidden-sm" style="padding-bottom: 100px"></div>

    <div class="container-fluid">
        <h1 class="text-center" >Welcome to UniDiss!</h1>
        <div class="col-md-4 col-md-offset-4">
            <form class="form form-login" name="login" id="login-form" method="POST" action="loginPortal">
                <div class="form-group">
                    <div class ="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input id="username" type="text"  name="username" class="form-control input-lg" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id="password" type="password" name="password" class="form-control input-lg" placeholder="Password" required>
                    </div>
                </div>

                <?php if (isset($_GET['details'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Incorrect details!</strong> Please enter your username/password again
                    </div>
                <?php } ?> 
                
                <?php if (isset($_GET['isAuthorised'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Unauthorised Access!</strong> You must log in to use this website
                    </div>
                <?php } ?>
                
                <?php if (isset($_SESSION['passNotMatching'])): ?>
                    <div class="alert alert-danger">
                        <strong>Passwords not matching!</strong> Make sure your passwords match
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['notUnique'])): ?>
                    <div class="alert alert-danger">
                        <strong>Username already taken!</strong> Register with a different username
                    </div>
                <?php endif; ?>


                <div class="pull-right">
                    <div class="input-group">
                        <button type="submit" class="btn btn-success btn-md">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="signUpModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign up</h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you a... </h4>
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a data-toggle="tab" href="#Student">Student</a></li>
                            <li><a data-toggle="tab" href="#Staff">Staff</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="Student" class="tab-pane fade in active">
                                <form method="POST" action="studentRegister">
                                    <div class="form-group">
                                        <label for="text">Enter First Name</label>
                                        <input type="text" class="form-control" id="stFirstName" name="stFirstName" maxlength="30" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Last Name</label>
                                        <input type="text" class="form-control" id="stLastName" name="stLastName" maxlength="30" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Student ID</label>
                                        <input type="text" class="form-control" id="stUsername" name="stUsername" maxlength="10" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Email</label>
                                        <input type="email" class="form-control" id="stEmail" name="stEmail" maxlength="200" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Password</label>
                                        <input type="password" class="form-control" id="stpwd1" name="stpwd1" maxlength="20" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Confirm password</label>
                                        <input type="password" class="form-control" id="stpwd2" name="stpwd2" maxlength="20" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Sign up</button>
                                </form>
                            </div>
                            <div id="Staff" class="tab-pane fade in">
                                <form method="POST" action="staffRegister">
                                    <div class="form-group">
                                        <label for="text">Enter First Name</label>
                                        <input type="text" class="form-control" id="kuFirstName" name="kuFirstName" maxlength="30" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Last Name</label>
                                        <input type="text" class="form-control" id="kuLastName" name="kuLastName" maxlength="30" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Staff ID</label>
                                        <input type="text" class="form-control" id="kuUsername" name="kuUsername" maxlength="10" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Email</label>
                                        <input type="email" class="form-control" id="kuEmail" name="kuEmail" maxlength="200" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Enter Password</label>
                                        <input type="password" class="form-control" id="kupwd1" name="kupwd1" maxlength="20" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="text">Confirm password</label>
                                        <input type="password" class="form-control" id="kupwd2" name="kupwd2" maxlength="20" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Sign up</button>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>

</body>
</html>