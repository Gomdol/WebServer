<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'pooh');
	define('DB_PASSWORD', 'pooh1234');
	define('DB_NAME', 'database');

	$db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($db_conn){
		echo "DB Connect OK";
	}else{
		echo "DB Connect Fail";
	}
?>
