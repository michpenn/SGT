/**
 * Created by michpenn on 12/7/15.
 */
var student;

function click_handlers() {
    $('.button_add').click(function () {
        console.log('add button clicked');
        check_form_inputs();
    });
    $('.button_cancel').click(function () {
        cancelClicked();
    });
    $('.button_data').click(function () {
        populate_from_DB();
    });
    $('#close_modal').click(function () {
        makeQueries();
    });

}


//must add student to page and data base MAKE OOP
function add_student() {
}

function check_form_inputs() {
    var student_name = $('#studentName').val();
    var student_course = $('#course').val();
    var student_grade = $('#studentGrade').val();
    student_grade = parseFloat(student_grade);
    var valid_studentName = true;
    var valid_studentCourse = true;
    var valid_studentGrade = true;

    //check name is valid
    if (student_name.length < 2) {
        console.log('please enter a name');
        valid_studentName = false;
    }
    if (typeof student_name != 'string') {
        console.log('please enter a real name');
        valid_studentName = false;
    }
    //check course is valid
    if (student_course.length < 2) {
        console.log('please enter a course');
        valid_studentCourse = false;
    }
    if (typeof student_course != 'string') {
        console.log('please enter a real course');
        valid_studentCourse = false;
    }
    //check grade is valid

    if (student_grade.length == 0) {
        console.log('please enter a grade');
        valid_studentGrade = false;
    }

    if ((student_grade > 100) || (student_grade < 0)) {
        console.log('please enter a real grade');
        valid_studentGrade = false;
    }

    //by setting the 'input type' to 'number' in the add student form, we don't need to worry about non numbers

    //if all inputs are valid, make student object
    if ((valid_studentName) && (valid_studentCourse) && (valid_studentGrade)) {
        //make inputs consistent with database inputs
        student_name = capitalizeFirstLetter(student_name);
        student_course = capitalizeFirstLetter(student_course);
        student_grade = parseFloat(student_grade);
        student = new make_student_object(student_name, student_course, student_grade);
        console.log(student);
        checkDB(student);
    }
}
//for formatting
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
//make student object
function make_student_object(name, course, grade) {
    var self = this;
    self.name = name;
    self.course = course;
    self.grade = grade;
    self.newstudent = null;
    self.newcourse = null;
}


function checkDB(object) {
    $.ajax({
        url: 'checkDB.php',
        data: {
            name: object.name,
            course: object.course,
            grade: object.grade
        },
        dataType: 'text',
        type: 'post',
        success: function (output) {
            $('.modal-body').html(output);
            $('#myModal').modal('show');
        },
        error: function (x, t, m) {
            console.log(m);
        }
    });
}


function makeQueries() {
    console.log('makeQueries is called');
    var modal_empty = $('.modal-body').children().length;
    if (modal_empty <= 1) {
        console.log('here goes the ajax call');
        $.ajax({
            url: 'DB_queries.php',
            data: {
                name: student.name,
                course: student.course,
                grade: student.grade,
                newstudent: student.newstudent,
                newcourse: student.newcourse
            },
            dataType: 'text',
            type: 'get',
            success: function(output) {
                console.log('ajax worked successful ', output)
            },
            error: function (x, t, m) {
                console.log(m);
            }
        });
}
else{
        console.log('user needs to edit inputs');
    }
}

function addThisStudent() {
    student.newstudent = true;
    console.log(student);
}

function studentExists() {
    student.newstudent = false;
    console.log(student);
}

function addThisCourse() {
    student.newcourse = true;
    console.log(student);
}

function courseExists() {
    student.newcourse = false;
    console.log(student);
}

//check if student exists. going to turn this into a prototype of a method of the student object
function check_student() {
}


//must delete student from page and database
function delete_student() {
}

//must clear the form
function cancelClicked() {
    $('input').val('');
}

//calculate average
function calculate_average() {
    var rows = $('.table_body').children();
    var thisrow;
    var thisgrade;
    var numberOfRows = rows.length;
    var sum_of_grades = 0;
    var average;

    if (rows.length > 0) {
        for (var i = 0; i < rows.length; i++) {
            thisrow = rows[i];
            thisgrade = thisrow.querySelector('.grade');
            thisgrade = $(thisgrade).text();
            thisgrade = parseFloat(thisgrade);
            sum_of_grades += thisgrade;
        }
        average = sum_of_grades / numberOfRows + '%';
        $('.avgGrade').text(average);
    }
}

//must pull info from data base
function populate_from_DB() {
    $.ajax({
        url: 'getdata.php',
        dataType: 'html',
        type: 'post',
        success: function (output) {
            $('.table_body').html(output);
        }
    });
}

//must handle errors
function error_handing() {
}

//handle local storage
function local_storage() {
}

//identify min and max students
function highlight_students() {
}

//sort students by name, course, and grade
function sort_students() {
}

//student course auto complete
function course_autocomplete() {
}

//check if there is anything in the table, if there is, then call other functions
function checkTable() {
    var tableRows = $('.table_body').children().length;
    if (tableRows > 0) {
        console.log('average can be calculated');
    }
}

$(document).ready(function () {
    click_handlers();
});