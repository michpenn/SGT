/**
 * Created by michpenn on 12/7/15.
 */


function click_handlers(){
    $('.button_add').click(function(){
        console.log('add button clicked');
    });
    $('.button_cancel').click(function(){
        console.log('cancel button clicked');
    });
    $('.button_data').click(function(){
        populate_from_DB();
    });
}


//must add student to page and data base MAKE OOP
function add_student(){}

//must delete student from page and database
function delete_student(){}

//must clear the form
function clear_form(){}

//calculate average
function calculate_average(){}

//must pull info from data base
function populate_from_DB(){
    $.ajax({
        url: 'getdata.php',
        dataType: 'html',
        type: 'post',
        success: function(output) {
            $('.table_body').html(output);
        }
    });
}

//must handle errors
function error_handing(){}

//handle local storage
function local_storage(){}

//identify min and max students
function highlight_students(){}

//sort students by name, course, and grade
function sort_students(){}

//student course auto complete
function course_autocomplete(){}


$(document).ready(function(){
    click_handlers();
});