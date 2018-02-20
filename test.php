<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'classes/Config.class.php';
require_once 'classes/DB.class.php';

$instance = \DBApp\DB::getInstance();
$conn = $instance->getConnection();
