<div class="row row-mobile" >
    <div class="col-sm-6 col-xs-12">
        <h3 class="text-center"><?= $deliverableInfo->getDeliverableName() ?> - List of Evidences</h3>
    </div>
    <div class="col-sm-3 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="<?= base_url("deliverable/" . $delID . "?flow=list"); ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
        <!--    <div class="input-group"> -->
        <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
   <!--     <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
        </span> -->
        <!--   </div> -->
    </div>
</div>

<div class="flex-row row" id="myDeck">
    <?php foreach ($myEvidences as $evidence) { ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
            <div class="card text-center" style="margin-top: 5%;">
                <a href="<?= base_url('evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text" style="color: black;">        
                    <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/' . $evidence->getThumbnail()) ?>" alt="Card image cap">
                </a>
                <div class="card-block">
                    <a href="<?= base_url('evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text" style="color: black;">
                        <h4 class="card-title"><?= $evidence->getEvidenceName() ?></h4>
                        <p><strong>Status:</strong> <?= $evidence->getEvidenceStatus() ?></p>
                        <p><strong>Submitted:</strong> <?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></p>
                    </a>
                    <form method="POST" action="<?= base_url('downloadEvidence') ?>">
                        <input type="hidden" name="evidID" value="<?= $evidence->getEvidenceNo() ?>">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
                    </form>
                </div>

            </div>
        </div>
    <?php } ?>
</div>

<?php if (sizeof($myEvidences) == 0) { ?>
    <div class="text-center" style="padding-top: 58px">
        <p> You have no evidences at the moment, click below to submit pieces of evidence</p>
        <button data-toggle="modal" data-target="#newEvidUpModal"
                class="btn btn-success navbar-btn btn-text-wrap">
            <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
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
    });
</script>
