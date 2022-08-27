<?php
require_once '../connection.php';
// require_once './authen_student.php';
if (isset($_SESSION['id']) && isset($_SESSION['takingExamID']) && isset($_SESSION['studExID'])) {
   $stID = $_SESSION['id'];
   $takeExID = $_SESSION['takingExamID'];
   $studExID = $_SESSION['studExID'];
} else {
   echo "Not found";
   // var_dump($_SESSION['id']);
   // var_dump($_SESSION['takingExamID']);
   // var_dump($_SESSION['studExID']);
   exit;
}
$minute = $_COOKIE['myMin'];
$seconds = $_COOKIE['mySec'];
$stringTime = $minute . ' min ' . $seconds . ' sec';
echo "SpendTime: " . $stringTime;
// var_dump($minute);
// var_dump($seconds);
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

// $qry = "SELECT takeExID FROM examination WHERE studentID = '$stID' and testID='$studExID' and result=-1";
// $show = mysqli_query($conn, $qry);
// $data = mysqli_fetch_assoc($show);

if (isset($_POST['submitAns'])) {
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

      for ($k = 1; $k <= $totalQuestion; $k++) {
         if (!isset($_POST['answer'][$k])) {
            $option_val = 'none';
         } else {
            $option_val = $_POST['answer'][$k];
         }
         $sql = "INSERT INTO exhistory (takenExID,testExamID,testQuestID,studentAns) VALUES ('$takeExID','$studExID','$array[$i]','$option_val')";
         $i++;
         mysqli_query($conn, $sql);
      }

      $queryAns = "SELECT * FROM exhistory WHERE testExamID=$studExID and takenExID=$takeExID";
      $result = mysqli_query($conn, $queryAns);
      if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
            $studentAns = $row['studentAns'];
            array_push($arrayStudentAns, $studentAns);
         }
         $totalAnswer = count($arrayStudentAns);
      }

      $queryName = "SELECT exName FROM exam WHERE examID=$studExID";
      $show = mysqli_query($conn, $queryName);
      $getName = mysqli_fetch_assoc($show);
      $examName = $getName['exName'];
   } ?>
   <div class="col-md-12 alert alert-primary"><?php echo $examName ?></div>
   <div class="container-fluid admin">
      <?php for ($x = 0; $x < $totalQuestion; $x++) {
         // echo $arrayStudentAns[$x].'/'.$arrayCorrectAns[$x];
         // echo"<br>";
         if ($arrayStudentAns[$x] == $arrayCorrectAns[$x]) {
            $score = $score + 1;
         }
      ?>

         <div class="card">
            <div class="card-body">
               <form id="answer-sheet">
                  <ul class="q-items list-group mt-4 mb-4">
                     <li class="q-field list-group-item">
                        <strong><?php echo ($x + 1) . '.' . $arrayQuestions[$x] . '?' ?> <?php if ($arrayStudentAns[$x] == 'none') echo "<span class='text-danger'>" . "You didn't answer this question" . "</span>"; ?></strong>
                        <ul class='list-group mt-4 mb-4'>
                           <li class="answer list-group-item">
                              <label>
                                 A. <?php echo $arrayA[$x] ?>
                              </label>
                              <span style="text-align:right !important" class="text-success"> <?php echo (($arrayA[$x] == $arrayCorrectAns[$x])  ? '✔' : ''); ?></span>
                              <span style="text-align:right" class=" text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayA[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                           </li>
                           <li class="answer list-group-item">
                              <label>
                                 B. <?php echo $arrayB[$x] ?>
                              </label>
                              <span style="text-align:right" class="text-success"> <?php echo (($arrayB[$x] == $arrayCorrectAns[$x]) ? '✔' : ''); ?></span>
                              <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayB[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                           </li>
                           <li class="answer list-group-item">
                              <label>
                                 C. <?php echo $arrayC[$x] ?>
                              </label>
                              <span style="text-align:right" class="text-success"> <?php echo (($arrayC[$x] == $arrayCorrectAns[$x])  ? '✔' : ''); ?></span>
                              <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayC[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                           </li>
                           <li class="answer list-group-item">
                              <label>
                                 D. <?php echo $arrayD[$x] ?>
                              </label>
                              <span style="text-align:right" class="text-success"> <?php echo (($arrayD[$x] == $arrayCorrectAns[$x])  ? '✔' : ''); ?></span>
                              <span style="text-align:right" class="text-danger"><?php echo ((($arrayCorrectAns[$x] != $arrayStudentAns[$x]) && ($arrayD[$x] == $arrayStudentAns[$x])) ? '✖' : ''); ?></span>
                           </li>
                        </ul>
                     </li>
               </form>
            </div>
         </div>

      <?php } ?>
   </div>
   <br>
   <div class="container-fluid admin">
      <div class='card'>
         <div class="card-body">
            <div class="row rounded m-1 p-2 alert-success">
               <?php echo "<h3 class='text-danger col-md-6'>Correct Answer: " . $score . '/' . $totalQuestion . "</h3>"
                  . "<h3 class='text-danger col-md-6'>|Score: " . round(($score / $totalQuestion) * 10, 2) . "</h3>"
               ?>
            </div>
         </div>
      </div>
   </div>
   <br>
<?php $finalResult = ($score / $totalQuestion) * 10;
   $updateResult = "UPDATE examination SET result='$finalResult',spendTime='$stringTime' WHERE takeExID='$takeExID'";
   mysqli_query($conn, $updateResult);
   unset($_SESSION['takingExamID']);
   unset($_SESSION['studExID']);
}
mysqli_close($conn);
?>
<a href="quiz_list.html" class='btn btn-primary'>Back to Quiz List</a>
<script>
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