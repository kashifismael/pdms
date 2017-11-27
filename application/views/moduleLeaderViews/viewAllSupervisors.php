<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">
    
    <div class="text-center">
        <h2>View all supervisors</h2>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Staff ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach($supervisorList as $supervisor){ ?>
            <tr>
                <td><?= $supervisor->getUsername() ?></td>
                <td><?= $supervisor->getFirstName() ?></td>
                <td><?= $supervisor->getLastName() ?></td>
                <td><?= $supervisor->getEmail() ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>
</body>
</html>