<div class="row row-mobile" > 
    <div class="col-sm-6 col-xs-12">
        <h3 class="text-center">List of Evidences</h3>
    </div>
    <div class="col-sm-3 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="<?= base_url("view-deliverable/" . $deliverableID); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for Deliverable...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
    </div>
</div>
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
        <?php foreach ($myEvidences as $evidence) { ?>
            <tr>
                <td><?= $evidence->getEvidenceName() ?></td>
                <td><?= $evidence->getEvidenceStatus() ?></td>
                <td><?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></td>
                <td><a href="<?= base_url('view-evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text">Click to view</a></td>
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
