/**
 * Created by michpenn on 12/7/15.
 */


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
}


//must add student to page and data base MAKE OOP
function add_student(){}

function check_form_inputs(){
    var student_name = $('#studentName').val();
    var student_course = $('#course').val();
    var student_grade = $('#studentGrade').val();
    //check name is valid
    if(student_name.length > 0) {
        console.log('please enter a name');
    }
    //check course is valid
    if(student_course.length > 0) {
        console.log('please enter a course');
    }
    //check grade is valid
    if(student_grade.length > 0) {
        console.log('please enter a grade');
    }

    //console.log(student_name, student_course, student_grade)
}

function make_student_object(name, course, grade) {
    var self = this;
    self.name = name,
        self.course = course,
        self.grade = grade
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