<?php
require_once('../connection.php');
require_once('./authen_teacher.php');
if (isset($_GET['takeExID']) && isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $takeExID = $_GET['takeExID'];
    $userid = $_SESSION['id'];
    $username = $_SESSION["username"];
} else {
    echo "Not found";
    exit;
}
$exam = $conn->query("SELECT * FROM examination JOIN exam on testID=examID WHERE takeExID = '$takeExID' AND teacherID ='$userid' ")->fetch_assoc();
if (!empty($exam)) {
?>

    <head>
        <title><?php echo $exam['exName'] ?> | Exam result</title>
    </head>

    <body>
        <style>
            .true_ans {
                background: rgb(86 255 16 / 55%);
            }

            .wrong_ans {
                background: rgb(255 0 0 / 62%);
            }
        </style>

        <div class="container-fluid admin">
            <div class="row rounded m-1 p-2 alert alert-primary">
                <strong>
                    <?php
                    echo "<span class='col-md-2'>Exam: " . $exam['exName'] .  " </span><span class='col-md-3'> Spent time: " . $exam['spendTime'] .  "</span>";
                    ?>
                </strong>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <form action="" id="answer-sheet">
                        <?php
                        $exid = $exam['examID'];
                        $listQuestion = $conn->query("SELECT * FROM question join exam_content on (questID = questionID) WHERE exID =$exid ");
                        $listStuAns = $conn->query("SELECT * FROM exhistory WHERE takenExID = $takeExID");
                        $i = 1;
                        $corr = 0;
                        if (mysqli_num_rows($listQuestion) > 0 && mysqli_num_rows($listStuAns) > 0) {
                            while ($data = mysqli_fetch_assoc($listQuestion)) {
                                $ans = mysqli_fetch_assoc($listStuAns);
                                if ($data['correctAns'] == $ans['studentAns']) {
                                    $corr = $corr + 1;
                                }
                        ?>
                                <ul class="q-items list-group mt-4 mb-4">
                                    <li class="q-field list-group-item">
                                        <strong><?php echo ($i++) . '. '; ?> <?php echo $data['question'] ?></strong>
                                        <input type="hidden" name="question_id[<?php echo $data['questID'] ?>]" value="<?php echo $data['questID'] ?>">
                                        <br>
                                        <ul class='list-group mt-4 mb-4'>
                                            <li class="answer list-group-item">
                                                <label>
                                                    <?php echo $data['answerA'] ?>
                                                </label>
                                                <span class="text-success"> <?php echo ($data['correctAns'] == $data['answerA'] ? '✔' : ''); ?></span>
                                                <span class="text-danger"><?php echo ($data['correctAns'] != $data['answerA'] && $data['answerA'] == $ans['studentAns'] ? '✖' : ''); ?></span>
                                            </li>
                                            <li class="answer list-group-item">
                                                <label>
                                                    <?php echo $data['answerB'] ?>
                                                </label>
                                                <span class="text-success"> <?php echo ($data['correctAns'] == $data['answerB'] ? '✔' : ''); ?></span>
                                                <span class="text-danger"><?php echo ($data['correctAns'] != $data['answerB'] && $data['answerB'] == $ans['studentAns'] ? '✖' : ''); ?></span>
                                            </li>
                                            <li class="answer list-group-item">
                                                <label>
                                                    <?php echo $data['answerC'] ?>
                                                </label>
                                                <span class="text-success"> <?php echo ($data['correctAns'] == $data['answerC'] ? '✔' : ''); ?></span>
                                                <span class="text-danger"><?php echo ($data['correctAns'] != $data['answerC'] && $data['answerC'] == $ans['studentAns'] ? '✖' : ''); ?></span>
                                            </li>
                                            <li class="answer list-group-item">
                                                <label>
                                                    <?php echo $data['answerD'] ?>
                                                </label>
                                                <span class="text-success"> <?php echo ($data['correctAns'] == $data['answerD'] ? '✔' : ''); ?></span>
                                                <span class="text-danger"><?php echo ($data['correctAns'] != $data['answerD'] && $data['answerD'] == $ans['studentAns'] ? '✖' : ''); ?></span>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                        <?php
                            }
                        } else {
                            echo "Student not doing this exam";
                            exit;
                        } ?>

                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="row rounded m-1 p-2 alert-success">
                        <?php
                        $score = round($corr / ($i - 1) * 10, 2);
                        echo "<h3 class='col-md-6'>Correct answer: " . $corr . "/" . ($i - 1) . " </h3><h3 class='col-md-6'>| Score: " . $score .  "</h3>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php

} else {

    echo "<div class='col-md-12 alert alert-primary'>Record does not exist <div>";
}
?>
<br>
<a href="index.php?page=exam_record_list" class='btn btn-primary m-1 p-2'>Back</a>