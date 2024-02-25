<?php
session_start();
require_once 'db_func.php';

if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // 두 비밀번호가 일치하는지 확인
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $user_id = $_SESSION['id'];

        $update_query = "UPDATE accounts SET pass = '$hashed_password' WHERE name = '$user_id'";
        // $update_query = "UPDATE accounts SET pass = '$hashed_password' WHERE email = '".$_SESSION['reset_email']."'";

        mysqli_query($db_conn, $update_query);

        // 비밀번호 변경 성공 메시지를 세션에 저장
        $_SESSION['password_change_success'] = "비밀번호가 성공적으로 변경되었습니다.";

        header("Location: main.php?page=mypage");
        exit;
    } else {
        // 비밀번호가 일치하지 않을 경우
        header("Location: change_password.php?error=1");
        exit;
    }
}
?>

