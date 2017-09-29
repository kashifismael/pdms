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
      <li<?= activeCheck("staff-home") ?>><a href="<?= base_url("staff-home?type=ml")?>">Dashboard</a></li>
      <li<?= activeCheck("student-allocation") ?>><a href="<?= base_url("student-allocation")?>">Student Allocation</a></li>
      <li><a href="#">View Supervisor group</a></li>
      <li><a href="#">Latest submissions</a></li>
      <li<?= activeCheck("manage-requests") ?>><a href="<?= base_url("manage-requests")?>">Manage requests</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Account settings</a></li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
</nav>