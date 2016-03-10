<?php
/**
 * Created by PhpStorm.
 * User: michpenn
 * Date: 3/10/16
 * Time: 9:19 AM
 */
function objectToArray($d)
{
    //check if input is an object
    if (is_object($d)) {
        //gets the properties of the object
        $d = get_object_vars($d);
    }
//check if input is an array, then return an object
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}