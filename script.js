/**
 * Define all global variables here
 */
var student_name = '';
var student_course = '';
var student_grade = '';

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
var student = new object{};
student.name = '';
student.course = '';
student.grade = '';  */
/**
 * addClicked - Event Handler when user clicks the add button
 */
function addClicked() {
    console.log("this works");
    student_name = document.getElementById("studentName").value;
    student_course = document.getElementById("course").value;
    student_grade = document.getElementById("studentGrade").value;

    console.log(student_name, student_course, student_grade);

    var student = new addStudent(student_name, student_course, student_grade);
    student_array.push(student);
    console.log(student_array);
    addStudentToDom();
    cancelClicked();
};


/**
 * cancelClicked - Event Handler when user clicks the cancel button, should clear out student form
 */
function cancelClicked() {
    console.log('click works');
    document.getElementById("studentName").value='';
    document.getElementById("course").value= '';
    document.getElementById("studentGrade").value = '';

};
/**
 * addStudent - creates a student objects based on input fields in the form and adds the object to global student array
 *
 * @return undefined
 */
function addStudent(name, course, grade) {
    this.studentName = name;
    this.course = course;
    this.studentGrade = grade;
};
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
    var button = $('<button>').addClass("btn btn-danger").attr('onclick', 'console.log("delete works")').text('Delete');
    $(trow).append(name).append(course).append(grade).append(button);
    $('tbody').append(trow);
}
/**
 * reset - resets the application to initial state. Global variables reset, DOM get reset to initial load state
 */


/**
 * Listen for the document to load and reset the data to the initial state
 */