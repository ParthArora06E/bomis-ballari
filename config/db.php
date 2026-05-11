<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bomis_ballari_db');

function get_db_connection($include_db = true) {
    if ($include_db) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    } else {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    }
    
    if ($conn->connect_error) {
        // For debugging, we'll keep the error, but in production we'd log it
        return null;
    }
    return $conn;
}
?>
