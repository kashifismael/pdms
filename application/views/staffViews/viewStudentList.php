
<div class="container-fluid">
  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
  <div class="text-center">
      <h1>Kashif Ismael</h1>
  </div>
</div>
<div class="row">

  <div class="col-md-2 col-md-offset-1" >
    <div class="panel panel-default">
    <div class="panel-heading"><h4 class="text-center"> Student Info</h3></div>
    <div class="panel-body">
      <p><label>Name:</label> Kashif Ismael</p>
      <p><label>K Number:</label> k1552723</p>
      <p><label>Course:</label> Computer Science</p>
    </div>
  </div>
      <p>Display deliverables of <?=$studentID ?> </p>
      </div>

<div class="col-md-8" >
<div class="panel panel-default" style="height : 700px;">
<div class="panel-heading">
  <h3 class="text-center">Deliverables</h3>
  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
<!-- <div class="row" style="display: flex; justify-content: center; align-items: center;"> -->
  <div class="col-sm-6 col-xs-12 text-center" >
    <!--div class="well well-sm"-->
      <strong>View</strong>
      <div class="btn-group">
          <a href="#" id="list" class="btn btn-default btn-sm active"><span class="glyphicon glyphicon-th-list"></span>List</a>
          <a href="<?= base_url("view-student/".$studentID.""); ?>" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grid</a>
      </div>
  <!--/div-->
    </div>
  <div class="col-sm-6 col-xs-12">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for Deliverable...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </div>
    </div>
  </div>
</div>
<div class="panel-body" style="max-height: 600px; overflow-y: scroll;">

      <table class="table">
    <thead>
      <tr>
        <th>Deliverable Type</th>
        <th>Last Updated</th>
        <th>No. of items</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Proposal</td>
        <td>3 days ago</td>
        <td>6</td>
        <td><a href="#" class="card-text">Click to view</a></td>
      </tr>
      <tr>
        <td>Prototype</td>
        <td>6 days ago</td>
        <td>6</td>
        <td><a href="#" class="card-text">Click to view</a></td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
        <td><a href="#" class="card-text">Click to view</a></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
  </div>


  <!-- <div class="col-md-2" style="background-color:blue;">
<p> column 3 </p>
      </div> -->


</div>

</div>
</body>



</html>
