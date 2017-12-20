<div class="container-fluid">

    <?php $this->load->view('studentViews/notifications') ?>

    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1"> 
            <div class="row row-mobile" >
                <div class="col-sm-5 col-xs-12 text-center">
                    <h3 class="visible-xs">Welcome back, <?= $this->session->userFirstName ?></h3>
                    <h2 class="hidden-xs">Welcome back, <?= $this->session->userFirstName ?></h2>
                </div>
                <div class="col-sm-2 col-xs-12 text-center" >
                    <strong>View</strong>
                    <div class="btn-group">
                        <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
                        <a href="<?= base_url('student-home') ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <input id="myInput" type="text" class="form-control" placeholder="Search for Deliverable...">
                </div>
                <div class="col-sm-2 col-xs-12 text-center" style="position: relative">
                    <div class="dropdown">
                        <button class="btn btn-default btn-md dropdown-toggle btn-block" type="button" data-toggle="dropdown">Sort By
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="right: 0; position: absolute">
                            <li><a href="<?= base_url('student-home?flow=list') ?>">Last Updated</a></li>
                            <li><a href="<?= base_url('student-home?flow=list&sort=deadline') ?>">Deadline Date</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>Deliverable Name</th>
                        <th>Deadline Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($myDeliverables as $deliverable) { ?> 
                        <tr>
                            <td class="deliverable"><?= $deliverable->getDeliverableName() ?></td>
                            <td><?= date_format($deliverable->getDeadlineDate(), 'G:i - D j M') ?></td>
                            <td><?= $deliverable->getDelstatusDesc() ?></td>
                            <td><a href="<?= base_url("deliverable/" . $deliverable->getDeliverableNo() . "") ?>" class="card-text">Click to view</a></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="deliverable">Proposal</td>
                        <td>3 days ago</td>
                        <td>6</td>
                        <td><a href="#" class="card-text">Click to view</a></td>
                    </tr>
                    <tr>
                        <td class="deliverable">Prototype</td>
                        <td>6 days ago</td>
                        <td>6</td>
                        <td><a href="#" class="card-text">Click to view</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>  

    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).find(".deliverable").text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</div>

