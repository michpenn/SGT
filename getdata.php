<?php
$conn =mysqli_connect("localhost:8889", "root", "root", "lfz_sgt");
$query = "SELECT s.name AS 'student name', c.course AS 'course name', i.name AS 'instructor name', g.grade FROM `grades` AS g JOIN `students` AS s on g.student_id = s.id JOIN `courses` AS c on g.course_id = c.id JOIN `instructors` AS i on g.instructor_id = i.id";
$rows = mysqli_query($conn, $query);
if(mysqli_num_rows($rows)>0){
    echo "<table style='width:80%'>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Course Name</th>";
    echo "<th>Instructor Name</th>";
    echo "<th>Grade</th>";
    echo "</tr>";
    while($row = mysqli_fetch_assoc($rows)) {
        echo "<tr>";
        ?>
        <td><?=$row['student name']?></td>
        <td><?=$row['course name']?></td>
        <td><?=$row['instructor name']?></td>
        <td><?=$row['grade']?></td>

<?php
        $output[] = $row;

        echo "</tr>";
    }
    echo "</table>";
   echo "<pre>";
    print_r($output);
    echo "</pre>";
}
?>

<!--
<table style="width:100%">
    <tr>
        <th></th>
    </tr>

    <tr>
        <td></td>
    </tr>
  </table>


-->
