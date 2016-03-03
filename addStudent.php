<?php
require('sgt_connect.php');
$data = file_get_contents("php://input");
$postData = json_decode($data);
//query to see if student exists already, if it does, use same student id
//query to see if course exists already, if it does, use same course id
/**
 * @param $d
 * @return array
 */
function objectToArray($d)
{
    //check if input is an object
    if (is_object($d)) {
        //gets the properties of the object
        $d = get_object_vars($d);
    }
//check if input is an array, then return an object
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

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
    if($conn->query($query) === TRUE) {
    }
    else {
        echo 'error in adding student';
    };
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

    if(isset($studentID) && isset($courseID)){
        $query = "INSERT INTO `grades`(`id`, `student_id`, `course_id`, `grade`, `timestamp`) VALUES (null,{$studentID},{$courseID},{$student['grade']},NOW())";
        if($conn->query($query) === TRUE) {
            echo $conn->insert_id;
            return $conn->insert_id;

        }
        else {
            echo 'error in adding student';
        };
    }
}

;

addStudent();
