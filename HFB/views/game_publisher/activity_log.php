<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Current Activities</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Update Games Info</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover my-0" id="gamesTable" data-toggle="table" data-pagination="true" data-page-size="5" data-page-list="[5,10,15,all]" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th data-sortable="true">Name</th>
                            <th>Genre</th>
                            <th data-sortable="true">Released date</th>
                            <th>Publisher</th>
                            <th data-sortable="true">Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `Game` t1 WHERE t1.GID IN (SELECT t2.GID FROM `GamesPublishersHistory` t2 WHERE t2.UserName='$username');";
                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                        while ($record = mysqli_fetch_assoc($result_set)) {
                        ?>
                            <tr data-GID=<?php echo $record['GID']; ?> data-curUser="<?php echo $username; ?>">
                                <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/games/<?php echo $record['GPoster']; ?>"></td>
                                <td class="text-left"><?php echo $record['GName']; ?></td>
                                <td class="text-left"><?php echo $record['GGenre']; ?></td>
                                <td class="text-left"><?php echo $record['GReleasedDate']; ?></td>
                                <td class="text-left"><?php echo $record['GPublisher']; ?></td>
                                <td class="text-left"><?php echo $record['GRate']; ?>/10</td>
                                <td><button type="button" class="btn btn-danger updateGame" id="<?php echo $record['GID']; ?>"><i class="fa fa-edit"></i> Update</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Poster</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Genre</strong></td>
                            <td><strong>Released Date</strong></td>
                            <td><strong>Publisher</strong></td>
                            <td><strong>Rate</strong></td>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal to be used later-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update this game info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_game_form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="alert alert-success alert-dismissible fade show" id="modal_alert" role="alert" style="display: none;">
                    <strong id="modal_alert_content"></strong>
                    <button type="button" class="close alert_close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div id="modal_content"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="update_game" value="update_game">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
<?php include("lower.php"); ?>