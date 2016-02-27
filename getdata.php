<?php
require('sgt_connect.php');
$json_output = array();
$query = "SELECT s.name AS 'student_name', c.course AS 'course_name', g.grade FROM `grades` AS g JOIN `students` AS s on g.student_id = s.id JOIN `courses` AS c on g.course_id = c.id";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)) {
        $json_output[] = $row;
    }
    echo json_encode($json_output);
}
?>

