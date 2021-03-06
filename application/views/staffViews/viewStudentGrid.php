                 
<div class="row row-mobile" > 
    <div class="col-sm-5">
        <h3 class="text-center"><?= $student->getFirstName() ?>'s Deliverables</h3>
    </div>
    <div class="col-sm-2 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="<?= base_url("view-student/" . $studentID . "?flow=list"); ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
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
                <li<?= getRequestCheckTwo('sort') ?>><a href="<?= base_url("view-student/" . $studentID) ?>">Last Updated</a></li>
                <li<?= getRequestCheck('sort') ?>><a href="<?= base_url("view-student/" . $studentID . "?sort=deadline") ?>">Deadline Date</a></li>
                <li class="divider"></li>
                <li id="hideCompleted"><a href="#">Hide Done Deliverables</a></li>
                <li id="showCompleted" class="active"><a href="#">Show Done Deliverables</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="flex-row row " id="myDeck">

    <?php foreach ($theirDeliverables as $deliverable) { ?>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">                             
            <div class="card text-center" style="margin-top: 5%;">                  
                <a href="<?= base_url("view-deliverable/" . $deliverable->getDeliverableNo() . "") ?>" style="color: black;">
                    <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/' . $deliverable->getThumbnail()) ?>" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title"><strong><?= $deliverable->getDeliverableName() ?></strong></h4>
                        <div class="card-text">
                            <p><strong>Deadline date:</strong> <?= date_format($deliverable->getDeadlineDate(), 'G:i - D j M') ?></p>
                            <p class="status"><strong>Status:</strong> <?= $deliverable->getDelstatusDesc() ?></p>
                        </div>
                    </div>                                
                    <div class="card-footer">
                        <small class="text-muted">Last updated <time class="timeago" datetime="<?= $deliverable->getLastUpdated() ?>"></time></small>
                    </div>
                </a>
            </div>                                
        </div> 

    <?php } ?>

</div>

<?php if (sizeof($theirDeliverables) == 0) { ?>
    <div class="text-center" style="padding-top: 58px;">
        <p>This student does not have any deliverables at the moment</p>
    </div>
<?php } ?>

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myDeck .myCard").filter(function () {
                $(this).toggle($(this).find(".card-title").text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#hideCompleted").on("click", function () {
            $("#myDeck .myCard .status:contains('Done')").closest('.myCard').hide();
            $("#hideCompleted").toggleClass("active", true);
            $("#showCompleted").toggleClass("active", false);
        });

        $("#showCompleted").on("click", function () {
            $("#myDeck .myCard .status:contains('Done')").closest('.myCard').show();
            $("#showCompleted").toggleClass("active", true);
            $("#hideCompleted").toggleClass("active", false);
        });
    });
</script>