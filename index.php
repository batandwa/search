<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

require_once 'db_connect.php';

$vulnerable = true;
require_once $vulnerable ? 'vulnerable_functions.php' : 'safe_functions.php';
require_once 'functions.php';
$mode = isset($_GET['mode']) && !empty($_GET['mode']) ? $_GET['mode'] : 'search';
require_once "$mode.php";
