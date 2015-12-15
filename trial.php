<?php
ob_start();
$checkDBfunctions = ['checkForStudent', 'checkForCourse'];

foreach ($checkDBfunctions as $function_name) {
    $function_name();
}


?>
    <form class="form-horizontal" role="form">
<?php
function checkForStudent()
{
    global $student;
    require('sgt_connect.php');
    $query = "SELECT `id`, `creator_id`, `name` FROM `students` WHERE name = '{$student['name']}'";
    $rows = mysqli_query($conn, $query);
    ?>

    <?php
    if (mysqli_num_rows($rows) > 0) {
        while ($row = mysqli_fetch_assoc($rows)) {
            ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-7">
                        This student exists in our system!
                        Are you referring to <strong> <?= $student['name']; ?> </strong>
                        with student ID: <strong><?= $row['id']; ?></strong>? </li><br>
                    </div>
                    <div class=col-xs-2> Yes <input type="radio" name="student" value="false"></div>

                    <div class=col-xs-3> No, add new student <input type="radio" name="student" value="true"></div>

                </div>
            </div>
            <?php
        }
    } elseif (mysqli_num_rows($rows) == 0) {
        ?>
        <div class="form-group">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-7">
                        The student: <strong> <?= $student['name']; ?> </strong> is not currently enrolled. Would you
                        like to
                        add
                        a new student?
                        <br>
                    </div>
                    <div class=col-xs-2 col-xs-offset-1> Yes <input type="radio" name="student" value="true"></div>

                    <div class=col-xs-2> No <input type="radio" name="student" value="null"></div>

                </div>
            </div>
        </div>
        <?php

    }

}

function checkForCourse()
{
    global $student;
    require('sgt_connect.php');
    $query = "SELECT `id`, `course` FROM `courses` WHERE course = '{$student['course']}'";
    $rows = mysqli_query($conn, $query);
    if (mysqli_num_rows($rows) > 0) {
        while ($row = mysqli_fetch_assoc($rows)) {

        }
    } elseif (mysqli_num_rows($rows) == 0) {

        ?>
        <div class="form-group">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-7">
                        The course: <strong><?= $student['course']; ?></strong> does not exist. Would you like to add
                        this
                        course? <br>
                    </div>
                    <div class=col-xs-2 col-xs-offset-1> Yes <input type="radio" name="course" value="newCourse"></div>
                    <div class=col-xs-2> No <input type="radio" name="course" value="nullCourse"></div>

                </div>
            </div>
        </div>

        <?php
    }
    ?>

    </form>
    <script type="text/javascript">
        $('#close_modal').click(function () {
            console.log('here is how to get the radio values');
            var newStudent = ($('input[name="student"]:checked').val());
            var newCourse = ($('input[name="course"]:checked').val());
        });
    </script>
    <?php
}
