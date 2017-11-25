<div class="row row-mobile" > 
    <div class="col-sm-6">
        <h3 class="text-center">Deliverables</h3>
    </div>
    <div class="col-sm-3 col-xs-12 text-center" >
        <!--div class="well well-sm"-->
        <strong>View</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="<?= base_url("view-student/" . $studentID . ""); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
        <!--/div-->
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
            <th>Deliverable Name</th>
            <th>Deadline Date</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($theirDeliverables as $deliverable) { ?>
            <tr>
                <td><?= $deliverable->getDeliverableName() ?></td>
                <td><?= date_format($deliverable->getDeadlineDate(), 'G:i - D j M') ?></td>
                <td><?= $deliverable->getDelstatusDesc() ?></td>
                <td><a href="<?= base_url("view-deliverable/" . $deliverable->getDeliverableNo() . "") ?>" class="card-text">Click to view</a></td>
            </tr>
        <?php } ?>
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
            <td>july@example.com</td>
            <td><a href="#" class="card-text">Click to view</a></td>
        </tr>
    </tbody>
</table>
