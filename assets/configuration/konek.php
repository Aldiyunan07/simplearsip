<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'arsipsimple');

// Create connection
$konek = new mysqli(HOST, USERNAME, PASSWORD, DB_NAME);

// Check connection
if ($konek->connect_error) {
    die("Connection failed: " . $konek->connect_error);
}
?>
