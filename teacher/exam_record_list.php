<?php
require_once('../connection.php');
require_once('./authen_teacher.php');
if (isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
} else {
    exit;
}

?>

<head>
    <title>Quiz Record</title>
</head>
<div class="container-fluid">
    <div class="card-body shadow p-3 mb-5">
        <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Exam Record List</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="recordTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="th-sm">Taken Exam ID</th>
                        <th class="th-sm">Student Name</th>
                        <th class="th-sm">Exam Name</th>
                        <th class="th-sm">Topic</th>
                        <th class="th-sm">Difficult</th>
                        <th class="th-sm">Taken Day</th>
                        <th class="th-sm">Spending Time</th>
                        <th class="th-sm">Score</th>
                        <th class="th-sm">View record</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT takeExID,username,exName,topic,diff_level,testDay,result,spendTime FROM (exam join examination on (testID = examID)) join account on(studentID=accountID) order by takeExID desc";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $data['takeExID'] ?></td>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['exName'] ?></td>
                                <td><?= $data['topic'] ?></td>
                                <td><?= $data['diff_level'] ?></td>
                                <td><?= $data['testDay'] ?></td>
                                <td><?= $data['spendTime'] ?></td>
                                <td><?= $data['result'] ?></td>
                                <td>
                                    <a href="exam-record/<?php echo $data['takeExID'] ?>/<?php echo makeUrl($data['exName']) ?>.html" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#recordTable').dataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "aaSorting": [],
            columnDefs: [{
                orderable: false,
                targets: 8
            }]
        });
    });
</script>