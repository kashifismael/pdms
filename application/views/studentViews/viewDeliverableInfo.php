<div class="container-fluid">

    <?php
    if (isset($_SESSION['evidenceCreation'])) {
        ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Successfully uploaded Evidence!</strong>
                </div>
            </div>  
        </div>
    <?php } ?>

    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="text-center">
            <h1><?= $deliverableInfo->getDeliverableName() ?></h1>
        </div>
    </div>
    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="col-xs-12 text-center">
            <button data-toggle="modal" data-target="#newEvidUpModal"
                    class="btn btn-success navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
                <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
        </div>
    </div>

    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
        </div>
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
        </div>
        <div class="col-xs-6"><p class="visible-xs visible-sm"></p></div>  
    </div>
    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h3></div>
                <div class="panel-body">
                    <p><label>Name:</label> <?= $deliverableInfo->getDeliverableName() ?></p>
                    <p><label>Deadline date:</label> <?= date_format($deliverableInfo->getDeadlineDate(), 'G:i - D j M') ?></p>
                    <p><label>Status:</label> <?= $deliverableInfo->getDelstatusDesc() ?></p>
                </div>
            </div>

            <div class="text-center">
                <button data-toggle="modal" data-target="#newEvidUpModal"
                        class="btn btn-success navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
                    <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
                <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
                <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
            </div>     

            <p>Display deliverable <?= $delID ?></p>
        </div>
        <div class="col-md-8" >
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> View Evidences</span></a></li>
                <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-tasks"></span><span class="hidden-xs"> View Feedback</span></a></li>
            </ul>     

            <div class="tab-content">

                <div id="Dash1" class="tab-pane fade in active">

                    <?php
                    if (isset($_GET['flow']) && $_GET['flow'] == "list") {
                        $this->load->view('studentViews/viewDeliverableList');
                    } else {
                        $this->load->view('studentViews/viewDeliverableGrid');
                    }
                    ?>

                </div>
                <div id="Dash2" class="tab-pane fade">

                    <h1>All Feedbacks</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Deliverable Type</th>
                                <th>Last Updated</th>
                                <th>No. of items</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Proposal</td>
                                <td>3 days ago</td>
                                <td>6</td>
                                <td><a href="#" class="card-text">Click to view</a></td>
                            </tr>
                            <tr>
                                <td>Prototype</td>
                                <td>6 days ago</td>
                                <td>6</td>
                                <td><a href="#" class="card-text">Click to view</a></td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>5</td>
                                <td><a href="#" class="card-text">Click to view</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <p>select all from evidence, inner join deliverable, where deliverable no is = <?= $delID ?></p>
                </div>
            </div>


        </div>
    </div>
</div>
