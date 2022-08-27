<?php
require_once('../connection.php');
require_once('./authen_teacher.php');

?>
<div class="container-fluid">
   <div class="card-body shadow p-3 mb-5">
      <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Student list</h3>
      <div class="table-responsive">
         <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-dark bg-light">
               <tr>
                  <th class="th-sm">Account ID</th>
                  <th class="th-sm">Username</th>
                  <th class="th-sm">Email</th>
                  <th class="th-sm">Create Day</th>
               </tr>
            </thead>
            <tbody>
               <?php
               require_once("../connection.php");
               $sql_select = "SELECT * FROM account WHERE role='student' order by accountID desc";
               $result = $conn->query($sql_select);
               if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
               ?>
                     <tr>
                        <td><?= $row['accountID'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['createDAY'] ?></td>

                     </tr>
               <?php }
               } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
      $('#dataTable').dataTable({
         "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
         ]
      });
   });
</script>