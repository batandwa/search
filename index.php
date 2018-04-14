<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
$mode = isset($_GET['mode']) && !empty($_GET['mode']) ? $_GET['mode'] : 'search';
require_once "$mode.php";
