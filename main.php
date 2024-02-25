<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: login.php");
        exit;
    }

// 'page' 쿼리 스트링이 없거나 비어 있는 경우 'board'로 리다이렉트
    if (!isset($_GET['page']) || empty($_GET['page'])) {
        header("Location: main.php?page=board");
        exit;
    }

$page = $_GET['page'];
$idx = $_GET['idx'] ?? ''; // 게시글 상세보기를 위한 idx
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Main</title>
</head>
<body>
    <div id="wrap">
        <?php include __DIR__ . '/includes/header.php'; ?>

        <main>
            <?php include __DIR__ . '/includes/navigation.php'; ?>
            
            <?php
                // 'page' 쿼리 스트링 값에 따라 다른 내용을 포함합니다.
                if ($page === 'board') {
                    include __DIR__ . '/includes/board.php';
                } elseif ($page === 'write') {
                    include __DIR__ . '/includes/write.php';
                } elseif ($page === 'mypage') {
                    include __DIR__ . '/includes/mypage.php';
                } elseif ($page === 'view_post' && isset($_GET['idx'])) {
                    // 게시글 상세보기 페이지 포함
                    include __DIR__ . '/view_post.php';
                } elseif ($page === 'edit_post' && isset($_GET['idx'])) {
                    // 게시글 상세보기 페이지 포함
                    include __DIR__ . '/edit_post.php';
                }else {
                    echo "<p>페이지를 찾을 수 없습니다.</p>";
                }
            ?>
        </main>

        <?php include __DIR__ . '/includes/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>
</html>
