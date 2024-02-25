<?php
session_start();
require_once 'db_func.php'; // 데이터베이스 연결 파일

if (!isset($_GET['idx']) || !is_numeric($_GET['idx'])) {
    echo "잘못된 접근입니다.";
    exit;
}

$idx = $_GET['idx'];

// 데이터베이스에서 해당 idx의 게시글 데이터 조회
$query = "SELECT * FROM board WHERE idx = ?";
$stmt = mysqli_prepare($db_conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $idx);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
    <!-- 스타일시트 링크 -->
</head>
<body>
<section id="write">
    <form action="edit_proc.php" method="post">
        <input type="hidden" name="idx" value="<?php echo $idx; ?>">
        <div class="form-group">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="content">내용</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-secondary">수정 완료</button>
        </div>
    </form>
</section>
</body>
</html>
