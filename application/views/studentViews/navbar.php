<body style="padding-top: 70px;">
    <nav class="navbar navbar-inner navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="top" class="navbar-brand" href="#">
                    <span><img id="logo"  src="<?= base_url("images/unidissLogo.png") ?>" height="28">
                        UniDiss</span></a>
                <div class="visible-xs pull-right">
                    <button data-placement="bottom" data-toggle="popover"
                            data-container="body" type="button" data-trigger="focus"
                            data-html="true" id="newButton1"
                            class="btn btn-success navbar-btn">
                        <span class="glyphicon glyphicon-plus"></span> New</button>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li<?= activeCheck("student-home") ?>><a href="<?= base_url("student-home"); ?>">Dashboard</a></li>
                    <!--li<!?= activeCheck("view-all-evidence") ?>><a href="<!?= base_url("view-all-evidence"); ?>">View Evidences</a></li-->
                    <li<?= activeCheck("view-all-feedback") ?>><a href="<?= base_url("view-all-feedback"); ?>">View Feedbacks <span class="label label-primary <?= hideIfZero($unSeenFeedbackNumber) ?>" ><?= $unSeenFeedbackNumber ?></span></a></li>
                    <li<?= activeCheck("view-requests") ?>><a href="<?= base_url('view-requests') ?>">View Requests <span class="label label-primary notif <?= hideIfZero($reqResponseNumber) ?>" ><?= $reqResponseNumber ?></span></a></li>
                    <li<?= activeCheck("view-supervisor") ?>><a href="<?= base_url("view-supervisor"); ?>">View Supervisor</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-xs">
                        <button data-placement="bottom" data-toggle="popover"
                                data-container="body" type="button" data-trigger="focus"
                                data-html="true" id="newButton2"
                                class="btn btn-success navbar-btn">
                            <span class="glyphicon glyphicon-plus"></span> New</button>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Account settings</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="<?= base_url("logout"); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>