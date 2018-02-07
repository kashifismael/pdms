<div class="container">
    <h1 class="text-center">View Supervisor</h1>

    <div class="row">
        <div class="col-xs-12 col-sm-8-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center">Supervisor Info</h3></div>
                <div class="panel-body">
                    <?php if (isset($supervisor)): ?>
                        <p><label>Name:</label> <?= $supervisor->getFirstName() . " " . $supervisor->getLastName() ?></p>
                        <p><label>Username:</label> <?= $supervisor->getUsername() ?></p>
                        <p><label>Email:</label> <?= $supervisor->getEmail() ?></p>
                    <?php else: ?>
                        <p>You have not been allocated a supervisor</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>