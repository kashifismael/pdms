<div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="text-center">
            <h1><?= $deliverableInfo->getDeliverableName() ?></h1>
        </div>
    </div>
    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="col-xs-12 text-center">
            <button data-toggle="modal" data-target="#newEvidUpModal"
                    class="btn btn-success navbar-btn btn-block btn-text-wrap visible-xs visible-sm">
                <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
        </div>
    </div>

    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
        </div>
        <div class="col-xs-6 text-center visible-xs visible-sm">
            <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
        </div>
        <div class="col-xs-6"><p class="visible-xs visible-sm"></p></div>  
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
                <button data-toggle="modal" data-target="#newEvidUpModal"
                        class="btn btn-success navbar-btn btn-block btn-text-wrap hidden-xs hidden-sm">
                    <span class="glyphicon glyphicon-open"></span> Upload Evidence to <?= $deliverableInfo->getDeliverableName() ?></button>
                <a data-toggle="modal" data-target="#deadlineChange" class="btn btn-warning btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-time"></span> Request Deadline Change</a>
                <a data-toggle="modal" data-target="#delDeletion" class="btn btn-danger btn-block btn-text-wrap hidden-xs hidden-sm"><span class="glyphicon glyphicon-remove-sign"></span> Request Deliverable Delete</a>
            </div>     

            <p>Display deliverable <?= $delID ?></p>
        </div>