<?php
session_start();
require_once 'db_func.php'; // 데이터베이스 연결 파일

// 로그인 상태 확인
if (!isset($_SESSION['id'])) {
    echo "로그인이 필요합니다.";
    exit;
}

// 게시글 idx 확인
if (!isset($_GET['idx'])) {
    echo "잘못된 접근입니다.";
    exit;
}

$idx = $_GET['idx'];

// 게시글 삭제 쿼리 실행
$query = "DELETE FROM board WHERE idx = ?";
$stmt = mysqli_prepare($db_conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $idx);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // 삭제 성공 시, 게시판 목록으로 리다이렉트
    header("Location: main.php?page=board");
} else {
    echo "게시글 삭제에 실패했습니다.";
}
?>
