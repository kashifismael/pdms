<div class="row row-mobile">
    <div class="col-sm-6 col-xs-12">
        <h3 class="text-center"><?= $deliverableInfo->getDeliverableName() ?> - List of Evidences</h3>
    </div>
    <div class="col-sm-3 col-xs-12 text-center" >
        <strong>View</strong>
        <div class="btn-group">
            <a href="<?= base_url("view-deliverable/" . $deliverableID . "?flow=list"); ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
            <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>
    <div class="col-sm-3 col-xs-12">
    <!--    <div class="input-group"> -->
            <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
      <!--      <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
            </span> -->
    <!--    </div> -->
    </div>
</div>

<div class="flex-row row" id="myDeck">
    <?php foreach ($myEvidences as $evidence) { ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
            <div class="card text-center" style="margin-top: 5%;">
                <a href="<?= base_url('view-evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text" style="color: black;">
                    <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/thumbnail' . rand(1, 13)) ?>" alt="Card image cap">
                </a>
                <div class="card-block">
                    <a href="<?= base_url('view-evidence/' . $evidence->getEvidenceNo()) ?>" class="card-text" style="color: black;">
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
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
        <div class="card text-center" style="margin-top: 5%;">
      <!-- <img class="card-img-top center-block" src="../images/computer-icon-1031.png" alt="Card image cap" width="100" > -->
            <div class="card-block">
                <h4 class="card-title">Draft1</h4>
                <p><label>Status:</label> Not finished</p>
                <p><label>Type:</label> Draft</p>
                <p class="text-muted">Last updated 6 days ago</p>
            </div>
            <div class="card-footer">
                <a href="<?= base_url("view-evidence/123"); ?>" class="card-text">Click to view</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
        <div class="card text-center" style="margin-top: 5%;">
      <!-- <img class="card-img-top center-block" src="..." alt="Card image cap"> -->
            <div class="card-block">
                <h4 class="card-title">ProposalProof</h4>
                <p><label>Status:</label> None</p>
                <p><label>Type:</label> Evidence</p>
                <p class="text-muted">Last updated 3 mins ago</p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-text">Click to view</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
        <div class="card text-center" style="margin-top: 5%;">
      <!-- <img class="card-img-top center-block" src="..." alt="Card image cap"> -->
            <div class="card-block">
                <h4 class="card-title">Plan</h4>
                <p><label>Status:</label> Submitted</p>
                <p><label>Type:</label> Exectable file</p>
                <p class="text-muted">Last updated 3 days ago</p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-text">Click to view</a>
            </div>
        </div>
    </div>
    <!--/div-->
</div>

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