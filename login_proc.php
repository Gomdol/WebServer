<?php
session_start();

require_once 'db_func.php'; // 데이터베이스 연결 파일
require_once 'login_func_hashed.php'; // 로그인함수 연결 파일

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 입력 받은 id와 pw
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    // SQL 인젝션 방지를 위한 검증 및 이스케이프 처리
    $id = mysqli_real_escape_string($db_conn, $id);
    $pw = mysqli_real_escape_string($db_conn, $pw);

    $user_id = login1($id, $pw);
    if ($user_id) {
        $_SESSION['id'] = $user_id;
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?message=아이디 또는 비밀번호가 잘못되었습니다.");
        exit();
    }

} else {
    // POST 방식이 아닌 경우 로그인 페이지로 리다이렉션
    header("Location: login.php?message=잘못된 요청입니다.");
    exit();
}
?>
