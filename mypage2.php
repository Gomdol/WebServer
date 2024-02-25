<?php
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require_once 'db_func.php'; // 데이터베이스 연결

// 사용자 정보 조회
$user_id = $_SESSION['id'];
$query = "SELECT name, email FROM accounts WHERE name = '$user_id'";
$result = mysqli_query($db_conn, $query);
$user_data = mysqli_fetch_assoc($result);

// 비밀번호 변경 성공 메시지 확인
$password_change_success = "";
if (isset($_SESSION['password_change_success'])) {
    $password_change_success = $_SESSION['password_change_success'];
    unset($_SESSION['password_change_success']); // 메시지 표시 후 세션에서 제거
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>마이페이지</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login_warp">
            <h1>마이페이지</h1>
            <?php if ($password_change_success): ?>
                <p style="color: green;"><?php echo $password_change_success; ?></p>
            <?php endif; ?>
            <div class="login_input">
                <label>아이디: <?php echo htmlspecialchars($user_data['name']); ?></label>
            </div>
            <div class="login_input">
                <label>이메일: <?php echo htmlspecialchars($user_data['email']); ?></label>
            </div>
            <!-- 비밀번호 변경 페이지로 이동하는 버튼 추가 -->
            <div class="login_input">
                <a href="change_password.php" class="password_change_btn">비밀번호 변경</a>
            </div>
            <hr>
            <a href="logout.php">로그아웃</a>
        </div>
    </div>
</body>
</html>
