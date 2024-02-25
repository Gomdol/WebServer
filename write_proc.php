<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        // 사용자가 로그인하지 않았다면 로그인 페이지로 리다이렉션
        header('Location: /login.php');
        exit;
}

// 데이터베이스 연결 파일 포함
require_once 'db_func.php';

// 폼에서 전송된 데이터 받기
$title = $_POST['title'];
$content = $_POST['content'];
$author = $_SESSION['id']; 
$creation_date = date('Y-m-d'); // 현재 날짜
$last_modified_date = date('Y-m-d'); // 현재 날짜, 수정일은 생성일과 동일하게 시작
$views = 0; // 새 글의 조회수는 0으로 시작

// SQL 쿼리 준비
$query = "INSERT INTO `board` (`idx`, `title`, `content`, `author`, `creation_date`, `last_modified_date`, `views`) VALUES (NULL, ?, ?, ?, ?, ?, ?)";

// SQL 쿼리 실행을 위한 준비
$stmt = mysqli_prepare($db_conn, $query);

// SQL 쿼리 파라미터 바인딩
mysqli_stmt_bind_param($stmt, 'sssssi', $title, $content, $author, $creation_date, $last_modified_date, $views);

// SQL 쿼리 실행
$result = mysqli_stmt_execute($stmt);

// 결과 확인 및 리다이렉션
if ($result) {
    // 글쓰기 성공 시 board.php(또는 원하는 페이지)로 리다이렉션
    header('Location: main.php?page=board');
} else {
    // 에러 메시지 출력 또는 에러 처리 페이지로 리다이렉션
    echo "Error: " . mysqli_error($db_conn);
}

// 데이터베이스 연결 종료
mysqli_close($db_conn);
?>
