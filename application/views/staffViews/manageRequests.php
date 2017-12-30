     
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

    <h1 class="text-center">Manage requests</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Deadline Changes</span> <span class="label label-primary <?= hideIfZero($deadlineReqNumber) ?>"><?= $deadlineReqNumber ?></span></a></li>
        <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-remove-sign"></span><span class="hidden-xs"> Delete Deliverable</span> <span class="label label-primary <?= hideIfZero($deleteReqNumber) ?>"><?= $deleteReqNumber ?></span></a></li> 
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
                            <tr>                    
                                <td><?= $request->getStudentName() ?></td>
                                <td><?= $request->getDeliverableName() ?></td>
                                <td><?= $request->getCurrentDeadlineDate() ?></td>
                                <td><?= $request->getRequestedDeadlineDate() ?></td>
                                <td><?= $request->getReason() ?></td>
                                <td><form method="post" action="approveDeadlineExtension">
                                        <input type="hidden" name="delID" value="<?= $request->getDeliverableNo() ?>">
                                        <input type="hidden" name="reqID" value="<?= $request->getRequestNo() ?>">
                                        <input type="hidden" name="reqDeadline" value="<?= $request->getRequestedDeadlineDate() ?>">
                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>
                                    </form></td>
                                <td><form method="post" action="rejectRequestProcess">
                                        <input type="hidden" name="reqID" value="<?= $request->getRequestNo() ?>">
                                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>
                                    </form></td>
                            </tr>

                        <?php } ?>
                        <tr>
                            <td>Kashif Ismael</td>
                            <td>Report</td>
                            <td>01/09/17</td>
                            <td>31/09/17</td>
                            <td>I just really need the time bro</td>
                            <td><a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </a></td>
                            <td><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>
                        </tr>
                        <tr>
                            <td>Eden Hazard</td>
                            <td>Prototype</td>
                            <td>01/09/17</td>
                            <td>31/09/17</td>
                            <td>I also need the time</td>
                            <td><a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </a></td>
                            <td><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
            </div>
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
                            <tr>
                                <td><?= $delRequest->getStudentName() ?></td>
                                <td><?= $delRequest->getDeliverableName() ?></td>
                                <td><?= $delRequest->getReason() ?></td>
                                <td><form method="post" action="approveDelete">
                                        <input type="hidden" name="delID" value="<?= $delRequest->getDeliverableNo() ?>">
                                        <input type="hidden" name="reqID" value="<?= $delRequest->getRequestNo() ?>">
                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>
                                    </form></td>
                                <td><form method="post" action="rejectRequestProcess">
                                        <input type="hidden" name="reqID" value="<?= $delRequest->getRequestNo() ?>">
                                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>
                                    </form></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>Romelu Lukaku</td>
                            <td>Proposal</td>
                            <td>I dont need this anymore</td>
                            <td><a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </a></td>
                            <td><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>
                        </tr>
                        <tr>
                            <td>Luis Suarez</td>
                            <td>Application</td>
                            <td>i want to change my fyp idea</td>
                            <td><a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </a></td>
                            <td><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
            </div>
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
                        <tr>
                            <td>Romelu Lukaku</td>
                            <td>Proposal</td>
                            <td>Mon 17 Dec</td>
                            <td>Delete</td>
                            <td>Rejected</td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>Luis Suarez</td>
                            <td>Application</td>
                            <td>Tue 3 Nov</td>
                            <td>Deadline</td>
                            <td>Accepted</td>
                            <td><a href="#">View</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div> 

    </div>    


</div>  
</body>
</html>