<?php
require_once('../connection.php');
require_once('./authen_teacher.php');
?>

<head>
   <title>Exam List</title>
</head>

<body>
   <div class="container-fluid">
      <div class="col-md-12 alert alert-primary">Exam List</div>
      <?php if (isset($_SESSION["error"])) {
         echo "<div style='color:red'>" . $_SESSION["error"] . "</div>";
         unset($_SESSION["error"]);
      } ?>
      <a data-toggle="modal" data-target="#manage_quiz" class="btn btn-primary bt-sm" id="new_quiz">
         <i class="fa fa-plus"></i> Add New
      </a>
      <br>
      <br>
      <div class="card">
         <div class="card-body shadow p-3 mb-5">
            <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Exam list</h3>
            <div class="table-responsive">
               <table class="table table-bordered table-striped" id='table' width="100%" cellspacing="0">
                  <thead class="text-dark bg-light">
                     <tr>
                        <th class="th-sm">ExamID</th>
                        <th class="th-sm">Exam</th>
                        <th class="th-sm">Topic</th>
                        <th class="th-sm">Difficulty</th>
                        <th class="th-sm">Duration</th>
                        <th class="th-sm">Create day</th>
                        <th class="th-sm">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $i = 1;
                     $query = "SELECT * FROM exam WHERE teacherID = " . $_SESSION['id'] . " order by examID desc";
                     $records = mysqli_query($conn, $query);
                     if (mysqli_num_rows($records) > 0) {
                        while ($data = mysqli_fetch_assoc($records)) { ?>
                           <tr>
                              <td><?= $data['examID'] ?></td>
                              <td><?= $data['exName'] ?></td>
                              <td><?= $data['topic'] ?></td>
                              <td><?= $data['diff_level'] ?></td>
                              <td><?= $data['duration'] ?> mins</td>
                              <td><?= $data['createDay'] ?></td>
                              <td>
                                 <a href="exam/<?php echo $data['examID'] ?>/<?php echo makeUrl($data['exName']) ?>.html" class="btn btn-primary view_exam" type="button">
                                    View
                                 </a>
                              </td>
                           </tr>
                     <?php }
                     }
                     ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="manage_quiz" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">

               <h4 class="modal-title" id="myModallabel">Add New quiz</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method='post' id='quiz-frm' action='./create_exam.php'>
               <div class="modal-body">
                  <div id="msg"></div>
                  <div class="form-group">
                     <label>Test name</label>
                     <!-- <input type="hidden" name="id" /> -->
                     <input type="text" name="testname" required class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Topic</label>
                     <input type="text" name="topic" required class="form-control" />
                  </div>
                  <div class="form-group">
                     <label>Duration</label>
                     <select id="duration" name="duration" required class="form-control">
                        <option value="5">5 mins</option>
                        <option value="10">10 mins</option>
                        <option value="15">15 mins</option>
                        <option value="30">30 mins</option>
                        <option value="60">60 mins</option>
                        <option value="90">90 mins</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Difficulty</label>
                     <select id="diff_level" name="diff_level" required class="form-control">
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                     </select>
                  </div>
               </div>
               <div class="modal-footer">
                  <input class="btn btn-primary" name="save" type="submit" value="Save">
               </div>
            </form>
         </div>
      </div>
   </div>
</body>
<script>
   $(document).ready(function() {
      // $('#table').DataTable();
      $('#new_quiz').click(function() {
         $('#msg').html('')
         $('#manage_quiz .modal-title').html('Add New quiz')
         $('#manage_quiz #quiz-frm').get(0).reset()
         $('#manage_quiz').modal('show')
      })
      // $('.view_exam').click(function() {
      //    var id = $(this).attr('data-id')
      //    console.log(id)
      //    $.ajax({
      //       url: './view_exam.php?examid=' + id,
      //       error: err => console.log(err),
      //       success: function(resp) {
      //          console.log(resp)
      //          window.location.assign("view_exam.php?examid=" + id);
      //       }
      //    })

      // })
      $('#table').dataTable({
         "lengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
         ],
         "aaSorting": [],
         columnDefs: [{
            orderable: false,
            targets: 5
         }]
      })
   })
</script>