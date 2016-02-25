/**
 * Created by michpenn on 2/25/16.
 */
var SGT = angular.module('SGT',[]);
SGT.controller('appController',function(studentService){
    var self = this;
    /*
    * Requirements:
    * 1. Should handle variables used by FormController & studentListController
    * 2. Handle Average Grade
    * 3. Handles Initial student loading from API
    * */
    self.studentArray = [];
    self.addStudent = function(student){
        self.studentArray.push(student);
        console.log(self.studentArray);
    };
    self.calcAverage = function(){};

});

/*
* The next 2 controllers are nested in the main controller, 'appController'
* */

SGT.controller('formController',function(studentService){
    var self = this;
    self.formControl = function(){};
    self.callAddStudent = function(student){
        studentService.addStudent(student);
    };
    self.handleError = function(){};
    /*
     * Requirements:
     * 1. Handle Inputs and validating inputs using angular filters
     * 2. Handle adding the new students to the student List array after a successful API request
     * 3. Handles Errors when request adds to the API
     * */
});
SGT.controller('studentListController', function(studentService){
    var self = this;
    self.studentArray = [];
    self.loadData = false;
    self.callDeleteStudent = function(){
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
SGT.service('studentService', function($http){
    var self = this;
    self.addStudent = function(student){
        $http({
            url: '',
            method: '',
            cache: false
        })
            .then(
            function(response){},
            function(response){}
        )
    };
    self.deleteStudent = function(){};
    self.update = function(){};
    self.loadData = function(){};
    /*
    * Requirements:
    * 1. Build out a student service that would be injected into the 3 controllers
    * 2. All adding, deleting, updating should be done within the service
    *
    * */
});