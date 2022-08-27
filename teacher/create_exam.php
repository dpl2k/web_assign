<?php
// session_start();
require_once('../connection.php');
require_once('./authen_teacher.php');
if (isset($_SESSION['id']))
   $getID = $_SESSION['id'];
else {
   exit;
}
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$testnameErr = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $testname = test_input($_POST['testname']);
   $topic = test_input($_POST['topic']);
   $diff = test_input($_POST['diff_level']);
   $duration = test_input($_POST['duration']);
   $sql = "SELECT exName FROM exam WHERE exName = '$testname'";
   $res = mysqli_query($conn, $sql);
   if (mysqli_num_rows($res) > 0) {
      $testnameErr = "Sorry the exam name already exists. Please try again";
      $_SESSION["error"] = $testnameErr;
      header("location: exam_list.html");
      exit;
   }
   if (empty($testnameErr)) {
      $sql = "INSERT INTO exam (teacherID,exName,topic,diff_level,duration) VALUES ('$getID','$testname','$topic','$diff', '$duration')";
      if (mysqli_query($conn, $sql)) {
         // $_SESSION['testname'] = $testname;
         // take exam id
         $query = "SELECT * FROM exam WHERE exName = '$testname'";
         $res = mysqli_query($conn, $query);
         $data = mysqli_fetch_assoc($res);
         $_SESSION['examID'] = $data['examID'];
         header("location: new_question.html");
      } else {
         echo "<script language='javascript'>
                  alert('Failed to add new quiz');
                  window.location='exam_list.html';
               </script>";
         // $_SESSION["error"] = "Failed to add new quiz";
         // header("location: index.php?page=listQuiz");
         // exit;
      }
   }
}
