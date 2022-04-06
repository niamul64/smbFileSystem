<?php
// ReflectionReference: https://www.youtube.com/watch?v=smodcyNIwAo
// https://www.youtube.com/watch?v=1O4mbgl3-sY&t=368s


// // error log coddded 1:

// ini_set("log_errors", 1); // Enable error logging
// ini_set("error_log", "/error.txt"); // set error path
// error_log( "Hello, errors!" ); // log a test error
// it works

//
// error log code 2
ini_set('display_errors', 1);
ini_set('log_errors',1);
ini_set('error_log', dirname(__FILE__).'ErrorLog.txt');
error_reporting(E_ALL);

require 'joe.com';
?>