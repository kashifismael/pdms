
<div class="container-fluid">

    <?php $this->load->view('staffViews/viewDeliverableInfo') ?>

    <div class="col-md-8" >
        <div class="panel panel-default" style="height : 700px;">
            <div class="panel-heading">
                <h3 class="text-center">List of Evidences</h3>
                <div class="row row-mobile" > <!-- doesnt show well on mobile -->
                    <!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
                    <div class="col-sm-6 col-xs-12 text-center" >
                        <!--div class="well well-sm"-->
                        <strong>View</strong>
                        <div class="btn-group">
                            <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
                            <a href="<?= base_url("view-deliverable/" . $deliverableID); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
                        </div>
                        <!--/div-->
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for Deliverable...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Evidence name</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($myEvidences as $evidence){ ?>
                            <tr>
                                <td><?= $evidence->getEvidenceName() ?></td>
                                <td><?= $evidence->getEvidenceStatus() ?></td>
                                <td><?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></td>
                                <td><a href="<?= base_url('view-evidence/'.$evidence->getEvidenceNo()) ?>" class="card-text">Click to view</a></td>
                            </tr>
                            <?php } ?>
                        <tr>
                            <td>Draft1</td>
                            <td>Not finished</td>
                            <td>6 days ago</td>
                            <td><a href="#" class="card-text">Click to view</a></td>
                        </tr>
                        <tr>
                            <td>ProposalProof</td>
                            <td>None</td>
                            <td>3 mins ago</td>
                            <td><a href="#" class="card-text">Click to view</a></td>
                        </tr>
                        <tr>
                            <td>Plan</td>
                            <td>Submitted</td>
                            <td>3 days ago</td>
                            <td><a href="#" class="card-text">Click to view</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- <div class="col-md-2" style="background-color:blue;">
  <p> column 3 </p>
        </div> -->


</div>

</div>





