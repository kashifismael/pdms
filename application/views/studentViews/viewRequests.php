     
<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">  

    <h1 class="text-center">View requests</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-time"></span><span class="hidden-xs"> Pending Requests</span></a></li>
        <li><a data-toggle="tab" href="#Dash2" id="myFunction"><span class="glyphicon glyphicon-remove-sign"></span><span class="hidden-xs"> Request responses </span> <span class="label label-primary notif <?= hideIfZero($reqResponseNumber) ?>"><?= $reqResponseNumber ?></span></a></li> 
    </ul>

    <div class="tab-content">
        <div id="Dash1" class="tab-pane fade in active">
            <div class="row row-mobile" > 
                <div class="col-xs-12 text-center">
                    <h3>Pending Requests</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">

                <table class="table" >
                    <thead>
                        <tr>
                            <th>Deliverable name</th>
                            <th>Request Type</th>
                            <th>Submitted</th>
                            <th>Reason</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll;">
                        <?php foreach ($pendingRequests as $request) { ?>
                            <tr>
                                <td><?= $request->getDeliverableName() ?></td>
                                <td><?= $request->getRequestType() ?></td>
                                <td><?= $request->getDateOfRequest() ?></td>
                                <td><?= $request->getReason() ?></td>
                                <td><a href="<?= base_url('deliverable/' . $request->getDeliverableNo()) ?>">View</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if (sizeof($pendingRequests) == 0) { ?>
                    <p>You have no pending requests</p>
                <?php } ?>

            </div>


            <!--      <div class="text-center">
                      <ul class="pagination">
                          <li><a href="#">1</a></li>
                          <li class="active"><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                      </ul>
                  </div> -->
        </div> 

        <div id="Dash2" class="tab-pane fade in">
            <div class="row row-mobile" > 
                <div class="col-xs-12 text-center">
                    <h3>Request responses</h3>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">

                <table class="table" >
                    <thead>
                        <tr>
                            <th>Deliverable name</th>
                            <th>Request Type</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="overflow-y: scroll;">
                        <?php foreach ($requestsResponses as $request) { ?>
                            <tr>
                                <td><?= $request->getDeliverableName() ?></td>
                                <td><?= $request->getRequestType() ?></td>
                                <td><?= $request->getRequestStatus() ?></td>
                                <td><a href="<?= base_url('deliverable/' . $request->getDeliverableNo()) ?>">View</a></td>
                            </tr>
                        <?php } ?>                       
                    </tbody>
                </table>
                <?php if (sizeof($requestsResponses) == 0) { ?>
                    <p>You have no request responses</p>
                <?php } ?>
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

<script>
    $(document).ready(function () {
        $("#myFunction").click(function () {
            $.post("updateRequestStatus",
                    {
                        hasBeenSeen: true
                    },
                    function (data) {
                        $(document).ajaxSuccess(function () {
                            $(".notif").hide();
                            console.log(data);
                        });
                    });

        });
    });
</script>

