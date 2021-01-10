<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Publish A New Program</h3>
</div>
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Program Info</p>
            </div>
            <div class="card-body">
                <form id="add_program_form" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col text-center">
                            <img class="img-thumbnail" width="300" height="400" src="../../assets/img/programs/ProgramDefualt.jpg" onClick="triggerClick3()" id="programDisplay" title="Upload a game poster">
                            <input type="file" name="programImage" onChange="displayImage3(this)" id="programImage" class="form-control" style="display: none;" required title="Upload a program poster or logo">
                        </div>
                        <div class="col">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pname"><strong>Name</strong></label>
                                        <input type="text" class="form-control" placeholder="Adobe" name="pname" autocomplete="off" required maxlength="20" pattern="^[A-Za-z0-9\s,]{1,20}$" title="Program name can be up to 20 letters and numbers" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="preleased_date"><strong>Released Date</strong></label>
                                        <input class="form-control" placeholder="yyyy-mm-dd" name="preleased_date" autocomplete="off" required maxlength="10" type="date" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="ppublisher"><strong>Publisher</strong></label>
                                        <input type="text" class="form-control" placeholder="comapny_x" name="ppublisher" autocomplete="off" required maxlength="80" pattern="^[A-Za-z0-9,]{1,20}$" title="Game publisher can be up to 80 letters and numbers" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <br>
                                        <button class="btn btn-dark btn-lg" type="submit" name="add_program" value="add_program">Add Program</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal to be used later-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info..</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
<?php include("lower.php"); ?>