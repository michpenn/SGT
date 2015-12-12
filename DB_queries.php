<?php
global $studentNew;
global $courseNew;
global $studentData;
global $courseData;
global $instructorData;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $student_object = $_GET;
    require('sgt_connect.php');
    if ($student_object['newstudent'] == 'true') {
        $studentNew = true;
        $query = "INSERT INTO students(`id`, `creator_id`, `name`) VALUES (null,1,'{$student_object['name']}')";
        mysqli_query($conn, $query);
        $studentData['id'] = mysqli_insert_id($conn);

    };
    if ($student_object['newstudent'] == 'false') {
        $studentNew = false;
        $query = "SELECT `id`, `creator_id`, `name` FROM `students` WHERE name = '{$student_object['name']}'";
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                $studentData['id'] = $row['id'];
                $studentData['creator_id'] = $row['creator_id'];

            }
        }
    };
    if ($student_object['newcourse'] == 'true') {
        $courseNew = true;
        $query = "INSERT INTO courses(`id`, `course`) VALUES (null,'{$student_object['course']}')";
        mysqli_query($conn, $query);
        $courseData['id'] = mysqli_insert_id($conn);
        $instructorData['instructor_id'] = rand(1, 2);
    };

    if ($student_object['newcourse'] == 'false') {
        $courseNew = false;
        $query = "SELECT `course`, `id` FROM `courses` WHERE course = '{$student_object['course']}'";
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                $query2 = "SELECT DISTINCT `instructor_id` FROM `grades` WHERE course_id = {$row['id']}";
                $courseData['course'] = $row['course'];
                $courseData['id'] = $row['id'];
                $rows2 = mysqli_query($conn, $query2);
                if (mysqli_num_rows($rows2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($rows2)) {
                        $instructorData = $row2;
                    }
                }

            }
        }

    };

    if (isset($studentNew) && isset($courseNew)) {
        if (($studentNew) && ($courseNew)) {
            $query = "INSERT INTO `grades`(`id`, `student_id`, `course_id`, `instructor_id`, `grade`, `timestamp`)
            VALUES (null,{$studentData['id']},{$courseData['id']},{$instructorData['instructor_id']},{$student_object['grade']},NOW())";
            mysqli_query($conn, $query);

        } else {
            echo 'You need to fix your form';
        }

    }
}