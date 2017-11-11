    <?php 
       if (isset($_SESSION['account']))  
        { ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Welcome to UniDiss, <?= $this->session->userFirstName . " " . $this->session->userLastName ?></strong>! Get started on creating deliverables and submitting evidence.
                </div>
            </div>  
        </div>
    <?php } ?>
        <?php 
         if (isset($_SESSION['deliverableCreation'])) {   
            ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Successfully created Deliverable!</strong>
                </div>
            </div>  
        </div>
    <?php } ?>