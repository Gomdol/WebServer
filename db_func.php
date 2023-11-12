<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'pooh');
	define('DB_PASSWORD', 'mr0da1!');
	define('DB_NAME', 'database');

	//DB 생성
	$db_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	//DB 정상 연결 여부 체크
	if (!$db_conn) {
		
		//연결되지 않았을 때, 즉시 중단시키고 에러 출력하기
		die("데이터베이스 연결 실패: " . mysqli_connect_error());
	}
?>