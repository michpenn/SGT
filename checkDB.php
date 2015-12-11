<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = $_POST;
    $student_found = null;
    $course_found = null;
    $studentExists = null;
    $courseExists = null;

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
                global $courseExists;
                $courseExists = true;
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
    }

    checkForCourse();
}

?>

<script type="text/javascript">
    function addThisStudent() {
        <?php
        $studentExists= false;
        ?>

    }
    function studentExists() {
        <?php
        $studentExists= true;
        ?>

    }
    function addThisCourse() {
        <?php
        $courseExists = false;
      ?>
    }


    $('#close_modal').click(function () {
        var modal_empty = $('.modal-body').children().length;
        if (modal_empty <= 1) {

            <?php
            //require('sgt_connect.php')
            //$instructor_id_query = "SELECT DISTINCT `instructor_id` FROM `grades` WHERE `course_id` = '{$course_found['id']}'";
            //$rows = mysqli_query($conn, $instructor_id_query);


            if(($studentExists)){
            ?>
            $('.trial').text("HELLO");
            <?php
            };

            if((!$studentExists)){
            ?>
            $('.trial').text("byeeee");
            <?php
            };
//            if(($studentExists) &&($courseExists)){
//                }
//                //var_dump($instructor_id);
//
//                //$query = "INSERT INTO `grades`(`id`, `student_id`, `course_id`, `instructor_id`, `grade`, `timestamp`) VALUES (null,'{}','{}',[value-4],'{$student['grade']}',NOW()";
//
//            }
//            elseif (($studentExists) &&(!$courseExists)){}
//            elseif ((!$studentExists) &&($courseExists)){}
//            elseif ((!$studentExists) &&(!$courseExists)){}




            ?>
        }
    })
</script>
