
  <div id="popover-content" class="hide">
    <p><a data-toggle="modal" data-target="#newDelModal"><span class="glyphicon glyphicon-plus"></span> New deliverable</a></p>
    <p><a data-toggle="modal" data-target="#newUpModal"><span class="glyphicon glyphicon-open"></span> Upload evidence</a></p>
  </div>

  <div id="newDelModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create New Deliverable</h4>
        </div>
        <div class="modal-body">
          <form>
                <div class="form-group">
                  <label for="usr">Deliverable Name:</label>
                  <input type="text" class="form-control" id="usr">
                </div>
              <div class="form-group">
                <label for="date">Set Deadline Date</label>
                <input type="date" class="form-control" id="pwd">
              </div>
              <button type="submit" class="btn btn-success">Create Deliverable</button>
  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>

    </div>
  </div>

  <div id="newUpModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Evidence</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="date">Enter Name of Evidence</label>
              <input type="text" class="form-control" id="pwd">
            </div>
              <div class="form-group">
                <label for="text">Choose Deliverable</label>
                <select class="form-control" id="sel1">
              <option>Proposal</option>
              <option>Prototype</option>
              <option>Report</option>
              <option>Software application</option>
            </select>
              </div>
              <div class="form-group">
                <label class="control-label">Select File</label>
                <input id="input-1a" type="file" class="file" data-show-preview="true">
              </div>
              <button type="submit" class="btn btn-success">Upload Evidence</button>
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