/**
 * Define all global variables here
 */
var student_name ='';
var student_course = '';
var student_grade ='';
var student;
/**
 * student_array - global array to hold student objects
 * @type {Array}
 */
var student_array =[];
/**
 * inputIds - id's of the elements that are used to add students
 * @type {string[]}
 */
$('#studentName').val();
$('#course').val();
$('#studentGrade').val();
/**
 * addClicked - Event Handler when user clicks the add button
 */
function addClicked() {
    student_name = $('#studentName').val();
    course = $('#course').val();
    student_grade = $('#studentGrade').val();

    student = addStudent(student_name, course, student_grade);
    student_array.push(student);
    console.log(student_array);
    addStudentToDom();
}
/**
 * cancelClicked - Event Handler when user clicks the cancel button, should clear out student form
 */

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
    };
    console.log(student);
    return output_student;
}
/*
    for (i=0; i <= student_array.length; i++) {
        student_array[i].student_name = name;
        student_array[i].course = course;
        student_array[i].student_grade = grade;
    }
    console.log(student_array);
}*/
/**
 * clearAddStudentForm - clears out the form values based on inputIds variable
 */

/**
 * calculateAverage - loop through the global student array and calculate average grade and return that value
 * @returns {number}
 */

/**
 * updateData - centralized function to update the average and call student list update
 */
/**
 * updateStudentList - loops through global student array and appends each objects data into the student-list-container > list-body
 */

/**
 * addStudentToDom - take in a student object, create html elements from the values and then append the elements
 * into the .student_list tbody
 * @param studentObj
 */
function addStudentToDom() {
    var trow = $('<tr>');
    var name = $('<td>').text(student_name);
    var course = $('<td>').text(student_course);
    var grade = $('<td>').text(student_grade);
    var button = $('<button>').addClass("btn btn-danger").on('click',student.delete).text('Delete');
    $(trow).append(name).append(course).append(grade).append(button);
    $('tbody').append(trow);
}
/**
 * reset - resets the application to initial state. Global variables reset, DOM get reset to initial load state
 */


/**
 * Listen for the document to load and reset the data to the initial state
 */