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

function checkForStudent($name)
{
    global $conn;
    $query = "SELECT `id`,`name` FROM `students` WHERE name = '{$name}'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            var_dump($row);
            return $row;
        }
    } else {
        return false;
    }
}

;

function checkForCourse($course)
{
    global $conn;
    $query = "SELECT `id`,`course` FROM `courses`	 WHERE course = '{$course}'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            var_dump($row);
            return $row;
        }
    } else {
        return false;
    }
};

function addStudent()
{
    global $postData;
    $student = objectToArray($postData);
    $studentExists = checkForStudent($student['name']);
    $courseExists = checkForCourse($student['course']);
    if(!$studentExists && !$courseExists){
        $query = "INSERT INTO ``";
    }
};

addStudent();
