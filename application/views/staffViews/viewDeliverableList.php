<div class="row row-mobile" > 
    <div class="col-sm-6 col-xs-12">
        <h3 class="text-center"><?= $deliverableInfo->getDeliverableName() ?> - List of Evidences</h3>
    </div>
    <div class="col-sm-3 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="<?= base_url("view-deliverable/" . $deliverableID); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <!--     <div class="input-group"> -->
        <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
 <!--       <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
        </span> -->
        <!--    </div> -->
    </div>
</div>
<table class="table" id="myTable">
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
                <td class="evidence"><?= $evidence->getEvidenceName() ?></td>
                <td><?= $evidence->getEvidenceStatus() ?></td>
                <td><?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></td>
                <td><a href="<?= base_url('view-evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text">Click to view</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (sizeof($myEvidences) == 0) { ?>
    <div class="text-center">
        <p>This student has not submitted any pieces of evidence towards this deliverable</p>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).find(".evidence").text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>