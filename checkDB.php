<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!$using_internally_as_html) {
        ob_start();
    }
    $student = $_POST;
    $student_found = null;
    $course_found = null;

    function checkForStudent()
    {
        require('sgt_connect.php');
        global $student;
        global $student_found;
        $query = "SELECT `id`, `creator_id`, `name` FROM `students` WHERE name = '{$student['name']}'";
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                ?>
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    This name already exists in our student database! <br>
                    Are you referring to current student: <strong> <?= $student['name']; ?> </strong>
                    with student ID: <strong><?= $row['id']; ?></strong>?
                    <br>


                    <button type="button" class="btn btn-primary col-xs-offset-1" data-dismiss="alert"
                            aria-label="close" onclick="studentExists()">Yes
                    </button>
                    <button type="button" class="btn btn btn-danger col-xs-offset-1" data-dismiss="alert"
                            aria-label="close"
                            onclick="addThisStudent()">No, add new student
                    </button>

                </div>
                <?php
                $student_found['id'] = $row['id'];
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


                <button type="button" class="btn btn-primary col-xs-offset-1" data-dismiss="alert" aria-label="close"
                        onclick="addThisStudent()">Yes
                </button>
                <button type="button" class="btn btn btn-danger col-xs-offset-1" data-dismiss="alert"
                        aria-label="close">No
                </button>

            </div>


            <?php
        }

        mysqli_close($conn);
    }


    checkForStudent();

    function checkForCourse()
    {
        require('sgt_connect.php');
        global $student;
        global $course_found;
        $query2 = "SELECT `id`, `course` FROM `courses` WHERE course = '{$student['course']}'";
        $rows2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($rows2) > 0) {
            while ($row = mysqli_fetch_assoc($rows2)) {
                $course_found['id'] = $row['id'];
                ?>
                <script type="text/javascript">
                    courseExists();
                </script>
                <?php
            }
        }
        if (mysqli_num_rows($rows2) == 0) {
            ?>
            <div class="alert alert-warning">
                The course: <strong><?= $student['course']; ?></strong> does not exist. Would you like to add this
                course? <br>
                <button type="button" class="btn btn-primary col-xs-offset-1" data-dismiss="alert" aria-label="close"
                        onclick="addThisCourse()">Yes
                </button>
                <button type="button" class="btn btn btn-danger col-xs-offset-1" data-dismiss="alert"
                        aria-label="close">No
                </button>
            </div>

            <?php
        }
        mysqli_close($conn);
    }

    checkForCourse();
if(!$using_internally_as_html) {
    $html = ob_get_contents();
    ob_end_clean();
    $output_array = ['success' => true, 'html' => $html,'number_of_messages'=>$messages];
    print(json_encode($output_array));
}

}

?>
