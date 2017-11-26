<div class="container-fluid">    
    <ol class="breadcrumb" style="padding-left: 10%;">
        <li class="active">View Student</li>
    </ol>
  <!--  <div class="row row-mobile"> 
        <div class="text-center">
            <h1><!--?= $student->getFirstName() . " " . $student->getLastName() ?></h1>
        </div>
    </div> -->
    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Student Info</h4></div>
                <div class="panel-body">
                    <p><label>Name:</label> <?= $student->getFirstName() . " " . $student->getLastName() ?></p>
                    <p><label>K Number:</label> <?= $student->getUsername() ?></p>
                    <p><label>Email Address:</label> <?= $student->getEmail() ?></p>
                </div>
            </div>
            <p>Display deliverables of <?= $studentID ?> </p>
        </div>
        <div class="col-md-8" >

            <?php
            if (isset($_GET['flow']) && $_GET['flow'] == "list") {
                $this->load->view('staffViews/viewStudentList');
            } else {
                $this->load->view('staffViews/viewStudentGrid');
            }
            ?>

        </div>
    </div>
</div>
<div style="padding-bottom: 30px;"></div>
</body>



</html>