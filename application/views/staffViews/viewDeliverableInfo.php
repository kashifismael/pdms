  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
  <div class="text-center">
      <h1><?= $deliverableInfo->getDeliverableName() ?></h1>
  </div>
</div>
    
<div class="row row-mobile" > 
  <div class="col-xs-12 text-center">
    <button data-toggle="modal" data-target="#statusModal"
    class="btn btn-primary navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
    <span class="glyphicon glyphicon-pencil"></span> Update Status of <?= $deliverableInfo->getDeliverableName() ?></button>
  </div>
</div>

<div class="row">

  <div class="col-md-2 col-md-offset-1" >
    <div class="panel panel-default">
    <div class="panel-heading"><h4 class="text-center"> Deliverable Info</h3></div>
    <div class="panel-body">
      <p><label>Name:</label> <?= $deliverableInfo->getDeliverableName() ?></p>
      <p><label>Deadline date:</label> <?= date_format($deliverableInfo->getDeadlineDate(), 'g:ia \o\n l jS F Y') ?></p>
      <p><label>Status:</label> <?= $deliverableInfo->getDelstatusDesc() ?></p>
    </div>
  </div>

  <div class="text-center">
    <button data-toggle="modal" data-target="#statusModal"
    class="btn btn-primary navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
    <span class="glyphicon glyphicon-pencil"></span> Update Status of <?= $deliverableInfo->getDeliverableName() ?></button>
  </div>     
      <p>Display deliverable <?=$deliverableID ?></p>
      </div> 