
<div class="container-fluid">
    <div class="row row-mobile" > <!-- doesnt show well on mobile -->
        <div class=" col-xs-12 text-center">
            <h1>Plan</h1>
        </div>
    </div>
    <div class="row row-mobile" >
        <div class="col-xs-6 text-center">
            <a href="#" class="btn btn-primary btn-block visible-xs visible-sm btn-text-wrap"><span class="glyphicon glyphicon-download-alt"></span> Download file</a>
        </div>
        <div class="col-xs-6 text-center">
            <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-primary btn-warning btn-block visible-xs visible-sm btn-text-wrap"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
        </div>
        <div class="col-xs-6"><p class="visible-xs visible-sm"></p></div>

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
            <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-primary btn-warning btn-block hidden-xs hidden-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
            <p> display evidence <?= $evidID ?></p>
        </div>

        <div class="col-md-7 " >
            <h3 class="text-center">Feedback List</h3>
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
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button></td>
                    </tr>
                    <tr>
                        <td>Feedback 2</td>
                        <td>3 days ago</td>
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button></td>
                    </tr>
                    <tr>
                        <td>Feedback 1</td>
                        <td>6 days ago</td>
                        <td><button class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Download</button></td>
                    </tr>
                </tbody>
            </table>
            <p>select all from feedback where evidence no is = <?= $evidID ?></p>
        </div>

    </div>

</div>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Evidence</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="date">Enter Name of Evidence</label>
                        <input type="text" class="form-control" id="pwd" value="Plan">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Overwrite File (if applicable)</label>
                        <input id="input-1a" type="file" class="file" data-show-preview="true">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>