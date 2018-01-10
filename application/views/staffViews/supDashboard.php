
<div class="container-fluid">
    <?php if (isset($_GET['account'])) { ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Welcome to UniDiss, <?= $this->session->userFirstName . " " . $this->session->userLastName ?></strong>! Get started on marking work and giving feedback.
                </div>
            </div>  
        </div>
    <?php } ?>
    <h1 class="text-center">Staff Dashboard</h1>
    <div class="row">
        
<?php $this->load->view('staffViews/dashboardEvidenceFeed') ?>

        <div class="col-md-3" >
            <!--  <div class="panel panel-default">
                <div class="panel-heading"><strong>54</strong> students awaiting allocation</div>
                <div class="panel-body"><a href="#">Click to view</a></div>
              </div>-->

            <div class="panel panel-default">
                <div class="panel-heading">Supervisor group</div>
                <div class="panel-body">
                    <?php foreach ($supervisorGroup as $student) { ?>
                        <p><a href="<?= base_url("view-student/" . $student->getUsername() . "") ?>"><?= $student->getFirstName() . " " . $student->getLastName() ?> </a></p>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-2" style="background-color:blue;">
      <p> column 3 </p>
            </div> -->


    </div>

</div>


</body>

</html>
