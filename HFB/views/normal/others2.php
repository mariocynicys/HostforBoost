<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Other Members</h3>
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Follow your friends</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $sql = "SELECT t1.UserName, t1.Email, t1.UserPic From users t1 WHERE t1.UserName!='" . $username . "' AND t1.UserName NOT IN (SELECT FriendName FROM Friends t2 WHERE t2.UserName='" . $username . "') AND t1.UserType='normal';";
                                $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                                while ($record = mysqli_fetch_assoc($result_set)) {
                                ?>
                                    <div class="col col-sm-3">
                                        <div class="card mb-3" style="text-align: center;">
                                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" width="160" height="160" src="../../assets/img/avatars/<?php echo $record['UserPic']; ?>">
                                                <p><?php echo $record['UserName']; ?><br><?php echo $record['Email']; ?></p>
                                                <div class="mb-3"><button class="btn btn-primary btn-sm followbtn" id="<?php echo $username . "-" . $record['UserName']; ?>" type="button" name="follow" value="follow">Follow</button></div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<?php include("lower.php"); ?>