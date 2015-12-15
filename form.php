<?php
if ($_POST) {
    $valid = true;
    $student = $_POST;
    $nameErr = $courseErr = $gradeErr = "";
    $name = $course = $grade = "";

    //sanitizes the data
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($student['name'])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($student['name']);
        if (!preg_match("/^([A-Z][a-z]*([\\s][A-Z][\\.])?)$/", $name)) {
            $nameErr = 'The name does not match the name format. Please edit and resubmit';
            $name = '';
            $valid = false;
        }
    }
    if (empty($student['course'])) {
        $courseErr = 'Course is required';
    } else {
        $course = test_input($student['course']);
        if (!preg_match("/^([A-Z][A-Za-z0-9\-]*([ ]{0,1}[A-Z][A-Za-z0-9]*)?)$/", $course)) {
            $courseErr = 'The course name does not match the format. Please edit and resubmit';
            $course = '';
            $valid = false;
        }
    }
    if (empty($student['grade'])) {
        $gradeErr = 'Grade is required';

    } else {
        $grade = test_input($student['grade']);
        if (!preg_match("^(100$|0$|[1-9][0-9]{0,1}$)^", $grade)) {
            $gradeErr = 'Please enter a numeric grade';
            $grade = '';
            $valid = false;
        }
    }


    if ($valid) {
        $student = array('name' => $name,
            'course' => $course,
            'grade' => $grade,
            'new student' => null,
            'new course' => null,
            'student id' => null,
            'course id' => null);
        include 'trial.php';
        return $student;
    };
}