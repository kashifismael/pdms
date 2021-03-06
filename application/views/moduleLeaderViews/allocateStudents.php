
<div class="container-fluid" style="padding-left: 10%; padding-right:10%;">
    <?php if (isset($_SESSION['allocation'])) { ?>
        <div class="row">
            <div class="col-md-12 ">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Students have been allocated
                </div>
            </div>  
        </div>
    <?php } ?>

    <div class="text-center">
        <h2>Allocate Students</h2>
    </div>
    <?php if (sizeof($studentList) > 0) { ?> 
        <div class="row">
            <div class="col-sm-3 col-sm-offset-9">
                <input id="myInput" type="text" class="form-control" placeholder="Search for Student...">
            </div>
        </div>
    <?php } ?>
    <form method="POST" action="allocationPortal">
        <div class="row" >
            <div class="form-group" id="allStudents">
                <?php foreach ($studentList as $student) { ?>
                    <div class="well well-sm col-sm-4 col-md-3 student">
                        <div class="checkbox">
                            <label><input type="checkbox" name="students[]" value="<?= $student->getStudentID() ?>"><?= $student->getFirstName() . " " . $student->getLastName() . " - " . $student->getUsername() ?></label>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if (sizeof($studentList) == 0) { ?> 
                <div class="text-center">
                    <p>There are no students awaiting allocation</p>
                </div>
            <?php } ?>

        </div>
        <?php if (sizeof($studentList) > 0) { ?> 
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="sel1">Allocate to:</label>
                    <select name="supervisor" class="form-control" id="sel1">
                        <?php foreach ($supervisorList as $supervisor) { ?>
                            <option value="<?= $supervisor->getStaffID() ?>"><?= $supervisor->getFirstName() . " " . $supervisor->getLastName() ?></option>
                        <?php } ?>              
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success btn-md">Allocate Students</button>
                </div>
            </div>
        <?php } ?>
    </form>

    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#allStudents .student").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</div>
</body>
</html>
