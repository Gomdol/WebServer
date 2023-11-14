<?php
session_start();

require_once 'db_func.php'; // 데이터베이스 연결 파일

echo '<pre>';
var_dump($_POST);
echo '</pre>';
// 이 코드 아래에 로그인 검증 로직이 있어야 합니다.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 입력 받은 id와 pw
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    // SQL 인젝션 방지를 위해 입력 값에 대한 검증이나 이스케이프를 수행해야 합니다.
    // 데이터베이스에서 사용자 확인
    $check_query = "SELECT * FROM test_table WHERE name = '$id' AND pass = '$pw'";
    $check_result = mysqli_query($db_conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // 로그인 성공, index.php로 리다이렉션
        $_SESSION['id']=$id;
        header("Location: index.php");
        exit();
    } else {
        // 로그인 실패, 로그인 페이지로 리다이렉션하며 메시지 전달
        header("Location: login.php?message=아이디 또는 비밀번호가 잘못되었습니다.");
        exit();
    }
} else {
    // POST 방식이 아닌 경우 로그인 페이지로 리다이렉션
    header("Location: login.php?message=잘못된 요청입니다.");
    exit();
}
?>
