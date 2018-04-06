     
<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">  

    <?php
    if (isset($_SESSION['requestRejection'])) {
        ?>
        <div class="row">
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Successfully rejected Request!</strong>
            </div>
        </div>
    <?php } ?>
    <?php
    if (isset($_SESSION['deadlineRequestApproval'])) {
        ?>
        <div class="row">
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Successfully approved Deadline Request!</strong>
            </div>
        </div>
    <?php } ?>

    <div class="row" id="requestSuccessNotif" style="display: none;">
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Successfully processed request responses!</strong>
        </div>
    </div>

    <h1 class="text-center">Manage requests</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Deadline Changes</span> <span id="deadlineReqNumber" class="label label-primary <?= hideIfZero($deadlineReqNumber) ?>"><?= $deadlineReqNumber ?></span></a></li>
        <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-remove-sign"></span><span class="hidden-xs"> Delete Deliverable</span> <span id="deleteReqNumber" class="label label-primary <?= hideIfZero($deleteReqNumber) ?>"><?= $deleteReqNumber ?></span></a></li> 
        <li><a data-toggle="tab" href="#Dash3"><span class="glyphicon glyphicon-backward"></span><span class="hidden-xs"> Previous Requests</span></a></li> 
    </ul>

    <div class="tab-content">
        <div id="Dash1" class="tab-pane fade in active">
            <div class="row row-mobile" > 
                <div class="col-xs-12 text-center">
                    <h3>Deadline Change Requests</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Student name</th>
                            <th>Deliverable name</th>
                            <th>Current Date</th>
                            <th>Requested Date</th>
                            <th>Reason</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll;">
                        <?php foreach ($deadlineRequests as $request) { ?>
                            <tr data-request="<?= $request->getRequestNo() ?>" id="request<?= $request->getRequestNo() ?>">                    
                                <td>
                                    <a href="<?= base_url("view-student/" . $request->getStudentUsername()) ?>"><?= $request->getStudentName() ?></a> 
                                </td>
                                <td>
                                    <a href="<?= base_url("view-deliverable/" . $request->getDeliverableNo()) ?>"><?= $request->getDeliverableName() ?></a>
                                </td>
                                <td>
                                    <?= $request->formattedCurrentDeadline() ?>
                                </td>
                                <td>
                                    <?= $request->formattedRequestedDeadline() ?>
                                </td>
                                <td><?= $request->getReason() ?></td>
                                <td>
                                    <input class="deadlineRadio" type="radio" name="row<?= $request->getRequestNo() ?>" value="Approve">
                                </td>
                                <td>
                                    <input class="deadlineRadio" type="radio" name="row<?= $request->getRequestNo() ?>" value="Reject">
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                <?php if (sizeof($deadlineRequests) == 0) { ?>
                    <div class="text-center">
                        <p>You have no deadline requests awaiting approval</p>
                    </div>
                <?php } ?>

            </div>

            <button id="deadlineResponse" type="submit" class="btn btn-success" disabled>Save Changes</button>
        </div> 

        <div id="Dash2" class="tab-pane fade in">
            <div class="row row-mobile" >
                <div class="col-xs-12 text-center">
                    <h3>Delete Deliverable Requests</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Student name</th>
                            <th>Deliverable name</th>
                            <th>Reason</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll;">
                        <?php foreach ($deleteRequests as $delRequest) { ?>
                            <tr data-request="<?= $delRequest->getRequestNo() ?>" id="request<?= $delRequest->getRequestNo() ?>">
                                <td>
                                    <a href="<?= base_url("view-student/" . $delRequest->getStudentUsername()) ?>"><?= $delRequest->getStudentName() ?></a>                                
                                </td>
                                <td>
                                    <a href="<?= base_url("view-deliverable/" . $delRequest->getDeliverableNo()) ?>"><?= $delRequest->getDeliverableName() ?></a>
                                </td>
                                <td><?= $delRequest->getReason() ?></td>
                                <td>
                                    <input class="deleteRadio" type="radio" name="row<?= $delRequest->getRequestNo() ?>" value="Approve">
                                </td>
                                <td>
                                    <input class="deleteRadio" type="radio" name="row<?= $delRequest->getRequestNo() ?>" value="Reject">
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                <?php if (sizeof($deleteRequests) == 0) { ?>
                    <div class="text-center">
                        <p>You have no delete requests awaiting approval</p>
                    </div>
                <?php } ?>
            </div>
            <button id="deleteResponse" type="submit" class="btn btn-success" disabled>Save Changes</button>
        </div>   

        <div id="Dash3" class="tab-pane fade in">
            <div class="row row-mobile" >
                <div class="col-xs-12 text-center">
                    <h3>Previous Requests</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
                <table class="table" >
                    <thead>
                        <tr>
                            <th>Student name</th>
                            <th>Deliverable name</th>
                            <th>Submitted</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll;">
                        <?php foreach ($previousRequests as $request): ?>
                            <tr>
                                <td><?= $request->getStudentName() ?></td>
                                <td><?= $request->getDeliverableName() ?></td>
                                <td><?= $request->getDateOfRequest() ?></td>
                                <td><?= $request->getRequestType() ?></td>
                                <td><?= $request->getRequestStatus() ?></td>
                                <td><a href="<?= base_url("view-deliverable/" . $request->getDeliverableNo()) ?>">View</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div> 

    </div>    


    <div id="processingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Processing Requests...</h4>
                </div>
                <div class="modal-body">
                    <div class="loader"></div>
                </div>

            </div>
        </div>

    </div>  

    <script src="<?= base_url("js/manageRequests.js") ?>"></script>

</body>
</html>