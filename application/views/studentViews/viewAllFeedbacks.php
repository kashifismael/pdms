<div class="container-fluid">
    <!-- <h1>View all Feedbacks</h1> -->
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1"> 
            <div class="row row-mobile" >
                <div class="col-sm-6 col-xs-12">
                    <h1 class="text-center">List of Feedbacks</h1>
                </div>
                <div class="col-sm-3 col-xs-12 text-center" >
                    <strong>View</strong>
                    <div class="btn-group">
                        <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
                        <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <input id="myInput" type="text" class="form-control" placeholder="Search for Feedback...">
                </div>
            </div>

            <h2>Unseen Feedbacks</h2>
            <div class="flex-row row" id="myDeck">
                <?php
                foreach ($unseenFeedbacks as $feedback) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
                        <div class="card text-center" style="margin-top: 5%;">
                            <a href="<?= base_url('evidence/' . $feedback->getEvidenceID()) ?>" class="card-text" style="color: black;">        
                                <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/' . $feedback->getThumbnail()) ?>" alt="Card image cap">
                            </a>
                            <div class="card-block">
                                <a href="<?= base_url('evidence/' . $feedback->getEvidenceID()) ?>" style="color: black;">
                                    <p><label>Deliverable:</label> <?= $feedback->getDeliverableName() ?></p>
                                    <p><label>Evidence:</label> <?= $feedback->getEvidenceName() ?></p>

                                </a> 
                                <form method="POST" action="<?= base_url('downloadFeedback') ?>">
                                    <input type="hidden" name="feedbackID" value="<?= $feedback->getFeedbackID() ?>">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Received <time class="timeago" datetime="<?= $feedback->getFeedbackDate() ?>"></time></small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php if (sizeof($unseenFeedbacks) == 0) { ?>
                <p>You have no unseen feedbacks</p>
            <?php } ?>

            <h2>Seen Feedbacks</h2>
            <div class="flex-row row">
                <?php
                foreach ($seenFeedbacks as $feedback) {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">
                        <div class="card text-center" style="margin-top: 5%;">
                            <a href="<?= base_url('evidence/' . $feedback->getEvidenceID()) ?>" class="card-text" style="color: black;">        
                                <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/' . $feedback->getThumbnail()) ?>" alt="Card image cap">
                            </a>
                            <div class="card-block">
                                <a href="<?= base_url('evidence/' . $feedback->getEvidenceID()) ?>" style="color: black;">
                                    <p><label>Deliverable:</label> <?= $feedback->getDeliverableName() ?></p>
                                    <p><label>Evidence:</label> <?= $feedback->getEvidenceName() ?></p>

                                </a> 
                                <form method="POST" action="<?= base_url('downloadEvidence') ?>">
                                    <input type="hidden" name="evidID" value="<?= $feedback->getEvidenceID() ?>">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Received <time class="timeago" datetime="<?= $feedback->getFeedbackDate() ?>"></time></small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php if (sizeof($seenFeedbacks) == 0) { ?>
                <p>You have no previous feedbacks</p>
            <?php } ?>

        </div>
    </div>

</div>