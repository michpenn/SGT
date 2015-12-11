<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = $_POST;
    function checkForStudent()
    {
        require('sgt_connect.php');
        global $student;
        $query = "SELECT `id`, `creator_id`, `name` FROM `students` WHERE name = '{$student['name']}'";
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                ?>
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Do you mean current student: <strong> <?= $student['name']; ?> </strong>
                    with student ID: <strong><?= $row['id']; ?></strong>?
                    <br>

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn btn-danger" data-dismiss="alert" aria-label="close">No
                        </button>
                    </div>
                </div>
                <?php
            }
        }
        if (mysqli_num_rows($rows) == 0) {
            ?>
            <div class="alert alert-warning fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                The student: <strong> <?= $student['name']; ?> </strong> is not currently enrolled. Would you like to
                add
                a new student?
                <br>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" onclick="addThisStudent()">Yes</button>
                    <button type="button" class="btn btn btn-danger" data-dismiss="alert" aria-label="close">No</button>
                </div>
            </div>
            <?php
        }

    }

    checkForStudent();

    function checkForCourse()
    {
        require('sgt_connect.php');
        global $student;
        $query2 = "SELECT `id`, `course` FROM `courses` WHERE course = '{$student['course']}'";
        $rows2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($rows2) > 0) {
            while ($row = mysqli_fetch_assoc($rows2)) {
                echo 'this class exists';
                print_r($row['course']);
            }
        }
        else {
            echo 'do you want to add this course?';
        }
    }
checkForCourse();
}

?>


