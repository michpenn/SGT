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
        console.log('data button clicked');
    });
}


$(document).ready(function(){
    click_handlers();
});