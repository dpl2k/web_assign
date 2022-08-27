<?php
require_once('../connection.php');
require_once('./authen_teacher.php');
if (isset($_GET['examid']) && isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $exid = $_GET['examid'];
    $userid = $_SESSION['id'];
    $username = $_SESSION["username"];
} else {
    echo "Not found";
    exit;
}
$exam = $conn->query("SELECT * FROM exam WHERE examID = '$exid' AND teacherID ='$userid' ")->fetch_assoc();
if (!empty($exam)) {
?>

    <head>
        <title><?php echo $exam['exName'] ?> | Exam review</title>
    </head>

    <body>
        <style>
            .true_ans {
                background: rgb(86 255 16 / 55%);
            }
        </style>

        <div class="container-fluid admin">
            <div class="row rounded m-1 p-2 alert alert-primary">
                <strong>
                    <?php
                    echo "<span class='col-md-2'>Exam: " . $exam['exName'] .  " </span><span class='col-md-3'> Spent time: " . $exam['duration']  .  " mins</span>"
                        .  " </span><span class='col-md-3'> Topic: " . $exam['topic']  .  "</span>"
                        .  " </span><span class='col-md-3'> Difficulty: " . $exam['diff_level']  .  "</span>";
                    ?>
                </strong>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <form action="" id="answer-sheet">
                        <input type="hidden" name="user_id" value="<?php echo $userid ?>">
                        <input type="hidden" name="quiz_id" value="<?php echo $exid ?>">
                        <?php
                        $listQuestion = $conn->query("SELECT * FROM question join exam_content on (questID = questionID) WHERE exID = $exid");
                        $i = 1;
                        if (mysqli_num_rows($listQuestion) > 0) {
                            while ($data = mysqli_fetch_assoc($listQuestion)) {
                        ?>
                                <ul class="q-items list-group mt-4 mb-4">
                                    <li class="q-field list-group-item">
                                        <strong><?php echo ($i++) . '. '; ?> <?php echo $data['question'] ?></strong>
                                        <input type="hidden" name="question_id[<?php echo $data['questID'] ?>]" value="<?php echo $data['questID'] ?>">
                                        <br>
                                        <ul class='list-group mt-4 mb-4'>
                                            <li class="answer list-group-item <?php echo ($data['correctAns'] == $data['answerA'] ? 'true_ans' : ''); ?>">
                                                <label>
                                                    A. <?php echo $data['answerA'] ?>
                                                </label>
                                            </li>
                                            <li class="answer list-group-item <?php echo ($data['correctAns'] == $data['answerB'] ? 'true_ans' : ''); ?> ">
                                                <label>
                                                    B. <?php echo $data['answerB'] ?>
                                                </label>
                                            </li>
                                            <li class="answer list-group-item <?php echo ($data['correctAns'] == $data['answerC'] ? 'true_ans' : ''); ?>">
                                                <label>
                                                    C. <?php echo $data['answerC'] ?>
                                                </label>
                                            </li>
                                            <li class="answer list-group-item <?php echo ($data['correctAns'] == $data['answerD'] ? 'true_ans' : ''); ?>">
                                                <label>
                                                    D. <?php echo $data['answerD'] ?>

                                                </label>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                        <?php
                            }
                        } else {
                            echo "No questions for this exam";
                        } ?>

                    </form>
                </div>
            </div>
        </div>
    </body>
<?php

}
?>