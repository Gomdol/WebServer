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


// 파일 업로드 처리
$uploadDirectory = "uploads/";
$uploadedFilePath = ""; // 업로드된 파일 경로 초기화
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $destinationFilePath = $uploadDirectory . $fileName;
    
    if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
        $uploadedFilePath = $destinationFilePath;
    } else {
        echo "파일 업로드에 실패했습니다.";
        exit;
    }
}


// 데이터베이스 업데이트 (파일 경로 포함)
$query = "UPDATE board SET title = ?, content = ?, file_path = ? WHERE idx = ?";
$stmt = mysqli_prepare($db_conn, $query);
mysqli_stmt_bind_param($stmt, 'sssi', $title, $content, $uploadedFilePath, $idx);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "포스트가 수정되었습니다.";
    // 수정 성공 시, 해당 게시글 상세보기 페이지로 리다이렉트
    header("Location: main.php?page=view_post&idx=$idx");
} else {
    echo "게시글 수정에 실패했습니다.";
}
?>
