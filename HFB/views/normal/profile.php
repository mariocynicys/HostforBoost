<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Profile</h3>
    <div class="row mb-3">
        <div class="col-lg-5 offset-lg-3">
            <div class="card mb-3" style="text-align: center;">
                <div class="card-body text-center shadow">
                    <form class='form' action="..\..\assets\php\update_photo.php" enctype="multipart/form-data" method="POST">
                        <div class="form-group text-center" style="position: relative;">
                            <img class="rounded-circle mb-3 mt-4" width="160" height="160" src="../../assets/img/avatars/<?php echo $profile_pic; ?>" onClick="triggerClick()" id="profileDisplay">
                            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="updatePhoto" value="updatePhoto" class="btn btn-primary btn-md">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="..\..\assets\php\update_info.php" method="POST">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name_id" name="first_name" autocomplete="off" required="" minlength="1" maxlength="20" pattern="^[A-Za-z ]{1,20}$" title="Must be from 1 to 20 chracters" value=<?php echo $first_name; ?>></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name_id" name="last_name" autocomplete="off" required="" minlength="1" maxlength="20" pattern="^[A-Za-z ]{1,20}$" title="Must be from 1 to 20 chracters" value="<?php echo $last_name; ?>"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="username"><strong>Username</strong></label><input class="form-control" type="text" id="user_name_id" name="user_name" autocomplete="off" required="" maxlength="20" pattern="^[A-Za-z0-9 ]{1,20}$" title="Must be from 1 to 20 chracters and numbers" value="<?php echo $username; ?>" readonly=""></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email_id" name="email" inputmode="email" autocomplete="off" required="" pattern="^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100" value="<?php echo $email; ?>"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label for="usertype"><strong>UserType</strong></label><input class="form-control" type="text" value="<?php echo $user_type; ?>" name="user_type" readonly="" required="" maxlength="20"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="password"><strong>Password</strong></label><input class="form-control" type="password" data-toggle="tooltip" data-bs-tooltip="" name="password" autocomplete="off" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" minlength="8" maxlength="20" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $password; ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit" name="updateInfo" value="updateInfo">Save Settings</button></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </div>
    <div class="card shadow mb-5" id="curAct">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Current Activities</p>
        </div>
        <div class="card-body">
            <?php
                $sql = "SELECT *, COUNT(*) as `GamesCount` FROM `GamesHistory` t1, `Game` t2 WHERE t1.UserName='".$username."' AND t2.GID=t1.GID AND t1.GState=1;";
                $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                $record1 = mysqli_fetch_assoc($result_set);
                $displayGames='';  
                if($record1['GamesCount'] != 1) $displayGames="none";

                $sql = "SELECT *, COUNT(*) as `ProgramsCount` FROM `ProgramsHistory` t1, `Program` t2 WHERE t1.UserName='".$username."' AND t2.PID=t1.PID AND t1.PState=1;";
                $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                $record2 = mysqli_fetch_assoc($result_set);
                $displayPrograms='';  
                if($record2['ProgramsCount'] != 1) $displayPrograms="none";

                if($displayGames=="none" && $displayPrograms=="none"){
                    echo    '<div class="container-fluid" style="text-align: center;">
                                <h5 class="text-dark mb-4">Start playing games or using programs now!</h5>
                            </div>';
                }else{
                    echo '
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-hover my-0" id="gamesTable" data-toggle="table" data-pagination="true" data-page-list="[5,10,15,all]" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                            <thead>
                                <tr>
                                    <th>Poster</th>
                                    <th data-sortable="true">Name</th>
                                    <th data-sortable="true">Started Playing</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
                    if($displayGames != 'none'){
                        echo '
                        <tr>
                            <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/games/'.$record1["GPoster"].'"></td>
                            <td class="text-left">'.$record1["GName"].'</td>
                            <td class="text-left">'.$record1["GStarted"].'</td>
                            <td><button type="button" class="btn btn-danger profileLeavebtn" id="'.$username.'-Game-'.$record1["GID"].'">Leave</button></td>
                        </tr>';
                    }
                    if($displayPrograms != 'none'){
                        echo '
                            <tr>
                                <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/programs/'.$record2["PPoster"].'"></td>
                                <td class="text-left">'.$record2["PName"].'</td>
                                <td class="text-left">'.$record2["PStarted"].'</td>
                                <td><button type="button" class="btn btn-danger profileLeavebtn" id="'.$username.'-Program-'.$record2["PID"].'">Leave</button></td>
                            </tr>';
                    }
                    echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Poster</strong></td>
                                <td><strong>Name</strong></td>
                                <td><strong>Started Playing</strong></td>
                                <td><strong>Ended Playing</strong></td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>';
                }
            ?>
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