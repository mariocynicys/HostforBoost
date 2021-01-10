<?php include("top.php"); ?>

<?php

$sql = "SELECT COUNT(*) as `GamesCount` FROM `GamesHistory` t1, `Game` t2 WHERE t1.UserName='".$username."' AND t2.GID=t1.GID;";
$result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
$record = mysqli_fetch_assoc($result_set);
$displayGames='';  
if($record['GamesCount'] == 0) $displayGames="none";

$sql = "SELECT COUNT(*) as `ProgramsCount` FROM `ProgramsHistory` t1, `Program` t2 WHERE t1.UserName='".$username."' AND t2.PID=t1.PID;";
$result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
$record = mysqli_fetch_assoc($result_set);
$displayPrograms='';  
if($record['ProgramsCount'] == 0) $displayPrograms="none";

if($displayGames=="none" && $displayPrograms=="none"){
    echo    '<div class="container-fluid" style="text-align: center;">
                <h4 class="text-dark mb-4">Start playing games or using programs now!</h4>
            </div>';
}

?>
<div class="container-fluid" style="display: <?php echo $displayGames; ?>;">
    <h3 class="text-dark mb-4">Games Played</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Games Info</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover my-0" id="gamesTable2" data-toggle="table" data-pagination="true" data-page-size="2" data-page-list="[2,4,all]" data-page-length="3" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th data-sortable="true">Name</th>
                            <th data-sortable="true">Started Playing</th>
                            <th data-sortable="true">Ended Playing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT t2.GPoster, t2.GName, t1.GStarted, t1.GEnded FROM `GamesHistory` t1, `Game` t2 WHERE t1.UserName='".$username."' AND t2.GID=t1.GID;";
                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                        while ($record = mysqli_fetch_assoc($result_set)) {
                        ?>
                            <tr>
                                <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/games/<?php echo $record['GPoster']; ?>"></td>
                                <td class="text-left"><?php echo $record['GName']; ?></td>
                                <td class="text-left"><?php echo $record['GStarted']; ?></td>
                                <td class="text-left">
                                    <?php 
                                        if($record['GEnded'] == '') echo "still playing"; 
                                        else echo $record['GEnded']; 
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
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
            </div>
        </div>
    </div>
</div>

<!-- Display the users programs history if any -->
<div class="container-fluid" style="display: <?php echo $displayPrograms; ?>; margin-top: 50px;">
    <h3 class="text-dark mb-4">Programs Used</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Programs Info</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover my-0" id="programsTable2" data-toggle="table" data-pagination="true" data-page-size="2" data-page-list="[2,4,all]" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th data-sortable="true">Name</th>
                            <th data-sortable="true">Started Playing</th>
                            <th data-sortable="true">Ended Playing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT t2.PPoster, t2.PName, t1.PStarted, t1.PEnded FROM `ProgramsHistory` t1, `Program` t2 WHERE t1.UserName='".$username."' AND t2.PID=t1.PID;";
                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                        while ($record = mysqli_fetch_assoc($result_set)) {
                        ?>
                            <tr>
                                <td><img class="rounded mr-2" width="129" height="172" src="../../assets/img/programs/<?php echo $record['PPoster']; ?>"></td>
                                <td class="text-left"><?php echo $record['PName']; ?></td>
                                <td class="text-left"><?php echo $record['PStarted']; ?></td>
                                <td class="text-left">
                                    <?php 
                                        if($record['PEnded'] == '') echo "still in use.."; 
                                        else echo $record['PEnded']; 
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
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
            </div>
        </div>
    </div>
</div>

</div>
<?php include("lower.php"); ?>