    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class="text-center">
            <h1><?= $student->getFirstName() . " " . $student->getLastName() ?></h1>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2 col-md-offset-1" >
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="text-center"> Student Info</h3></div>
                <div class="panel-body">
                    <p><label>Name:</label> <?= $student->getFirstName() . " " . $student->getLastName() ?></p>
                    <p><label>K Number:</label> <?= $student->getUsername() ?></p>
                    <p><label>Email Address:</label> <?= $student->getEmail() ?></p>
                </div>
            </div>
            <p>Display deliverables of <?= $studentID ?> </p>
        </div>