<?php
session_start();
/**
 * Created by PhpStorm.
 * User: michpenn
 * Date: 2/25/16
 * Time: 2:23 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Student Grade Table</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <!--ANGULAR cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <!--personal JS -->
    <script src="angular.js"></script>
</head>
<body ng-app="SGT" ng-controller="appController as ac">
<div class="container-fluid">
    <!-- Page header, changes based on mobile or not mobile-->
    <div class="page-header">
        <!-- only show this element when the isnt on mobile -->
        <h1 class="hidden-xs hidden-sm">Student Grade Table
            <small class="col-md-offset-6 text-right">Grade Average : <span class="avgGrade" ng-bind="ac.calcAverage()"></span></small>
        </h1>
        <!-- only show this element when the user gets to a mobile version -->
        <h3 class="hidden-md hidden-lg">Student Grade Table
            <small class=" col-xs-offset-6 col-xs-6 text-right">Grade Average : <span class="avgGrade"></span></small>
        </h3>
    </div>
    <!-- Form to add students-->
    <div class="student-add-form col-xs-12 col-md-push-9 col-md-3" ng-controller="formController as fc">
        <h4>Add Student</h4>

        <form>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
                <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student Name" ng-model="fc.student.name">
                <span class="error"></span>
            </div>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
                <input type="text" class="form-control" name="course" id="course" placeholder="Student Course" ng-model="fc.student.course">
                <span class="error"></span>
            </div>
            <div class="input-group form-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-education"></span>
            </span>
                <input type="number" class="form-control" name="studentGrade" id="studentGrade"
                       placeholder="Student Grade" ng-model="fc.student.grade">
                <span class="error"></span>
            </div>
            <button type="button" class="btn btn-success form-group button_add" ng-click="fc.callAddStudent(fc.student)">Add</button>
            <button type="button" class="btn btn-default form-group button_cancel">Cancel</button>
            <button type="button" class="btn btn-info form-group button_data" ng-click="ac.getData()">Get Data</button>
        </form>

    </div>
    <!-- Table to display SGT -->
    <div class="student-list-container col-xs-12 col-md-9 col-md-pull-3" ng-controller="studentListController as slc">
        <table class="student-list table">
            <thead>
            <tr>
                <th>Student Name</th>
                <th>Student Course</th>
                <th>Student Grade</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="student in ac.studentArray">
                <td>{{student.student_name}}</td>
                <td>{{student.course_name}}</td>
                <td>{{student.grade}}</td>
                <td><button>Delete</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
