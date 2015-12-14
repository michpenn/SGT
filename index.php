<?php
session_start();

/**
 * Created by PhpStorm.
 * User: michpenn
 * Date: 12/6/15
 * Time: 10:16 PM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Student Grade Table</title>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <script src="script2.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="page-header">
        <!-- only show this element when the user isnt on mobile -->
        <h1 class="hidden-xs hidden-sm">Student Grade Table
            <small class="col-md-offset-6 text-right">Grade Average : <span class="avgGrade"></span></small>
        </h1>
        <!-- only show this element when the user gets to a mobile version -->
        <h3 class="hidden-md hidden-lg">Student Grade Table
            <small class=" col-xs-offset-5 col-xs-6 text-right">Grade Average : <span class="avgGrade"></span></small>
        </h3>
    </div>
    <div class="student-add-form col-xs-12 col-md-push-9 col-md-3">
        <h4>Add Student</h4>
<!--action="form.php" method="post"-->
        <form>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
                <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student Name">
                <span class="error"></span>
            </div>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
                <input type="text" class="form-control" name="course" id="course" placeholder="Student Course">
                <span class="error"></span>
            </div>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-education"></span>
            </span>
                <input type="number" class="form-control" name="studentGrade" id="studentGrade"
                       placeholder="Student Grade">
                <span class="error"></span>
            </div>
            <button type="button" class="btn btn-success form-group button_add">Add</button>
            <button type="button" class="btn btn-default form-group button_cancel">Cancel</button>
            <button type="button" class="btn btn-info form-group button_data">Get Data</button>
        </form>
    </div>
    <div class="student-list-container col-xs-12 col-md-9 col-md-pull-3">
        <table class="student-list table">
            <thead>
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Student Course</th>
                <th>Student Grade</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody class="table_body">
            </tbody>
        </table>
    </div>
</div>
<div class="trial"></div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Additions!</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
</body>

</html>
