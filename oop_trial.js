/**
 * Created by michpenn on 1/9/16.
 */
var User = function(name, course, adminRights) {
  var that = {};
    that.name = name || '';
    that.course = course;
    that.adminRights = adminRights;
    return that;
};

var Student = function(name, course, grade) {
    var that = User(name, course, false);
    that.grade = grade;
    return that;

};

//var Michal = new Student('Michal', 'HTML', 100);
//console.log(Michal.name, Michal.course, Michal.grade);

var Teacher =function(name, course) {
    var that = User(name, course, true);
    return that;
};
//console.log(Teacher('dan', 'Algebra'));

//PROTOTYPAL PATTERN EXAMPLE

var User2 = function(name, course, adminRights) {
    this.name = name;
    this.course= course;
    this.adminRights = adminRights;
    this.loggedOn = false;
};

User2.prototype.login = function(){
    this.loggedOn = true;
};

function Student2(name, course, grade){
    User2.call(this, name, course, false);
    this.grade = grade;
}
Student2.prototype = Object.create(User2.prototype);
Student2.prototype.constructor = Student2;

//var Michal = new Student2('michal', 'math', 100);
//console.log(Michal);

function Teacher2(name, course){
    User2.call(this, name, course, true);
}
Teacher2.prototype = Object.create(User2.prototype);
Teacher2.prototype.constructor = Teacher2;

//var Andrew =new Teacher2('andrew', 'OOP');
//console.log(Andrew);

//CALCULATOR EXAMPLE

var Operator = function(hasPrecedence){
    var that = {};
    that.hasPrecedence = hasPrecedence;
    return that;
};

var Addition = function(){
    var that = Operator(false);
    that.add = function(num1, num2){
        return num1 + num2;
    };
    return that;
};

var sum = new Addition();
console.log(sum.add(5,10));

//CALCULATOR 2

var Operator2 = function(hasPrecendence){
    this.hasPrecendence = hasPrecendence;
};

function Addition(){
    Operator2.call(this, false);
    this.add = function(num1, num2) {
        return num1 + num2;
    };
}




