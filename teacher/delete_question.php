<?php
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
$questionid = test_input($_GET['id']);

//check if question is delete belong to valid exam
$sql = "SELECT * FROM (question join exam_content on (questID = questionID)) 
WHERE questID = '$questionid' and exID = '$exid'";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);
if (!empty($data)) {
    $query = "DELETE FROM exam_content WHERE exID='$exid' AND questionID = '$questionid'";
    if (mysqli_query($conn, $query)) {
        $query2 = "DELETE FROM question WHERE questID ='$questionid'";
        if (mysqli_query($conn, $query2)) {
            echo true;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}
