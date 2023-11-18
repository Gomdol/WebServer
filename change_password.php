<!DOCTYPE html>
<html>
<head>
    <title>비밀번호 변경</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login_warp">
            <h1>비밀번호 변경</h1>
            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;">입력된 비밀번호가 서로 다릅니다. 다시 시도해주세요.</p>
            <?php endif; ?>
            <form action="update_password.php" method="post">
                <div class="login_input">
                    <input type="password" name="new_password" placeholder="새 비밀번호">
                </div>
                <div class="login_input">
                    <input type="password" name="confirm_password" placeholder="새 비밀번호 확인">
                </div>
                <input type="submit" value="비밀번호 변경">
            </form>
        </div>
    </div>
</body>
</html>
