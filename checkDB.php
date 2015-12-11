<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn =mysqli_connect("localhost:8889", "root", "root", "lfz_sgt");
    $student = $_POST;
    //$s_name = $student['name'];
    $query = "SELECT `id`, `creator_id`, `name` FROM `students` WHERE name = '{$student['name']}'" ;
    $rows = mysqli_query($conn, $query);
    if(mysqli_num_rows($rows)>0){
        while($row = mysqli_fetch_assoc($rows)) {
            ?>
            <div class="alert alert-warning fade in col-xs-5">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Do you mean <strong> <?=$student['name'];?> </strong> <br>
                with student ID: ________ that is<br>
                currently enrolled in: _____ ?
                <br>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary">Yes</button>
                    <button type="button" class="btn btn-secondary">No</button>
                </div>
            </div>
<?php
        }
    }
if(mysqli_num_rows($rows)==0){
    echo "the student does not exist";
}
}
?>


