<div class="container-fluid">
    <div class="row row-mobile" >
        <div class="text-center">
            <h1><?= $deliverableInfo->getDeliverableName() ?></h1>
        </div>
    </div>

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
                <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h3></div>
                <div class="panel-body">
                    <p><label>Student:</label> <?= $deliverableInfo->getStudentName() ?></p>
                    <p><label>Deliverable:</label> <?= $deliverableInfo->getDeliverableName() ?></p>
                    <p><label>Deadline date:</label> <?= date_format($deliverableInfo->getDeadlineDate(), 'G:i - D j M') ?></p>
                    <p><label>Status:</label> <?= $deliverableInfo->getDelstatusDesc() ?></p>
                </div>
            </div>

            <div class="text-center">
                <button data-toggle="modal" data-target="#statusModal"
                        class="btn btn-primary navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
                    <span class="glyphicon glyphicon-pencil"></span> Update Status of <?= $deliverableInfo->getDeliverableName() ?></button>
            </div>     
            <p>Display deliverable <?= $deliverableID ?></p>
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
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                            <tr>
                                <td>Prototype</td>
                                <td>6 days ago</td>
                                <td>6</td>
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                            <tr>
                                <td>July</td>
                                <td>Dooley</td>
                                <td>5</td>
                                <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <p>select all from evidence, inner join deliverable, where deliverable no is = <?= $deliverableID ?></p>
                </div>

            </div>
        </div>

    </div>
</div>