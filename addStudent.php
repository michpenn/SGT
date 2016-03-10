<?php
require('sgt_connect.php');
$data = file_get_contents("php://input");
$postData = json_decode($data);
include('reusableFunctions.php');
//query to see if student exists already, if it does, use same student id
//query to see if course exists already, if it does, use same course id


/**
 * @param $name
 * @return bool
 */
function checkForStudent($name)
{
    global $conn;
    $query = "SELECT `id`,`name` FROM `students` WHERE name = '{$name}'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    } else {
        return false;
    }
}

;
/**
 * @param $course
 * @return bool
 */
function checkForCourse($course)
{
    global $conn;
    $query = "SELECT `id`,`course` FROM `courses`	 WHERE course = '{$course}'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    } else {
        return false;
    }
}

;
/**
 * @param $name
 * @return mixed
 */
function addNewStudent($name)
{
    global $conn;
    $query = "INSERT INTO students(`id`, `creator_id`, `name`) VALUES (null,1,'{$name}')";
    $result = $conn->query($query);
    return $conn->insert_id;
}

/**
 * @param $course
 * @return mixed
 */
function addNewCourse($course)
{

    global $conn;
    $query = "INSERT INTO courses(`id`, `course`) VALUES (null,'{$course}')";
    $result = $conn->query($query);
    return $conn->insert_id;
}


function addToGradeTable($nameID, $courseID, $grade)
{
    global $conn;
    $query = "INSERT INTO `grades`(`id`, `student_id`, `course_id`, `grade`, `timestamp`) VALUES (null,{$nameID},{$courseID},{$grade},NOW())";
    if ($conn->query($query) === TRUE) {
    } else {
        echo 'error in adding student';
    };
}

function getLastEntry($id)
{
    global $conn;
    $json_output = array();
    $query = "SELECT s.name AS 'student_name', c.course AS 'course_name', g.grade FROM `grades` AS g JOIN `students` AS s on g.student_id = s.id JOIN `courses` AS c on g.course_id = c.id WHERE g.id = {$id}";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)) {
            $json_output[] = $row;
        }
        return json_encode($json_output);
    }
}
/**
 *
 */
function addStudent()
{
    global $conn;
    global $postData;
    $student = objectToArray($postData);
    $studentExists = checkForStudent($student['name']);
    $courseExists = checkForCourse($student['course']);
    if (!$studentExists && !$courseExists) {
        $studentID = addNewStudent($student['name']);
        $courseID = addNewCourse($student['course']);
    } else if (!$studentExists && $courseExists) {
        $studentID = addNewStudent($student['name']);
        $courseID = $courseExists;
    } else if (!$courseExists && $studentExists) {
        $studentID = $studentExists;
        $courseID = addNewCourse($student['course']);
    } else {
        $studentID = $studentExists;
        $courseID = $courseExists;
    }

    if (isset($studentID) && isset($courseID)) {
        $query = "INSERT INTO `grades`(`id`, `student_id`, `course_id`, `grade`, `timestamp`) VALUES (null,{$studentID},{$courseID},{$student['grade']},NOW())";
        if ($conn->query($query) === TRUE) {
            echo $conn->insert_id;
            getLastEntry($conn->insert_id);

        } else {
            echo 'error in adding student';
        };
    }
}

;


addStudent();
