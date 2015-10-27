/**
 * Define all global variables here
 */
var student_name = '';
var student_course = '';
var student_grade = null;
var average = null;
var student;

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
    console.log("this works");
    student_name = document.getElementById("studentName").value;
    student_course = document.getElementById("course").value;
    student_grade = document.getElementById("studentGrade").value;
    //student = new addStudent(student_name, student_course, student_grade);
    student = addStudent(student_name, student_course, student_grade);
    student_array.push(student);
    console.log(student_array, student);
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

/**
 * clearAddStudentForm - clears out the form values based on inputIds variable
 */

function clearAddStudentForm() {
    console.log('clearAddStudentForm');
    find_student_name.val('');
    find_student_course.val('');
    find_student_grade.val(null);
    console.log('all cleared');
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
    console.log("average = ", average);
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
        updateData();
        $(this).parent().remove();
    }).text('Delete');
    $(trow).append(name).append(course).append(grade).append(button);
    $('tbody').append(trow);
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
    clearAddStudentForm();
    reset();
});