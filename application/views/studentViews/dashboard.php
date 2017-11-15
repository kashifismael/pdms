
<!--  <div class="container-fluid" style="padding-left: 10%; padding-right:10%;">-->
<div class="container-fluid">

    <?php $this->load->view('studentViews/notifications') ?>

    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#Dash1"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> Deliverables (All?)</span></a></li>
                <li><a data-toggle="tab" href="#Dash2"><span class="glyphicon glyphicon-tasks"></span><span class="hidden-xs"> Deliverables (Completed?)</span></a></li>
                <li><a data-toggle="tab" href="#Dash3"><span class="glyphicon glyphicon-globe"></span><span class="hidden-xs"> Deliverables 3 (w/ Feedback?)</span></a></li>
            </ul>

            <div class="tab-content">

                <div id="Dash1" class="tab-pane fade in active">

                    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
                        <!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
                        <div class="col-sm-6 col-xs-12 text-center">
                            <h1>All Deliverables</h1>
                        </div>
                        <div class="col-sm-3 col-xs-12 text-center" >
                            <!--div class="well well-sm"-->
                            <strong>View</strong>
                            <div class="btn-group">
                                <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
                                <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
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
                    <div class="flex-row row">
                        <!-- <div class="card-deck"> -->
                        <?php foreach ($myDeliverables as $deliverable) { ?>
                            <!--div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12"--> <!-- original -->
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->                               
                                <div class="card text-center" style="margin-top: 5%;">                  <!-- new, with added style -->
                                    <a href="<?= base_url("deliverable/".$deliverable->getDeliverableNo()."") ?>" style="color: black;">
                                    <img class="card-img-top center-block img-responsive" src="http://cdn.kingston.ac.uk/includes/img/cms/site-images/resized/cd29f98-kingston-university-fc0978d-postgraduate-prospectus.jpg" alt="Card image cap">
                                <div class="card-block">
                                    <h4 class="card-title"><strong><?= $deliverable->getDeliverableName() ?></strong></h4>
                                    <div class="card-text">
                                        <p><strong>Deadline date:</strong> <?= date_format($deliverable->getDeadlineDate(), 'g:ia \o\n l jS F Y') ?></p>
                                        <p><strong>Status:</strong> <?= $deliverable->getDelstatusDesc() ?></p>
                                    </div>
                                <!--a href="<!--?= base_url("deliverable/".$deliverable->getDeliverableNo()."") ?>" class="card-text">Click to view</a-->
                                </div>                                
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                                    </a>
                                </div>  <!-- new -->                                
                            </div>      <!-- new -->
                            <!-- </div> -->  <!-- original -->
                        <?php } ?>
                        <!--div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12" -->
                          <!-- <img class="card-img-top" src="./book-icon-149.png" alt="Card image cap" width="180" height="180"> -->
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
                        <!--div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12"-->
                          <!-- <img class="card-img-top" src="./book-icon-149.png" alt="Card image cap" width="180" height="180"> -->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">                  <!-- new, with added style -->
                            <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/thumbnail4')?>" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Prototype</h4>
                                <p class="card-text">This Deliverable has two items.</p>
                                <a href="#" class="card-text">Click to view</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated 6 days ago</small>
                            </div>
                        </div>
                        </div>
                        <!--div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12"-->
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> <!-- new -->
                                <div class="card text-center" style="margin-top: 5%;">   
                                    <img class="card-img-top center-block img-responsive" src="<?= base_url('images/thumbnails/thumbnail1')?>" alt="Card image cap">
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
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                    </div>


                </div>

                <div id="Dash2" class="tab-pane fade">

                    <h1>All Deliverables 2</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Deliverable Type</th>
                                <th>Last Updated</th>
                                <th>No. of items</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td>5</td>
                                <td><a href="#" class="card-text">Click to view</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                    </div>

                </div>

                <div id="Dash3" class="tab-pane fade">
                    <h1>Recieved Feedback</h1>

                    <table class="table" >
                        <thead>
                            <tr>
                                <th>Feedback No.</th>
                                <th>Evidence Name</th>
                                <th>Recieved</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="overflow-y: scroll;">
                            <tr>
                                <td>0001</td>
                                <td>Plan</td>
                                <td>2 mins ago</td>
                                <td><a href="#" class="card-text">View</a></td>
                                <td><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span><span class="hidden-xs"> Download Feedback</span></a></td>
                            </tr>
                            <tr>
                                <td>0021</td>
                                <td>Draft1</td>
                                <td>3 days ago</td>
                                <td><a href="#" class="card-text">View</a></td>
                                <td><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span><span class="hidden-xs"> Download Feedback</span></a></td>
                            </tr>
                            <tr>
                                <td>0056</td>
                                <td>FinalDraft</td>
                                <td>6 days ago</td>
                                <td><a href="#" class="card-text">View</a></td>
                                <td><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span><span class="hidden-xs"> Download Feedback</span></a></td>
                            </tr>
                        </tbody>
                    </table>

                </div>




            </div>


        </div>
    </div>  

    <p><?= $this->session->userFirstName . " " . $this->session->userLastName . " " . $this->session->userName . " " . $this->session->userTypeID ?></p>
    <p>student ID of <?= $this->session->secondaryID ?></p>
</div>

