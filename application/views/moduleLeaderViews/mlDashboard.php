
<div class="container-fluid">
    <h1 class="text-center">Module Leader Dashboard</h1>
    <div class="row">

        <?php $this->load->view('staffViews/dashboardEvidenceFeed') ?>

        <div class="col-md-3" >
            <div class="panel panel-default">
                <div class="panel-heading"><strong><?= $unAllocatedStudentsNumber ?></strong> students awaiting allocation</div>
                <div class="panel-body"><a href="<?= base_url('student-allocation') ?>">Click to view</a></div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Supervisor group</div>
                <div class="panel-body">
                    <?php foreach ($supervisorGroup as $student) { ?>
                        <p><a href="<?= base_url("view-student/" . $student->getUsername() . "") ?>"><?= $student->getFirstName() . " " . $student->getLastName() ?> </a></p>
                    <?php } ?>
                    <p>Student 2</p>
                    <p>Student 3</p>
                    <p>Student 4</p>
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
