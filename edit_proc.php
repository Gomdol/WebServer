<?php
session_start();
require_once 'db_func.php'; // 데이터베이스 연결 파일

if (!isset($_POST['idx'], $_POST['title'], $_POST['content'])) {
    echo "필수 데이터가 누락되었습니다.";
    exit;
}

$idx = $_POST['idx'];
$title = $_POST['title'];
$content = $_POST['content'];

// 데이터베이스에서 해당 idx의 게시글 데이터 업데이트
$query = "UPDATE board SET title = ?, content = ? WHERE idx = ?";
$stmt = mysqli_prepare($db_conn, $query);
mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $idx);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // 수정 성공 시, 해당 게시글 상세보기 페이지로 리다이렉트
    header("Location: main.php?page=view_post&idx=$idx");
} else {
    echo "게시글 수정에 실패했습니다.";
}
?>
