<?php
require_once 'db_func.php';

function checkUserId($id) {
    global $db_conn;

    // 사용자가 입력한 ID의 존재 여부를 확인
    $query = "SELECT * FROM test_table WHERE name = '$id'";
    $result = mysqli_query($db_conn, $query);
    return mysqli_num_rows($result) > 0;
}

function checkUserPassword($id, $pw) {
    global $db_conn;

    // 사용자가 입력한 ID에 해당하는 비밀번호 해시 가져오기
    $query = "SELECT pass FROM test_table WHERE name = '$id'";
    $result = mysqli_query($db_conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $hashed_password = $user_data['pass'];

        // 사용자가 입력한 비밀번호와 데이터베이스의 해시된 비밀번호 비교
        return password_verify($pw, $hashed_password);
    }

    return false;
}

function login1($id, $pw) {
    // 먼저 아이디 존재 여부 확인
    if (!checkUserId($id)) {
        return false;
    }

    // 아이디가 존재하면 비밀번호 일치 여부 확인
    if (checkUserPassword($id, $pw)) {
        return $id; // 로그인 성공, 사용자 ID 반환
    } else {
        return false;
    }
}
?>
