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
    <?php
    if (isset($_SESSION['requestSubmission'])) {
        ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Successfully submitted Request!</strong>
                </div>
            </div>  
        </div>
    <?php } ?>

    <ol class="breadcrumb hidden-xs" style="padding-left: 10%;">
        <li><a href="<?= base_url('student-home') ?>"> Dashboard</a></li>
        <li class="active">View Deliverable</li>
    </ol>

    <div class="row row-mobile" >
        <div class="text-center">
            <h3 class="visible-xs"><?= $deliverableInfo->getDeliverableName() ?></h3>
            <!--      <h1 class="hidden-xs"><!?= $deliverableInfo->getDeliverableName() ?></h1> -->
        </div>
    </div>
    <div class="row row-mobile" > 
        <div class="col-xs-12 text-center">
            <button data-toggle="modal" data-target="#newEvidUpModal"
                    class="btn btn-success navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
                <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
        </div>
    </div> 

    <div class="row row-mobile" > 
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
        </div>
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
        </div>
    <!--    <div class="col-xs-6"><p class="visible-xs visible-sm"></p></div>  -->
    </div>
    <div style="padding-top: 10px"></div>
    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h3></div>
                <div class="panel-body">
                    <p><label>Name:</label> <?= $deliverableInfo->getDeliverableName() ?></p>
                    <p><label>Deadline date:</label> <?= date_format($deliverableInfo->getDeadlineDate(), 'G:i - D j M') ?></p>
                    <p><label>Status:</label> <?= $deliverableInfo->getDelstatusDesc() ?></p>
                    <p><label>Last Updated:</label> <time class="timeago" datetime="<?= $deliverableInfo->getLastUpdated() ?>"></time></p>

                </div>
            </div>

            <div class="text-center">
                <button data-toggle="modal" data-target="#newEvidUpModal"
                        class="btn btn-success navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
                    <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
                <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
                <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
            </div>     
        </div>
        <div class="col-md-8" >
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> View Evidences</span></a></li>
                <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-tasks"></span><span class="hidden-xs"> View Feedback</span></a></li>
                <li><a data-toggle="tab" href="#Dash3"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Deadline Requests</span></a></li>
                <li><a data-toggle="tab" href="#Dash4"><span class="glyphicon glyphicon-remove-sign"></span><span class="hidden-xs"> Delete Requests</span></a></li>
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

                    <h3 class="hidden-xs pull-left" style="padding-left: 10%">All Feedbacks</h3>
                    <h3 class="visible-xs text-center">All Feedbacks</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date Received</th>
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
                                            <button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?> 
                        </tbody>
                    </table>

                    <?php if (sizeof($myFeedbacks) == 0) { ?>
                        <div class="text-center">
                            <p> You have not received any feedback for this deliverable</p>
                        </div>
                    <?php } ?>

                </div>               

                <div id="Dash3" class="tab-pane fade in">
                    <h3>Deadline requests</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Requested Deadline</th>
                                <th>Reason</th>
                                <th>Submitted</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deadlineRequests as $request): ?>
                                <tr>
                                    <td><?= $request->getRequestedDeadlineDate() ?></td>
                                    <td><?= $request->getReason() ?></td>
                                    <td><?= $request->getDateOfRequest() ?></td>
                                    <td><?= $request->getRequestStatus() ?></td>
                                </tr>
                            <?php endforeach; ?>                           
                        </tbody>
                    </table>

                    <?php if (sizeof($deadlineRequests) == 0) : ?>
                        <div class="text-center">
                            <p>There are no deadline requests for this deliverable </p>
                        </div>
                    <?php endif; ?>

                </div>

                <div id="Dash4" class="tab-pane fade in">
                    <h3>delete requests</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reason</th>
                                <th>Submitted</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deleteRequests as $request): ?>
                                <tr>
                                    <td><?= $request->getReason() ?></td>
                                    <td><?= $request->getDateOfRequest() ?></td>
                                    <td><?= $request->getRequestStatus() ?></td>
                                </tr>
                            <?php endforeach; ?>   
                        </tbody>
                    </table>

                    <?php if (sizeof($deleteRequests) == 0) : ?>
                        <div class="text-center">
                            <p>There are no delete requests for this deliverable </p>
                        </div>
                    <?php endif; ?>

                </div>

            </div>


        </div>
    </div>
</div>
