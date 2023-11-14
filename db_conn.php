<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'pooh');
    define('DB_PASSWORD', 'mr0da1!');
    define('DB_NAME', 'database');

    $db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>