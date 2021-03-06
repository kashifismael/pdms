<div class="row row-mobile" > 
    <div class="col-sm-5">
        <h3 class="text-center"><?= $student->getFirstName() ?>'s Deliverables</h3>
    </div>
    <div class="col-sm-2 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="<?= base_url("view-student/" . $studentID . ""); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
    </div>
    <div class="col-sm-2 col-xs-12 text-center">
        <div class="dropdown">
            <button class="btn btn-default btn-md dropdown-toggle btn-block" type="button" data-toggle="dropdown">Sort By
                <span class="caret"></span></button>
            <ul class="dropdown-menu" >
                <li<?= getRequestCheckTwo('sort') ?>><a href="<?= base_url("view-student/" . $studentID . "?flow=list") ?>">Last Updated</a></li>
                <li<?= getRequestCheck('sort') ?>><a href="<?= base_url("view-student/" . $studentID . "?flow=list&sort=deadline") ?>">Deadline Date</a></li>
                <li class="divider"></li>
                <li id="hideCompleted"><a href="#">Hide Done Deliverables</a></li>
                <li id="showCompleted" class="active"><a href="#">Show Done Deliverables</a></li>
            </ul>
        </div>
    </div>
</div>

<table class="table" id="myTable">
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
            <tr class="myDeliverable">
                <td class="deliverable"><?= $deliverable->getDeliverableName() ?></td>
                <td><?= date_format($deliverable->getDeadlineDate(), 'G:i - D j M') ?></td>
                <td class="status"><?= $deliverable->getDelstatusDesc() ?></td>
                <td><a href="<?= base_url("view-deliverable/" . $deliverable->getDeliverableNo() . "") ?>" class="card-text">Click to view</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (sizeof($theirDeliverables) == 0) { ?>
    <div class="text-center">
        <p>This student does not have any deliverables at the moment</p>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).find(".deliverable").text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#hideCompleted").on("click", function () {
            $("#myTable .myDeliverable .status:contains('Done')").closest('.myDeliverable').hide();
            $("#hideCompleted").toggleClass("active", true);
            $("#showCompleted").toggleClass("active", false);
        });

        $("#showCompleted").on("click", function () {
            $("#myTable .myDeliverable .status:contains('Done')").closest('.myDeliverable').show();
            $("#showCompleted").toggleClass("active", true);
            $("#hideCompleted").toggleClass("active", false);
        });
    });
</script>