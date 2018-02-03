<div class="col-md-7 col-md-offset-1" >
    <div class="panel panel-default" style="height : 700px;">
        <div class="panel-heading">
            <h3 class="text-center">Latest Evidence Submissions</h3>
        </div>
        <div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
            <!-- <div class="table-feed"> -->
            <table class="table" >
                <thead>
                    <tr>
                        <th>Evidence name</th>
                        <th>Submitted</th>
                        <th>Deliverable Name</th>
                        <th>By</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="overflow-y: scroll;">
                    <?php foreach($submittedEvidences as $evidence){ ?>
                    <tr>
                        <td><?=$evidence->getEvidenceName() ?></td>
                        <!--<td><!?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></td> -->
                        <td><time class="timeago" datetime="<?= date_format($evidence->getSubmissionDate(), 'Y-m-d H:i:s') ?>" ></time></td>
                        <td><?= $evidence->getDeliverableName() ?></td>
                        <td><?= $evidence->getStudentName() ?></td>
                        <td><a href="<?= base_url('view-evidence/'.$evidence->getEvidenceNo()) ?>" class="card-text">View</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>