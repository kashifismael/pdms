<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Deliverable Status</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('updateDelStatus') ?>">
                    <div class="form-group">
                        <label for="text">Choose Status</label>
                        <select name="delStatus" class="form-control" id="sel1">
                            <?php foreach ($statusOptions->result() as $row) { ?>
                                <option value="<?= $row->delStatus_ID ?>" ><?= $row->delStatusDesc ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="delID" value="<?= $deliverableID ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Update Status</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>



</body>
</html>
