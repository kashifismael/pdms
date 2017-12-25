     
<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">  

    <h1 class="text-center">Manage requests</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Deadline Changes</span></a></li>
        <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-remove-sign"></span><span class="hidden-xs"> Deletion Requests</span></a></li> 
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
                                <td><form method="post" action="processDeadlineExtension">
                                    <input type="hidden" name="delID" value="<?= $request->getDeliverableNo() ?>">
                                    <input type="hidden" name="reqID" value="<?= $request->getRequestNo() ?>">
                                    <input type="hidden" name="reqDeadline" value="<?= $request->getRequestedDeadlineDate() ?>">
                                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>
                                </form></td>
                                <td><form method="post" action="rejectDeadlineExtension">
                                    <input type="hidden" name="delID" value="<?= $request->getDeliverableNo() ?>">
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
            <div class="row row-mobile" > <!-- doesnt show well on mobile -->
                <!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
                <div class="col-xs-12 text-center">
                    <h3>Deletion Requests</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
                <!-- <div class="table-feed"> -->
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



    </div>    


</div>  
</body>
</html>