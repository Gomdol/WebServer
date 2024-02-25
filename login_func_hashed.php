<?php
require_once 'db_func.php';

function login1($id, $pw) {
    global $db_conn; // 데이터베이스 연결 변수를 전역으로 사용

    // 사용자가 입력한 ID를 이용해 데이터베이스에서 비밀번호 해시 가져오기
    $check_query = "SELECT pass FROM accounts WHERE name = '$id'";
    $check_result = mysqli_query($db_conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $user_data = mysqli_fetch_assoc($check_result);
        $hashed_password = $user_data['pass'];

        // 사용자가 입력한 비밀번호와 데이터베이스의 해시된 비밀번호 비교
        if (password_verify($pw, $hashed_password)) {
            // 로그인 성공
            return $id; // 사용자 ID 반환
        }
    }

    return false;
}
?>
