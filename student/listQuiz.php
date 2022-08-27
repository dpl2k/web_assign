<?php
require_once '../connection.php';
require_once './authen_student.php';
?>

<!-- DataTales Example -->
<div class="card-body shadow p-3 mb-5">
   <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Quiz list</h3>
   <div class="table-responsive">
      <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
         <thead>
            <tr>
               <th class="th-sm">Exam</th>
               <th class="th-sm">Teacher</th>
               <th class="th-sm">Topic</th>
               <th class="th-sm">Difficulty</th>
               <th class="th-sm">Create day</th>
               <th class="th-sm">Duration</th>
               <th class="th-sm">Do the exam</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $sql_select = "SELECT * FROM exam join account on (teacherID = accountID) order by accountID desc";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0) {
               while ($data = $result->fetch_assoc()) {
            ?>
                  <tr>
                     <td><?= $data['exName'] ?></td>
                     <td><?= $data['username'] ?></td>
                     <td><?= $data['topic'] ?></td>
                     <td><?= $data['diff_level'] ?></td>
                     <td><?= $data['createDay'] ?></td>
                     <td><?= $data['duration'] ?> mins</td>
                     <td>
                        <a href="index.php?page=do_quiz&id=<?php echo $data['examID'] ?>" data-id=<?php echo $data['examID'] ?> class="btn btn-primary startNow">
                           Start now
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
            targets: 6
         }]
      });
   });
</script>