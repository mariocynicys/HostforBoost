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
</div>
<?php include("lower.php"); ?>