<?php include("top.php"); ?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Programs</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Programs Info</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-hover my-0" id="programsTable" data-search="true" data-pagination="true" data-toggle="table" data-detail-view="true" data-detail-formatter="detailFormatter2" data-page-size="5" data-page-list="[5,10,15,all]" data-pagenation-pre-text="Prev" data-pagenation-next-text="Next" data-pagenation-detail-h-alaign="right" data-locale="en-us">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th data-sortable="true">Name</th>
                            <th data-sortable="true">Released date</th>
                            <th>License</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * from `Program`";
                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                        while ($record = mysqli_fetch_assoc($result_set)) {
                        ?>
                            <tr data-PID="<?php echo $record['PID']; ?>" data-curUser="<?php echo $username; ?>">
                                <td><img class="rounded mr-2" width="150" height="145" src="../../assets/img/programs/<?php echo $record['PPoster']; ?>"></td>
                                <td class="text-left"><?php echo $record['PName']; ?></td>
                                <td class="text-left"><?php echo $record['PReleasedDate']; ?></td>
                                <td class="text-left"><?php echo $record['PPublisher']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Poster</strong></td>
                            <td><strong>Name</strong></td>
                            <td><strong>Released Date</strong></td>
                            <td><strong>License</strong></td>
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