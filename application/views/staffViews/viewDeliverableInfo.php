<div class="container-fluid">
    <?php
    if (isset($_SESSION['statusUpdate'])) {
        ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Successfully updated Status!</strong>
                </div>
            </div>  
        </div>
    <?php } ?>
    <ol class="breadcrumb" style="padding-left: 10%;">
        <li><a href="<?= base_url('staff-home')?>"> Dashboard</a></li>
        <li><a href="<?= base_url('view-student/' . $deliverableInfo->getStudentID()) ?>">View Student</a></li>
        <li class="active">View Deliverable</li>
    </ol>
    <div class="row row-mobile" > 
        <div class="col-xs-12 text-center">
            <button data-toggle="modal" data-target="#statusModal"
                    class="btn btn-primary navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
                <span class="glyphicon glyphicon-pencil"></span> Update Status of <?= $deliverableInfo->getDeliverableName() ?></button>
        </div>
    </div>

    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h4></div>
                <div class="panel-body">
                    <p><label>Student:</label> <?= $deliverableInfo->getStudentName() ?></p>
                    <p><label>Deliverable:</label> <?= $deliverableInfo->getDeliverableName() ?></p>
                    <p><label>Deadline date:</label> <?= date_format($deliverableInfo->getDeadlineDate(), 'G:i - D j M') ?></p>
                    <p><label>Status:</label> <?= $deliverableInfo->getDelstatusDesc() ?></p>
                    <p><label>Last Updated:</label> <time class="timeago" datetime="<?= $deliverableInfo->getLastUpdated() ?>"></time></p>
                </div>
            </div>

            <div class="text-center">
                <button data-toggle="modal" data-target="#statusModal"
                        class="btn btn-primary navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
                    <span class="glyphicon glyphicon-pencil"></span> Update Status of <?= $deliverableInfo->getDeliverableName() ?></button>
            </div>     
        </div> 

        <div class="col-md-8">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> View Evidences</span></a></li>
                <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-tasks"></span><span class="hidden-xs"> View Feedback</span></a></li>
            </ul>   
            <div class="tab-content">
                <div id="Dash1" class="tab-pane fade in active">
                    <?php
                    if (isset($_GET['flow']) && $_GET['flow'] == "list") {
                        $this->load->view('staffViews/viewDeliverableList');
                    } else {
                        $this->load->view('staffViews/viewDeliverableGrid');
                    }
                    ?>
                </div>
                <div id="Dash2" class="tab-pane fade">
                    <h3 class="pull-left" style="padding-left: 10%">All Feedbacks</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($myFeedbacks as $feedback) {
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= date_format($feedback->getFeedbackDate(), 'G:i - D j M') ?></td>
                                    <td>
                                        <form method="POST" action="<?= base_url('downloadFeedback') ?>">
                                            <input type="hidden" name="feedbackID" value="<?= $feedback->getFeedbackID() ?>">
                                            <button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?> 
                            <tr>
                                <td>Proposal</td>
                                <td>3 days ago</td>
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                            <tr>
                                <td>Prototype</td>
                                <td>6 days ago</td>
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>