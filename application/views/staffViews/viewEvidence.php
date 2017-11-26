<div class="container-fluid">
    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class=" col-xs-12 text-center">
            <h1><?= $evidence->getEvidenceName() ?></h1>
        </div>
    </div>
    <div class="row row-mobile" >
        <div class="col-xs-6 text-center">
            <form method="POST" action="<?= base_url('downloadEvidence') ?>">
                <input type="hidden" name="evidID" value="<?= $evidenceID ?>">
                <button type="submit" class="btn btn-primary btn-block visible-xs visible-sm"><span class="glyphicon glyphicon-download-alt"></span> Download Evidence</button>
            </form>
        </div>
        <div class="col-xs-6 text-center">
            <a href="#" data-toggle="modal" data-target="#newUpModal" class="btn btn-primary btn-success btn-block visible-xs visible-sm"> + New Feedback</a>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center">Info</h3></div>
                <div class="panel-body">
                    <p><label>Status:</label> <?= $evidence->getEvidenceStatus() ?></p>
                    <p><label>Submitted:</label> <?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></p>
                </div>
            </div>
            <form method="POST" action="<?= base_url('downloadEvidence') ?>">
                <input type="hidden" name="evidID" value="<?= $evidenceID ?>">
                <button type="submit" class="btn btn-primary btn-block hidden-xs hidden-sm" ><span class="glyphicon glyphicon-download-alt"></span> Download Evidence</button>
            </form>
            <div style="padding-top: 5px;"></div>
            <a href="#" data-toggle="modal" data-target="#newUpModal" class="btn btn-primary btn-success btn-block hidden-xs hidden-sm"> + New Feedback</a>

            <h4 class="text-center"><?= $evidenceID ?></h4>

        </div>

        <div class="col-md-7 " >
            <h3 class="text-center">Feedback List</h3>
            <table class="table" >
                <thead>
                    <tr>
                        <th>Feedback No.</th>
                        <th>Submitted</th>
                        <th>Click to download</th>
                    </tr>
                </thead>
                <tbody style="overflow-y: scroll;">
                    <tr>
                        <td>Feedback 3</td>
                        <td>2 mins ago</td>
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                    </tr>
                    <tr>
                        <td>Feedback 2</td>
                        <td>3 days ago</td>
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                    </tr>
                    <tr>
                        <td>Feedback 1</td>
                        <td>6 days ago</td>
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download Feedback</button></td>
                    </tr>
                </tbody>
            </table>
            <p>select all from feedback where evidence no is = <?= $evidenceID ?></p>
        </div>


        <!-- <div class="col-md-2" style="background-color:blue;">
      <p> column 3 </p>
            </div> -->


    </div>

</div>


<div id="newUpModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Provide Feedback</h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('uploadFeedback') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="text">Mark Evidence as:</label>
                        <select name="evidStatus" class="form-control" id="evidStatus">
                            <option value="2">Changes Required</option>
                            <option value="3">Completed</option>   
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="text">Mark overall Deliverable as:</label>
                        <select name="delStatus" class="form-control" id="evidStatus">
                            <?php foreach ($statusOptions->result() as $row) { ?>
                                <option value="<?= $row->delStatus_ID ?>" ><?= $row->delStatusDesc ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="delID" value="<?= $evidence->getDeliverableNo() ?>">
                        <input type="hidden" name="evidID" value="<?= $evidenceID ?>">
                        <label class="control-label">Select File (if applicable)</label>
                        <input id="feedback" name="feedback" type="file" class="file" data-show-preview="true">
                    </div>
                    <button type="submit" class="btn btn-success">Submit Feedback</button>
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
