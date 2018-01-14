<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">
    
    <div class="text-center">
        <h2>View all Students</h2>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Score</th>
                <th>No. of Deliverables</th>
                <th>Supervisor</th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($studentList->result() as $student): ?>
            <tr>
                <td><?= "$student->StudentFirstName $student->StudentLastName" ?></td>
                <td><?= $student->avgScore ?>%</td>
                <td><?= $student->NumOfDeliverables ?></td>
                <td><?= "$student->SupervisorFirstName $student->SupervisorLastName" ?></td>
                <td><a href="<?= base_url('view-student/'.$student->username) ?>">View Student</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
</body>
</html>