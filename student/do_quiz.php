<?php
// session_start();
// include 'header.php';
require_once '../connection.php';
require_once './authen_student.php';
if (isset($_GET['id']) && isset($_SESSION['id'])) {
   $_SESSION['studExID'] = $quizID = $_GET['id'];
   $studID = $_SESSION['id'];
} else {
   echo "Not found";
   exit;
}

$sql = "INSERT INTO examination (studentID,testID,result,spendTime) VALUES('$studID','$quizID',-1,0)";
$res = mysqli_query($conn, $sql);
if ($res) {
   $qry = "SELECT takeExID FROM examination WHERE studentID = '$studID' and testID='$quizID' and result=-1";
   $show = mysqli_query($conn, $qry);
   $data = mysqli_fetch_assoc($show);
   $_SESSION['takingExamID'] = $data["takeExID"];
   $takeExID = $data["takeExID"];
   if ($show) {
      $updateResult1 = "UPDATE examination SET result=0 WHERE takeExID='$takeExID'";
      mysqli_query($conn, $updateResult1);
   }
}



$quiz = $conn->query("SELECT * FROM exam where examID =" . $quizID . " ")->fetch_array();
$duration = $quiz['duration'];
// echo $duration;
?>

<head>
   <title><?php echo $quiz['exName'] ?> | Answer Sheet</title>
</head>

<style>
   li.answer {
      cursor: pointer;
   }

   li.answer:hover {
      background: #00c4ff3d;
   }

   li.answer input:checked {
      background: #00c4ff3d;
   }
</style>

<body onload="f2()">
   <form id="form1" runat="server">
      <div>
         <table width="100%" align="center">
            <tr>
               <td colspan="2">
               </td>
            </tr>
            <tr>
               <td>
                  <div id="showtime" class="text-danger"></div>
               </td>
            </tr>
            <tr>
               <td>
                  <br>
               </td>
            </tr>
         </table>
         <br>
      </div>
   </form>
</body>
<div class="container-fluid admin">
   <div class="col-md-12 alert alert-primary"><?php echo $quiz['exName'] ?></div>
   <br>
   <div class="card">
      <div class="card-body">
         <form action="submit_answer.html" id="answer-sheet" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
            <input type="hidden" name="quiz_id" value="<?php echo $quizID ?>">
            <?php
            $question = "SELECT * FROM question join exam_content on (questID = questionID) WHERE exID = $quizID";
            $records = mysqli_query($conn, $question);
            $i = 1;
            if (mysqli_num_rows($records) > 0) {
               while ($data = mysqli_fetch_assoc($records)) {
            ?>
                  <ul class="q-items list-group mt-4 mb-4">
                     <li class="q-field list-group-item">
                        <strong><?php echo ($i) . '. '; ?> <?php echo $data['question'] ?></strong>
                        <input type="hidden" name="question_id[<?php echo $data['questID'] ?>]" value="<?php echo $data['questID'] ?>">
                        <br>
                        <ul class='list-group mt-4 mb-4'>
                           <li class="answer list-group-item">
                              <label><input type="radio" name="answer[<?php echo $i; ?>]" value="<?php echo $data['answerA'] ?>"> <?php echo $data['answerA'] ?></label>
                           </li>
                           <li class="answer list-group-item">
                              <label><input type="radio" name="answer[<?php echo $i; ?>]" value="<?php echo $data['answerB'] ?>"> <?php echo $data['answerB'] ?></label>
                           </li>
                           <li class="answer list-group-item">
                              <label><input type="radio" name="answer[<?php echo $i; ?>]" value="<?php echo $data['answerC'] ?>"> <?php echo $data['answerC'] ?></label>
                           </li>
                           <li class="answer list-group-item">
                              <label><input type="radio" name="answer[<?php echo $i++; ?>]" value="<?php echo $data['answerD'] ?>"> <?php echo $data['answerD'] ?></label>
                           </li>
                        </ul>
                     </li>
                  </ul>
            <?php }
            } else {
               echo "No questions for this exam";
            } ?>
            <input type="submit" name="submitAns" class="btn btn-primary subAns" onclick="f1()" value="Submit">
         </form>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('.answer').each(function() {
         $(this).click(function() {
            $(this).find('input[type="radio"]').prop('checked', true)
            $(this).css('background', '#00c4ff3d')
            $(this).siblings('li').css('background', 'white')
         })
      })
   })

   var tim;
   var sec = 01;
   var duration = "<?php echo $duration ?>";
   var min = "<?php echo $duration ?>";

   function f2() {
      if (parseInt(sec) > 0) {
         sec = parseInt(sec) - 1;
         document.getElementById("showtime").innerHTML = "Time remain: " + min + " m " + sec + " s";
         tim = setTimeout("f2()", 1000);
      } else {
         if (parseInt(sec) == 0) {

            if (parseInt(min) == 0) {
               clearTimeout(tim);
               $(document).ready(function() {
                  $('.subAns').click();
               });
            } else {
               min = parseInt(min) - 1;
               sec = 59;
               document.getElementById("showtime").innerHTML = "Time remain: " + min + " m " + sec + " s";
               tim = setTimeout("f2()", 1000);
            }
         }
      }
   }
   var minDone = 0;
   var secDone = 0;

   function f1() {
      if (sec == 0) {
         minDone = duration - min;
         secDone = 0;
      } else {
         minDone = duration - min - 1;
         secDone = 60 - sec;
      }
      console.log('abc');

      document.cookie = "myMin = " + minDone;
      document.cookie = "mySec = " + secDone;
   }

   window.location.hash = "no-back-button";
   window.location.hash = "Again-No-back-button"; //again because google chrome don't insert first hash into history
   window.onhashchange = function() {
      window.location.hash = "no-back-button";
   }

   function disableF5(e) {
      if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault();
   };

   $(document).ready(function() {
      $(document).on("keydown", disableF5);
   });
</script>