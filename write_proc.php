<?php
    session_start();
    error_reporting(E_ALL); 
    ini_set('display_errors',1);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/php-error.log');

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

// 파일 업로드 처리
$uploadDirectory = "uploads/"; // 서버에 파일을 저장할 디렉터리
$uploadStatus = true; // 업로드 성공 여부
$uploadedFilePath = ""; // 업로드된 파일의 경로

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $destinationFilePath = $uploadDirectory . $fileName;

    // 파일을 지정된 위치로 이동
    if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
        $uploadedFilePath = $destinationFilePath;
    } else {
        $uploadStatus = false;
        echo "파일 업로드 실패.";
    }
}


// SQL 쿼리 준비 (file_path 추가)
$query = "INSERT INTO `board` (`idx`, `title`, `content`, `author`, `creation_date`, `last_modified_date`, `views`, `file_path`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";

// SQL 쿼리 실행을 위한 준비
$stmt = mysqli_prepare($db_conn, $query);

// SQL 쿼리 실행을 위한 준비 (매개변수에 $uploadedFilePath 추가)
mysqli_stmt_bind_param($stmt, 'sssssis', $title, $content, $author, $creation_date, $last_modified_date, $views, $uploadedFilePath);

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
