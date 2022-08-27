<?php
require_once '../connection.php';
require_once './authen_student.php';
$studentID = $_SESSION['id'];
?>

<!-- DataTales Example -->
<div class="card-body shadow p-3 mb-5">
   <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Quiz History</h3>
   <div class="table-responsive">
      <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
         <thead>
            <tr>
               <th class="th-sm">TakeExamID</th>
               <th class="th-sm">Test name</th>
               <th class="th-sm">Topic</th>
               <th class="th-sm">Difficulty</th>
               <th class="th-sm">Test day</th>
               <th class="th-sm">Score</th>
               <th class="th-sm">Spent Time</th>
               <th class="th-sm">Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $sql_select = "SELECT * FROM examination join exam on (testID = examID) WHERE studentID=$studentID";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0) {
               while ($data = $result->fetch_assoc()) {
            ?>
                  <tr>
                     <td><?= $data['takeExID'] ?></td>
                     <td><?= $data['exName'] ?></td>
                     <td><?= $data['topic'] ?></td>
                     <td><?= $data['diff_level'] ?></td>
                     <td><?= $data['testDay'] ?></td>
                     <td><?= $data['result'] ?></td>
                     <td><?= $data['spendTime'] ?></td>
                     <td>
                        <a href="view-record/<?php echo $data['examID'] ?>/<?php echo $data['takeExID'] ?>/<?= makeUrl($data['exName']) ?>.html" class="btn btn-primary">View exam
                        </a>
                     </td>
                  </tr>
            <?php }
            } ?>
         </tbody>
      </table>
   </div>
</div>
<script>
   $(document).ready(function() {
      $('#dataTable').dataTable({
         "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
         ],
         "aaSorting": [],
         columnDefs: [{
            orderable: false,
            targets: 7
         }]
      });
   });
</script>