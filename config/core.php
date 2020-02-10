<?php
// show error reporting
error_reporting(E_ALL);

// start session
session_start();

// default timezone
date_default_timezone_set("Asia/Manila");

// homepage URL
$home_url = "http://localhost/backend-exercises/php_login_register"; 

// page number
$page_number = isset($_GET['page']) ? $_GET["page"] : 1; 

// number of records
$records_per_page = 5;

// from which the page start
$page_start_num = ($page_number * $records_per_page) - $records_per_page;

// for messages
$action = isset($_GET['action']) ? $_GET['action'] : "";

