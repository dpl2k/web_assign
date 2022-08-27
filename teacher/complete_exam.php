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

$sql = "SELECT * FROM exam_content WHERE exID='$exid' ";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);
if (!empty($data)) {
    unset($_SESSION['examID']);
    echo 1;
} else {
    echo 0;
}
