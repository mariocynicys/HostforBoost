<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Publish A New Game</h3>
</div>
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Game Info</p>
            </div>
            <div class="card-body">
                <form id="add_game_form" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col text-center">
                            <img class="img-thumbnail" width="300" height="400" src="../../assets/img/games/GameDefualt.jpg" onClick="triggerClick2()" id="gameDisplay" title="Upload a game poster">
                            <input type="file" name="gameImage" onChange="displayImage2(this)" id="gameImage" class="form-control" style="display: none;" required title="Upload a game poster">
                        </div>
                        <div class="col">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="gname"><strong>Name</strong></label>
                                        <input type="text" class="form-control" placeholder="pbg" name="gname" autocomplete="off" required maxlength="20" pattern="^[A-Za-z0-9\s,]{1,20}$" title="Game name can be up to 20 letters and numbers" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="ggenre"><strong>Genre</strong></label>
                                        <input type="text" class="form-control" placeholder="action" name="ggenre" autocomplete="off"" maxlength="80" required pattern="^[A-Za-z0-9\s,]{1,20}$" title="Game genre can be up to 80 letters and numbers" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="grate"><strong>Rate</strong></label>
                                        <input type="number" class="form-control" placeholder="8.5" name="grate" autocomplete="off" required maxlength="10" min="0" max="10" step="0.1" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="greleased_date"><strong>Released Date</strong></label>
                                        <input class="form-control" placeholder="yyyy-mm-dd" name="greleased_date" autocomplete="off" required maxlength="10" type="date" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="gpublisher"><strong>Publisher</strong></label>
                                        <input type="text" class="form-control" placeholder="comapny_x" name="gpublisher" autocomplete="off" required maxlength="50" pattern="^[A-Za-z0-9,]{1,20}$" title="Game publisher can be up to 50 letters and numbers" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="usertype"><strong>Trailer URL</strong></label>
                                        <input type="url" class="form-control" placeholder="https://www.youtube.com/watch?v=abcdefghig" name="gtrailer" autocomplete="off" required maxlength="43" minlength="43" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <br>
                                        <button class="btn btn-dark btn-lg" type="submit" name="add_game" value="add_game">Add Game</button>
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