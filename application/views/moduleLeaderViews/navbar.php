<body style="padding-top: 70px;">
<nav class="navbar navbar-inner navbar-fixed-top navbar-inverse">
<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <span><img id="logo"  src="<?= base_url("images/unidissLogo.png")?>" height="28">
            UniDiss</span></a>
    </div>
<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li<?= activeCheck("staff-home") ?>><a href="<?= base_url("staff-home")?>">Dashboard</a></li>
      <li<?= activeCheck("latest-submissions") ?>><a href="<?= base_url("latest-submissions")?>">Latest submissions <span class="label label-primary">3</span></a></li>
    <!--  <li><a href="#">View Supervisor group</a></li> -->
      <li<?= activeCheck("manage-requests") ?>><a href="<?= base_url("manage-requests")?>">Manage requests <span class="label label-primary">1</span></a></li>
      <li<?= activeCheck("student-allocation") ?>><a href="<?= base_url("student-allocation")?>">Student Allocation <span class="label label-primary">1</span></a></li>
      <li class="dropdown <?= activeCheckTwo("all-supervisors","student-allocation") ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">More <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li<?= activeCheck("all-supervisors") ?>><a href="<?= base_url("all-supervisors")?>">View All Supervisors</a></li>
       <!--   <li<!?= activeCheck("student-allocation") ?>><a href="<!?= base_url("student-allocation")?>">Student Allocation <span class="label label-primary">1</span></a></li> -->
          <li><a href="#">View All Students</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

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