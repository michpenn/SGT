<?php
$conn =mysqli_connect("localhost:8889", "root", "root", "lfz_sgt");
$query = "SELECT s.name AS 'student name', s.id AS 'student id', c.course AS 'course name', i.name AS 'instructor name', g.grade FROM `grades` AS g JOIN `students` AS s on g.student_id = s.id JOIN `courses` AS c on g.course_id = c.id JOIN `instructors` AS i on g.instructor_id = i.id";
$rows = mysqli_query($conn, $query);
if(mysqli_num_rows($rows)>0){
    while($row = mysqli_fetch_assoc($rows)) {
        echo "<tr>";
        ?>
        <td><?=$row['student name']?></td>
        <td><?=$row['student id']?></td>
        <td><?=$row['course name']?></td>
        <td class="grade"><?=$row['grade']?></td>
        <td><button type="button" class="btn btn-danger">Delete</button></td>

<?php
        $output[] = $row;

        echo "</tr>";
    }
}
?>

