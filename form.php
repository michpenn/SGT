<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $valid = true;
    $student['name'] = $_POST['studentName'];
    $student['course'] = $_POST['course'];
    $student['grade'] = $_POST['studentGrade'];
    if ($valid) {
                header('location: index.php');
                exit();
        };
}