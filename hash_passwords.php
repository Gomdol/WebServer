<?php
require_once 'db_func.php'; // 데이터베이스 연결을 위한 파일 포함

function hashExistingPasswords() {
    global $db_conn;

    // 현재 평문으로 저장된 모든 비밀번호와 사용자 이름(name) 가져오기
    $query = "SELECT name, pass FROM test_table";
    $result = mysqli_query($db_conn, $query);

    if (!$result) {
        die("Error fetching passwords: " . mysqli_error($db_conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $plain_password = $row['pass'];
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // 해시된 비밀번호를 데이터베이스에 업데이트
        $update_query = "UPDATE test_table SET pass = '$hashed_password' WHERE name = '$name'";
        if (!mysqli_query($db_conn, $update_query)) {
            die("Error updating password for user $name: " . mysqli_error($db_conn));
        }
    }

    echo "All passwords have been successfully hashed and updated.";
}

hashExistingPasswords();
?>
