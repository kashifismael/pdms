
<div class="container-fluid">
    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="text-center">
            <h1><?= $student->getFirstName() . " " . $student->getLastName() ?></h1>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Student Info</h3></div>
                <div class="panel-body">
                    <p><label>Name:</label> <?= $student->getFirstName() . " " . $student->getLastName() ?></p>
                    <p><label>K Number:</label> <?= $student->getUsername() ?></p>
                    <p><label>Email Address:</label> <?= $student->getEmail() ?></p>
                </div>
            </div>
            <p>Display deliverables of <?= $studentID ?> </p>
        </div>

        <div class="col-md-8" >
            <div class="panel panel-default" style="height : 700px;">
                <div class="panel-heading">
                    <h3 class="text-center">Deliverables</h3>
                    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
                        <!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
                        <div class="col-sm-6 col-xs-12 text-center" >
                            <!--div class="well well-sm"-->
                            <strong>View</strong>
                            <div class="btn-group">
                                <a href="<?= base_url("view-student/" . $studentID . "?flow=list"); ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
                                <a href="#" id="grid" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th"></span>Grid</a>
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



                    <div class="flex-row row">
                        <!-- <div class="card-deck"> -->
                        <?php foreach ($theirDeliverables as $deliverable) { ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">                             
                                <div class="card text-center" style="margin-top: 5%;">                  
                                    <a href="<?= base_url("deliverable/" . $deliverable->getDeliverableNo() . "") ?>" style="color: black;">
                                        <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/thumbnail' . rand(1, 13)) ?>" alt="Card image cap">
                                        <div class="card-block">
                                            <h4 class="card-title"><strong><?= $deliverable->getDeliverableName() ?></strong></h4>
                                            <div class="card-text">
                                                <p><strong>Deadline date:</strong> <?= date_format($deliverable->getDeadlineDate(), 'g:ia \o\n l jS F Y') ?></p>
                                                <p><strong>Status:</strong> <?= $deliverable->getDelstatusDesc() ?></p>
                                            </div>
                                        </div>                                
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </a>
                                </div>                                
                            </div> 
                        <?php } ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">                  <!-- new, with added style -->
                            <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/thumbnail7')?>" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Proposal</h4>
                                <div class="card-text">
                                    <p><strong>Deadline date:</strong> 27/1/18</p>
                                    <p><strong>Status:</strong> Incomplete</p>
                                </div>
                                <a href="#" class="card-text">Click to view</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">   
                                    <img class="card-img-top center-block img-responsive" src="http://cdn.kingston.ac.uk/includes/img/cms/site-images/resized/cd29f98-kingston-university-fc0978d-postgraduate-prospectus.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">   
                                    <img class="card-img-top center-block img-responsive" src="http://cdn.kingston.ac.uk/includes/img/cms/site-images/resized/26ba482-kingston-university-ce1a1a6-international-scholarships.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">   
                                    <img class="card-img-top center-block img-responsive" src="http://cdn.kingston.ac.uk/includes/img/cms/site-images/resized/9c65a6c-kingston-university-69c2e74-research-degrees.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>
                        </div>
                        </div>
                        <!--/div-->
                    </div>



                </div>
            </div>
        </div>


        <!-- <div class="col-md-2" style="background-color:blue;">
      <p> column 3 </p>
            </div> -->


    </div>

</div>
</body>



</html>
