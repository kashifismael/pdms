
<div class="container-fluid">
  <div class="row row-mobile" > <!-- doesnt show well on mobile -->
  <div class=" col-xs-12 text-center">
      <h1>Draft1</h1>
  </div>
</div>
<div class="row row-mobile" >
      <div class="col-xs-6 text-center">
  <a href="#" class="btn btn-primary btn-block visible-xs visible-sm"><span class="glyphicon glyphicon-download-alt"></span> Download Evidence</a>
      </div>
    <div class="col-xs-6 text-center">
<a href="#" data-toggle="modal" data-target="#newUpModal" class="btn btn-primary btn-success btn-block visible-xs visible-sm"> + New Feedback</a>
    </div>

  </div>

<div class="row">

  <div class="col-md-3 col-md-offset-1" >
    <div class="panel panel-default">
    <div class="panel-heading"><h4 class="text-center">Info</h3></div>
    <div class="panel-body">
      <p><label>Status:</label> Needs improving</p>
<!--      <p><label>Type:</label> Draft</p>-->
      <p><label>Last Updated:</label> 3 days ago</p>
    </div>
  </div>
  <a href="#" class="btn btn-primary btn-block hidden-xs hidden-sm"><span class="glyphicon glyphicon-download-alt"></span> Download Evidence</a>
      <a href="#" data-toggle="modal" data-target="#newUpModal" class="btn btn-primary btn-success btn-block hidden-xs hidden-sm"> + New Feedback</a>
  
      </div>

<div class="col-md-7 " >
<div class="panel panel-default" style="height : 700px;">
<div class="panel-heading">
  <h3 class="text-center">Feedback List</h3>
</div>
<div class="panel-body" style="max-height: 600px; overflow-y: scroll;">
<!-- <div class="table-feed"> -->
  <table class="table" >
<thead>
  <tr>
    <th>Feedback No.</th>
    <th>Submitted</th>
    <th>Click to download</th>
  </tr>
</thead>
<tbody style="overflow-y: scroll;">
  <tr>
    <td>Feedback 3</td>
    <td>2 mins ago</td>
    <td><a href="#" class="card-text">Download Feedback</a></td>
  </tr>
  <tr>
    <td>Feedback 2</td>
    <td>3 days ago</td>
    <td><a href="#" class="card-text">Download Feedback</a></td>
  </tr>
  <tr>
    <td>Feedback 1</td>
    <td>6 days ago</td>
    <td><a href="#" class="card-text">Download Feedback</a></td>
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


<div id="newUpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Provide Feedback</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
              <label for="text">Choose Status</label>
              <select class="form-control" id="sel1">
            <option>Incomplete</option>
            <option>Complete</option>
          </select>
            </div>
            <div class="form-group">
              <label class="control-label">Select File (if applicable)</label>
              <input id="input-1a" type="file" class="file" data-show-preview="true">
            </div>
            <button type="submit" class="btn btn-success">Submit Feedback</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

</body>



</html>
