/**
 * Created by michpenn on 2/25/16.
 */
var SGT = angular.module('SGT',[]);
SGT.controller('appController',function(){
    var self = this;
    self.studentArray = [];
    self.addStudent = function(student){
        self.studentArray.push(student);
        console.log(self.studentArray);
    };
});
/*
* nest controllers in the main controller
*
* */