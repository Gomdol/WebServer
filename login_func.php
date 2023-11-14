<?php
require_once 'db_func.php';

function login1($id, $pw){
    global $db_conn; // 데이터베이스 연결 변수를 전역으로 사용

    // 사용자가 입력한 ID와 비밀번호를 데이터베이스와 비교
    $check_query = "SELECT * FROM test_table WHERE name = '$id' AND pass = '$pw'";
    $check_result = mysqli_query($db_conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // 로그인 성공
        return mysqli_fetch_assoc($check_result)['name']; // 사용자 ID 반환
    } else {
        return false;
    }
}
?>
