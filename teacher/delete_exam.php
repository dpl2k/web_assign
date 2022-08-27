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
if (isset($_SESSION['examID']) && isset($_SESSION['id'])) {
    $exid = $_SESSION['examID'];
    $userid = $_SESSION["id"];
} else {
    echo -1;
    exit;
}
// echo $exid . " " . $userid;
$result1 = $result2 = $result3 = "1";
//check if delete quiz is valid
$sql = "SELECT * FROM exam WHERE examID='$exid' AND teacherID ='$userid' ";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);
// echo " " . $data['examID'];
if (!empty($data)) {
    $query1 = "SELECT questionID FROM exam_content WHERE exID='$exid' "; // select all question of an exam
    $query2 = "DELETE FROM exam_content WHERE exID='$exid' ";
    $query4 = "DELETE FROM exam WHERE examID='$exid' ";
    $listQuestion = mysqli_query($conn, $query1);

    if (mysqli_num_rows($listQuestion) > 0) {
        $result1 = mysqli_query($conn, $query2);
        while ($fetch_data = mysqli_fetch_assoc($listQuestion)) {
            $quesID = $fetch_data["questionID"];
            $query3 = "DELETE FROM question WHERE questID='$quesID' ";
            $result2 = mysqli_query($conn, $query3);
        }
    }
    $result3 = mysqli_query($conn, $query4);
    if ($result1 && $result2 && $result3) {
        unset($_SESSION['examID']);
        echo 1;
    } else {
        echo 0;
    }
    // echo "result1:" . $result1 . "result2:" . $result2 . "result3:" . $result3;
} else {
    echo $data;
}
