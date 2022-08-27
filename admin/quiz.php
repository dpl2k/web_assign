<div class="card-body shadow p-3 mb-5">
    <h3 style="margin-bottom:10px" class="card-header bg-primary text-light rounded-top">Quiz list</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-dark bg-light">
                <tr>
                    <th class="th-sm">Exam ID</th>
                    <th class="th-sm">Teacher Name</th>
                    <th class="th-sm">Exam Name</th>
                    <th class="th-sm">Topic</th>
                    <th class="th-sm">Dificulty</th>
                    <th class="th-sm">Duration</th>
                    <th class="th-sm">Create Day</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../connection.php");
                $sql_select = "SELECT * FROM exam join account on (teacherID = accountID) order by accountID desc";
                $result = $conn->query($sql_select);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= $row['examID'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['exName'] ?></td>
                            <td><?= $row['topic'] ?></td>
                            <td><?= $row['diff_level'] ?></td>
                            <td><?= $row['duration'] ?> mins</td>
                            <td><?= $row['createDay'] ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $('#dataTable').DataTable();
    //     //$('.dataTables_length').addClass('bs-select');
    // });
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ]
        });
    });
</script>