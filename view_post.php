<?php
session_start();
require_once 'db_func.php';

// URL에서 idx 값 가져오기
$idx = isset($_GET['idx']) ? intval($_GET['idx']) : 0;

// 데이터베이스 쿼리 실행
$post = null; // 초기화
if ($idx > 0) {
    $query = "SELECT * FROM board WHERE idx = ?";
    $stmt = mysqli_prepare($db_conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $idx);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);

    if (!$post) {
        echo "해당 글을 찾을 수 없습니다.";
        exit;
    }
} else {
    echo "잘못된 접근입니다.";
    exit;
}

// 현재 로그인한 사용자가 글 작성자인지 확인
$isUserAuthor = isset($_SESSION['id']) && $_SESSION['id'] === $post['author']; // 'author_id'는 실제 필드명에 맞게 변경해야 할 수 있음


if ($post) {
    // 게시글 조회 성공 후 조회수 증가
    $updateQuery = "UPDATE board SET views = views + 1 WHERE idx = ?";
    $updateStmt = mysqli_prepare($db_conn, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, 'i', $idx);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<section id="write">
    <div class="form-group">
        <label for="title">제목</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" disabled>
    </div>
    <div class="form-group">
        <label for="content">내용</label>
        <textarea id="content" name="content" disabled><?php echo htmlspecialchars($post['content']); ?></textarea>
    </div>
    <?php if ($isUserAuthor): ?>
    <div class="form-group">
        <!-- 수정 버튼: <a> 태그 대신 <button> 사용 -->
        <button class="btn btn-outline-secondary" type="button" id="edit-button">수정</button>
        <!-- 삭제 버튼 -->
        <form action="delete_proc.php" method="GET" onsubmit="return confirm('정말 이 게시글을 삭제하시겠습니까?');" style="display: inline;">
            <input type="hidden" name="idx" value="<?php echo $idx; ?>">
            <button type="submit" class="btn btn-outline-secondary">삭제</button>
        </form>
    </div>
    <?php endif; ?>

    <script>
    // 수정 버튼에 클릭 이벤트 리스너 추가
    document.getElementById('edit-button').addEventListener('click', function() {
        // main.php?page=edit_post&idx= 로 페이지 이동, idx 값에 현재 글의 ID를 동적으로 추가
        window.location.href = 'main.php?page=edit_post&idx=<?php echo $idx; ?>';
    });
    </script>


</section>
<script src="./js/script.js"></script>
</body>
</html>