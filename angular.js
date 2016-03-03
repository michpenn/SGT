/**
 * Created by michpenn on 2/25/16.
 */
var SGT = angular.module('SGT', []);
SGT.controller('appController', function (studentService, $http) {
    var self = this;
    self.studentArray = [];
    /*
     * Requirements:
     * 1. Should handle variables used by FormController & studentListController
     * 2. Handle Average Grade -check
     * 3. Handles Initial student loading from API - check
     * */
    self.studentArray = [];
    self.addStudent = function (student) {
        self.studentArray.push(student);
        console.log(self.studentArray);
    };
    self.calcAverage = function () {
        var average = 0;
        var sum = 0;
        if (self.studentArray.length > 1) {
            for (var i = 0; i < self.studentArray.length; i++) {
                sum += parseFloat(self.studentArray[i].grade);
            }
            average = sum / self.studentArray.length;
        }
        return average.toPrecision(3) + '%';
    };
    self.getData = function () {
        $http.get('getdata.php').then(function (response) {
            self.studentArray = response.data;
            self.calcAverage();
        });
    };


});

/*
 * The next 2 controllers are nested in the main controller, 'appController'
 * */

SGT.controller('formController', function (studentService) {
    var self = this;
    self.formControl = function () {
    };
    self.callAddStudent = function (student) {
        var studentAdded = studentService.addStudent(student);
        console.log('ID of new entry is: ',studentAdded);
        self.addToStudentArray();
    };
    self.handleError = function () {
        console.log('handle errors here');
    };
    self.addToStudentArray = function(){
        console.log(this);
    };
    /*
     * Requirements:
     * 1. Handle Inputs and validating inputs using angular filters
     * 2. Handle adding the new students to the student List array after a successful API request
     * 3. Handles Errors when request adds to the API
     * */
});
SGT.controller('studentListController', function (studentService) {
    var self = this;
    self.studentArray = [];
    self.loadData = false;
    self.callDeleteStudent = function () {
        studentService.deleteStudent();
    };
    /*
     * Requirements:
     * 1. Glues together the data from the App Controller into the table
     * 2. Handle Deleting of a student from the API
     *      2.1 Updates student list after successful call to APi
     *      2.2 Shows error when user can’t be deleted
     * */
});

/*
 * Below is the student service
 * */
SGT.service('studentService', function ($http) {
    var self = this;
    self.addStudent = function (student) {
        return $http.post('addStudent.php', student)
            .then(function (response) {
                console.log('response: ', response.data);
                return response.data;

            },function (response) {
                console.log('error response: ', response.status);
            });
    };
    self.deleteStudent = function () {
    };
    self.update = function () {
    };

    /*
     * Requirements:
     * 1. Build out a student service that would be injected into the 3 controllers
     * 2. All adding, deleting, updating should be done within the service
     *
     * */
});