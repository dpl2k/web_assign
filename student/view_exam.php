<?php
// session_start();
// include 'header.php';
require_once '../connection.php';
require_once './authen_student.php';
$quizID = $_GET['id'];
$takeExamID = $_GET['tid'];
$_SESSION['studExID'] = $quizID;
$studID = $_SESSION['id'];
$array = array();
$arrayQuestions = array();
$arrayCorrectAns = array();
$arrayStudentAns = array();
$arrayA = array();
$arrayB = array();
$arrayC = array();
$arrayD = array();
$score = 0;
$i = 0;
if (isset($_SESSION['studExID']) && isset($_SESSION['id'])) {
   $studExID = $_SESSION['studExID'];
} else {
   exit;
}

$getSpendTime = "SELECT * FROM examination WHERE testID='$quizID' and takeExID = '$takeExamID' and studentID='$studID'";
$ketqua = mysqli_query($conn, $getSpendTime);
if (mysqli_num_rows($ketqua) > 0) {
   $f = mysqli_fetch_assoc($ketqua);
   $spTime = $f["spendTime"];
}


$query = "SELECT * FROM exam_content WHERE exID='$studExID' ";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0) {
   while ($fetch_data = mysqli_fetch_assoc($res)) {
      $quesID = $fetch_data["questionID"];
      array_push($array, $quesID);
   }

   $question = "SELECT * FROM question join exam_content on (questID = questionID) WHERE exID = $studExID";
   $records = mysqli_query($conn, $question);
   if (mysqli_num_rows($records) > 0) {
      while ($data = mysqli_fetch_assoc($records)) {
         $correctAns = $data['correctAns'];
         $questions = $data['question'];
         $resultA = $data['answerA'];
         $resultB = $data['answerB'];
         $resultC = $data['answerC'];
         $resultD = $data['answerD'];
         array_push($arrayA, $resultA);
         array_push($arrayB, $resultB);
         array_push($arrayC, $resultC);
         array_push($arrayD, $resultD);
         array_push($arrayQuestions, $questions);
         array_push($arrayCorrectAns, $correctAns);
      }
      $totalQuestion = count($arrayCorrectAns);
   }

   $queryAns = "SELECT * FROM exhistory WHERE testExamID=$studExID and takenExID=$takeExamID";
   $result = mysqli_query($conn, $queryAns);
   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
         $studentAns = $row['studentAns'];
         array_push($arrayStudentAns, $studentAns);
      }
      echo "<span> Spend Time: " . $spTime . "</span>";
      $totalAnswer = count($arrayStudentAns);
   } else {
      echo "\nStudent not doing this exam";
      exit;
   }

   $queryName = "SELECT exName FROM exam WHERE examID=$studExID";
   $show = mysqli_query($conn, $queryName);
   $getName = mysqli_fetch_assoc($show);
   $examName = $getName['exName'];
} ?>
<div class="col-md-12 alert alert-primary"><?php echo $examName ?></div>
<?php for ($x = 0; $x < $totalQuestion; $x++) {
   if ($arrayStudentAns[$x] == $arrayCorrectAns[$x]) {
      $score = $score + 1;
   }
?>
   <div class="container-fluid admin">
      <div class="card">
         <div class="card-body">
            <form id="answer-sheet">
               <ul class="q-items list-group mt-4 mb-4">
                  <li class="q-field list-group-item">
                     <strong><?php echo ($x + 1) . '.' . $arrayQuestions[$x] ?><?php if ($arrayStudentAns[$x] == 'none') echo "<span class='text-danger'>" . " You didn't answer this question" . "</span>"; ?></strong>
                     <ul class='list-group mt-4 mb-4'>
                        <li class="answer list-group-item">
                           <label>
                              A. <?php echo $arrayA[$x] ?>
                           </label>
                           <span style="text-align:right !important" class="text-success"> <?php echo ($arrayA[$x] == $arrayCorrectAns[$x] ? '✔' : ''); ?></span>
                           <span style="text-align:right" class=" text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayA[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                        </li>
                        <li class="answer list-group-item">
                           <label>
                              B. <?php echo $arrayB[$x] ?>
                           </label>
                           <span style="text-align:right" class="text-success"> <?php echo ($arrayB[$x] == $arrayCorrectAns[$x] ? '✔' : ''); ?></span>
                           <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayB[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                        </li>
                        <li class="answer list-group-item">
                           <label>
                              C. <?php echo $arrayC[$x] ?>
                           </label>
                           <span style="text-align:right" class="text-success"> <?php echo ($arrayC[$x] == $arrayCorrectAns[$x] ? '✔' : ''); ?></span>
                           <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayC[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                        </li>
                        <li class="answer list-group-item">
                           <label>
                              D. <?php echo $arrayD[$x] ?>
                           </label>
                           <span style="text-align:right" class="text-success"> <?php echo ($arrayD[$x] == $arrayCorrectAns[$x] ? '✔' : ''); ?></span>
                           <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayD[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                        </li>
                     </ul>
                  </li>
            </form>
         </div>
      </div>
   </div>
<?php } ?>
<br>
<div class="container-fluid admin">
   <div class='card'>
      <div class="card-body">
         <div class="row rounded m-1 p-2 alert-success">
            <?php echo "<h3 class='text-danger col-md-6'>Correct Answer: " . $score . '/' . $totalQuestion . "</h3>
            <h3 class='text-danger col-md-6'>|Score: " . round(($score / $totalQuestion) * 10, 2) . "</h3>" ?>
         </div>
      </div>
   </div>
</div>
<br>
<?php
mysqli_close($conn);
?>
<a href="quiz_record_list.html" class='btn btn-primary'>Back</a>