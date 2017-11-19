
<div class="container-fluid">
  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
  <div class="text-center">
      <h1>Proposal</h1>
  </div>
</div>
    
<div class="row row-mobile" > 
  <div class="col-xs-12 text-center">
    <button data-toggle="modal" data-target="#statusModal"
    class="btn btn-primary navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
    <span class="glyphicon glyphicon-pencil"></span> Update Status</button>
  </div>
</div>


<div class="row">

  <div class="col-md-2 col-md-offset-1" >
    <div class="panel panel-default">
    <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h3></div>
    <div class="panel-body">
      <p><label>Name:</label> Proposal</p>
      <p><label>Deadline date:</label> 27/1/18</p>
      <p><label>Status:</label> Incomplete</p>
    </div>
  </div>

  <div class="text-center">
    <button data-toggle="modal" data-target="#statusModal"
    class="btn btn-primary navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
    <span class="glyphicon glyphicon-pencil"></span> Update Status</button>
  </div>
      
      <p>Display deliverable <?=$deliverableID ?></p>
      </div> 

<div class="col-md-8" >
<div class="panel panel-default" style="height : 700px;">
<div class="panel-heading">
  <h3 class="text-center">List of Evidences</h3>
  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
<!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
  <div class="col-sm-6 col-xs-12 text-center" >
    <!--div class="well well-sm"-->
      <strong>View</strong>
      <div class="btn-group">
          <a href="<?= base_url("view-deliverable/".$deliverableID."?flow=list"); ?>" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span>List</a>
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
              <div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <!-- <img class="card-img-top center-block" src="../images/book-icon-149.png" alt="Card image cap" width="100"> -->
                <div class="card-block">
                  <h4 class="card-title">ProposalDraft</h4>
                  <p><label>Status:</label> Completed</p>
                  <p><label>Type:</label> Draft</p>
                  <!-- <a href="#" class="card-text">Click to view</a> -->
                  <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                  <p class="text-muted">Last updated 3 mins ago</p>
                </div>
                <div class="card-footer">
                  <a href="<?= base_url("view-evidence/123"); ?>" class="card-text">Click to view</a>
                  <!-- <small class="text-muted">Last updated 3 mins ago</small> -->
                </div>
              </div>
              <div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <!-- <img class="card-img-top center-block" src="../images/computer-icon-1031.png" alt="Card image cap" width="100" > -->
                <div class="card-block">
                  <h4 class="card-title">Draft1</h4>
                  <p><label>Status:</label> Not finished</p>
                  <p><label>Type:</label> Draft</p>
                  <p class="text-muted">Last updated 6 days ago</p>
                </div>
                <div class="card-footer">
                  <a href="#" class="card-text">Click to view</a>
                </div>
              </div>
              <div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
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

              <div class="card text-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
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



  
