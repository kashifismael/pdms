<?php $minDate = new DateTime('now'); ?>
<div id="newEvidUpModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Evidence</h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('uploadEvidence') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="date">Enter Name of Evidence</label>
                        <input type="text" class="form-control" id="evidenceName" name="evidenceName" maxlength="50" required>
                        <input type="hidden" value="<?= $delID ?>" name="deliverableID">
                    </div>
                    <div class="form-group">
                        <label for="text">Choose Deliverable</label>
                        <input type="text" class="form-control" value="<?= $deliverableInfo->getDeliverableName() ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Select File</label>
                        <input id="evidence" name="evidence" type="file" class="file" data-show-preview="true">
                    </div>
                    <button type="submit" value="upload" class="btn btn-success">Upload Evidence</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>


<div id="deadlineChange" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('processDeadlineRequest') ?>" > 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Request Deadline Change</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">New Deadline Date</label>
                        <input type="date" class="form-control" id="reqDeadlineDate" name="reqDeadlineDate" min="<?=$minDate->format('Y-m-d')?>" value="<?=$minDate->format('Y-m-d')?>">
                    </div> 
                    <div class="form-group">
                        <label for="date">New Deadline Time</label>
                        <input type="time" class="form-control" id="reqDeadlineTime" name="reqDeadlineTime" value="23:59">
                    </div>
                    <div class="form-group">
                        <label for="comment">Reason for change:</label>
                        <textarea class="form-control" rows="5" id="reason" name="reason" maxlength="250" required></textarea>
                        <input type="hidden" value="<?= $delID ?>" name="deliverableID">
                    </div>
                    <button type="submit" class="btn btn-success">Submit Request</button>                            
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="delDeletion" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Request Deliverable Deletion</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('processDeleteRequest')?>" >
                <div class="form-group">
                    <label for="comment">Reason for Deletion:</label>
                    <textarea class="form-control" rows="5" id="deleteReason" name="deleteReason" maxlength="250" required></textarea>
                    <input type="hidden" value="<?= $delID ?>" name="deliverableID">
                </div>
                <button type="submit" class="btn btn-success">Submit Request</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>