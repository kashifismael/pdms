<div class="container-fluid">

    <?php $this->load->view('studentViews/notifications') ?>

    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1"> 
            <div class="row row-mobile" >
                <div class="col-sm-5 col-xs-12 text-center">
                    <h3 class="visible-xs">Welcome back, <?= $this->session->userFirstName ?></h3>
                    <h2 class="hidden-xs">Welcome back, <?= $this->session->userFirstName ?></h2>
                </div>
                <div class="col-sm-2 col-xs-12 text-center" >
                    <strong>View</strong>
                    <div class="btn-group">
                        <a href="<?= base_url('student-home?flow=list') ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
                        <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
                </div>
                <div class="col-sm-2 col-xs-12 text-center" style="position: relative">
                    <div class="dropdown">
                        <button class="btn btn-default btn-md dropdown-toggle btn-block" type="button" data-toggle="dropdown">Sort By
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="right: 0; position: absolute">
                            <li<?= getRequestCheckTwo('sort') ?>><a href="<?= base_url('student-home') ?>">Last Updated</a></li>
                            <li<?= getRequestCheck('sort') ?>><a href="<?= base_url('student-home?sort=deadline') ?>">Deadline Date</a></li>
                            <li class="divider"></li>
                            <li id="hideCompleted"><a href="#">Hide Done Deliverables</a></li>
                            <li id="showCompleted" class="active"><a href="#">Show Done Deliverables</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-row row" id="myDeck">
                <?php foreach ($myDeliverables as $deliverable) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 myCard">                               
                        <div class="card text-center" style="margin-top: 5%;">                 
                            <a href="<?= base_url("deliverable/" . $deliverable->getDeliverableNo() . "") ?>" style="color: black;">
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

            <?php if (sizeof($myDeliverables) == 0) { ?>
            <div class="text-center" style="padding-top: 58px;">
                    <p> You have no deliverables at the moment, click below to create a deliverable</p>
                    <button data-toggle="modal" data-target="#newDelModal" type="button" id="newButton3" class="btn btn-success navbar-btn">
                        <span class="glyphicon glyphicon-plus"></span> New Deliverable</button>
                </div>
            <?php } ?>

      <!--      <div class="text-center">
                <ul class="pagination">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
            </div> -->
        </div>
    </div>  

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
</div>

