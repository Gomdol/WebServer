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

    // 사용자가 입력한 ID와 비밀번호가 일치하는지 확인
    $query = "SELECT * FROM test_table WHERE name = '$id' AND pass = '$pw'";
    $result = mysqli_query($db_conn, $query);
    return mysqli_num_rows($result) > 0;
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
