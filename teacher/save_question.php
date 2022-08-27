<?php
// session_start();
require_once('../connection.php');
require_once('./authen_teacher.php');
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if (isset($_SESSION['examID'])) {
   $exid = $_SESSION['examID'];
} else {
   exit;
}
$testnameErr = '';
$testquestion = $ansA = $ansB = $ansC = $ansD = $correctAns = $examID = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // var_dump($_POST['questionContent']);
   // var_dump($_POST['ansA']);
   // var_dump($_POST['ansB']);
   // var_dump($_POST['ansC']);
   // var_dump($_SESSION['testname']);

   if (
      !empty($_POST['questionContent']) && !empty($_POST['ansA'])
      && !empty($_POST['ansB']) && !empty($_POST['ansC'])
      && !empty($_POST['ansD']) && !empty($_POST['check'])
   ) {
      $testquestion = test_input($_POST['questionContent']);
      $questid = test_input($_POST['questid']);
      $ansA = test_input($_POST['ansA']);
      $ansB = test_input($_POST['ansB']);
      $ansC = test_input($_POST['ansC']);
      $ansD = test_input($_POST['ansD']);
      $optAns = test_input($_POST['check']);
      $correctAns = ($optAns == "A" ? $ansA : ($optAns == "B" ? $ansB : ($optAns == "C" ? $ansC : $ansD)));
      if (empty($questid)) { // add question
         $sql = "INSERT INTO question (question,answerA,answerB,answerC,answerD,correctAns) 
      VALUES ('$testquestion','$ansA','$ansB','$ansC','$ansD','$correctAns')";
         if (mysqli_query($conn, $sql)) {
            // take questionID
            $query = "SELECT * FROM question WHERE question = '$testquestion'";
            $res = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($res);
            $questid = $data['questID'];
            // take exam id
            if (!empty($questid) && !empty($exid)) {
               $sql2 = "INSERT INTO exam_content(exID,questionID) VALUES ('$exid','$questid')";
               if (mysqli_query($conn, $sql2)) {
                  echo 1;
               } else {
                  echo 2;
               }
            }
         } else {
            echo 2;
         }
      } else { // update question
         $sql = "UPDATE question
                  SET question = '$testquestion', 
                        answerA='$ansA', answerB='$ansB', answerC='$ansC', answerD='$ansD', 
                        correctAns='$correctAns'
                  WHERE questID= '$questid'";
         if (mysqli_query($conn, $sql)) {
            echo 3;
         } else {
            echo 4;
         }
      }
   } else {
      echo 5;
   }
}
