<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$mysqli = new mysqli("db", "root", "safehack", "safehack");
if ($mysqli->connect_errno) {
    die("Application offline.");
}

$vulnerable = true;
require_once $vulnerable ? 'vulnerable_functions.php' : 'safe_functions.php';
$mode = isset($_GET['mode']) && !empty($_GET['mode']) ? $_GET['mode'] : 'search';
require_once "$mode.php";
