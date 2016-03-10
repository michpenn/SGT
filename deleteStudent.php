<?php
require('sgt_connect.php');
$data = file_get_contents("php://input");
$postData = json_decode($data);
include_once('reusableFunctions.php');
$deleteStudent = objectToArray($postData);

//Step 1: Find the student in the name table and return its ID
function findStudent($name) {
    global $conn;
    $query = "SELECT `id` FROM `students` WHERE `name`='{$name}'";
    $result = $conn->query($query);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }
    else {
        //throw error here
    }
}

//Step 2: Find the course in the course table and return its ID
function findCourse($course) {
    global $conn;
    $query = "SELECT `id` FROM `courses` WHERE `course`='{$course}'";
    $result = $conn->query($query);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }
    else {
        //throw error here
    }
}

//Step 3: Find grade table entry
function findEntry($name, $course, $grade){
    global $conn;
    $studentID = findStudent($name);
    $courseID = findCourse($course);
    $query = "SELECT `id` FROM `grades` WHERE `student_id`={$studentID} AND `course_id`={$courseID} AND `grade` = {$grade}";
    $result = $conn->query($query);
    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }
}

//Step 4: delete it
function deleteEntry($entryID){
    global $conn;
    $query = "DELETE FROM `grades` WHERE `id`={$entryID}";
    $result = $conn->query($query);
    return var_export($result);


}
deleteEntry(findEntry($deleteStudent['student_name'], $deleteStudent['course_name'], $deleteStudent['grade']));
//Step 3: return that it has been deleted
//Step 4: Delete from DOM
//Step 5: Delete from Student Array