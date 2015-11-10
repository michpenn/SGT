/**
 * Define all global variables here
 */
var student_name = '';
var student_course = '';
var student_grade = null;
var average = null;
var student;
var apiKey = 'dTR302IM4u';
/**
 * student_array - global array to hold student objects
 * @type {Array}
 */
var student_array = [];

/**
 * inputIds - id's of the elements that are used to add students
 * @type {string[]}
 */
/*
 make variables storing the IDs here
 */
var find_student_name = $('#studentName');
var find_student_course = $('#course');
var find_student_grade = $('#studentGrade');
//var find_form_inputs = $('.form-control:input');
/**
 * addClicked - Event Handler when user clicks the add button
 */
function addClicked() {
    student_name = document.getElementById("studentName").value;
    student_course = document.getElementById("course").value;
    student_grade = document.getElementById("studentGrade").value;
    student = addStudent(student_name, student_course, student_grade);
    addStudentToDB(apiKey, student);
    student_array.push(student);
    console.log(student);
    addStudentToDom(student);
    updateData();
    clearAddStudentForm();
    cancelClicked();
}

/**
 * cancelClicked - Event Handler when user clicks the cancel button, should clear out student form
 */
function cancelClicked() {
    $('input').val('');
}

/**
 * addStudent - creates a student objects based on input fields in the form and adds the object to global student array
 *
 * @return undefined
 */
function addStudent(name, course, grade) {
    var output_student = {};
    output_student.student_name = name;
    output_student.course = course;
    output_student.student_grade = grade;
    output_student.delete = function () {
        student_array.splice(student_array.indexOf(this), 1);
    };
    return output_student;
}

function addStudentToDB(api_key, student) {
    $.ajax({
        dataType: 'json',
        data: {
            "api_key": api_key,
            "name": student.student_name,
            "course": student.course,
            "grade": student.student_grade,
        }
        ,
        method: 'post',
        url: 'http://s-apis.learningfuze.com/sgt/create',
        success: function (response) {
            student['id'] = response['new_id'];
        }


    });
}


/**
 * clearAddStudentForm - clears out the form values based on inputIds variable
 */
function clearAddStudentForm() {
    find_student_name.val('');
    find_student_course.val('');
    find_student_grade.val(null);
    //updateData();
    //need help with this
    cancelClicked();
}

/**
 * calculateAverage - loop through the global student array and calculate average grade and return that value
 * @returns {number}
 */
function calculateAverage(student_array) {
    average = 0;
    var total_grades = 0;
    for (var i = 0; i < student_array.length; i++) {
        total_grades += parseInt(student_array[i].student_grade);
        average = Math.round(((total_grades) / (i + 1)));
    }
    $('.avgGrade').text(average);
    //to avoid NaN maybe add an if statement here.
    //once object is deleted from array this will work.
}

/**
 * updateData - centralized function to update the average and call student list update
 */
function updateData() {
    calculateAverage(student_array);
    //updateStudentList will eventually go here too
}

/**
 * updateStudentList - loops through global student array and appends each objects data into the student-list-container > list-body
 */
//this one confuses me
//I think it just means this is where we append the data from the array to the body > table.
function updateStudentList() {
    var trow = $('<tr>');
    var name = $('<td>').text(student_name);
    var course = $('<td>').text(student_course);
    var grade = $('<td>').text(student_grade);
    trow.append(name).append(course).append(grade);
    console.log(student_array);
}

/**
 * addStudentToDom - take in a student object, create html elements from the values and then append the elements
 * into the .student_list tbody
 * @param studentObj
 */
function addStudentToDom(student) {
    var trow = $('<tr>');
    var name = $('<td>').text(student.student_name);
    var course = $('<td>').text(student.course);
    var grade = $('<td>').text(student.student_grade);
    var button = $('<button>').addClass("btn btn-danger").on('click', function () {
        student.delete(); //this.delete maybe. -> NO!
        //clearAddStudentForm();
        deleteFromDB(apiKey, student.id);
        updateData();
        $(this).parent().remove();
    }).text('Delete');
    //.on('click',clearAddStudentForm)
    $(trow).append(name).append(course).append(grade).append(button);
    $('tbody').append(trow);
}

function deleteFromDB (api_key, student_id){
    $.ajax({
        dataType: 'json',
        data: {"api_key": api_key, "student_id": student_id},
        method: 'post',
        url: 'http://s-apis.learningfuze.com/sgt/delete',
        success: function(response) {
            console.log('you successfully deleted the student');
        }
        error: function(error) {
            console.log(error);
            alert("You were not able to delete student number "+ student_id+ " for the following reasons: "+ error);
        }
    }
}

/**
 * reset - resets the application to initial state. Global variables reset, DOM get reset to initial load state
 */
function reset() {
    student_array = [];
    student = {};
    student_name = '';
    student_course = '';
    student_grade = null;
    average = null;
}

/**
 * Listen for the document to load and reset the data to the initial state
 */
$(document).ready(function () {
    $body = $("body");


    populateTable('dTR302IM4u');

    clearAddStudentForm();
    reset();
});


function populateTable(api_key) {
    $.ajax({
        dataType: 'json',
        data: {"api_key": api_key},
        method: 'post',
        url: 'http://s-apis.learningfuze.com/sgt/get',
        success: function (response) {
            if (response.success) {
                console.log(response);
                var theNewObject = response;
                var theNewObjectArray = theNewObject.data;
                for (var i = 0; i < theNewObjectArray.length; i++) {
                    var theName = theNewObjectArray[i].name;
                    var theCourse = theNewObjectArray[i].course;
                    var theGrade = parseFloat(theNewObjectArray[i].grade);
                    student = addStudent(theName, theCourse, theGrade);
                    student_array.push(student);
                    addStudentToDom(student);
                    updateData();
                }
            }
            else {
                console.log('you request was denied');
            }
        }
    });
}


