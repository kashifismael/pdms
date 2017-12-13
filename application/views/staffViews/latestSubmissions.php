<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">
    
    <div class="text-center">
        <h2>View Latest Submissions</h2>
    </div>
    
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
                        <td><?= date_format($evidence->getSubmissionDate(), 'G:i - D j M') ?></td>
                        <td><?= $evidence->getDeliverableName() ?></td>
                        <td><?= $evidence->getStudentName() ?></td>
                        <td><a href="<?= base_url('view-evidence/'.$evidence->getEvidenceNo()) ?>" class="card-text">View</a></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Plan</td>
                        <td>2 mins ago</td>
                        <td>Proposal</td>
                        <td>Luke Skywalker</td>
                        <td><a href="#" class="card-text">View</a></td>
                    </tr>
                    <tr>
                        <td>Draft1</td>
                        <td>2 mins ago</td>
                        <td>Proposal</td>
                        <td>Kashif Ismael</td>
                        <td><a href="#" class="card-text">View</a></td>
                    </tr>
                    <tr>
                        <td>First prototype</td>
                        <td>3 days ago</td>
                        <td>Prototype</td>
                        <td>Student 2</td>
                        <td><a href="#" class="card-text">View</a></td>
                    </tr>
                </tbody>
            </table>
    
</div>
</body>
</html>