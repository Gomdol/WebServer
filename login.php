<?php
    session_start();

    // 메시지 초기화
    $message = "";
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        // 메시지를 스크립트 상단에서 즉시 출력하지 않습니다.
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login_warp">
            <h1>Welcome!!!</h1>
            <form action="login_proc.php" method="POST">
                <div class="login_input"><input type="text" name="id" placeholder="ID"></div>
                <div class="login_input"><input type="password" name="pw" placeholder="Password"></div>
                <div class="login_input"><input type="submit" value="로그인"></div>
            </form>
            <hr>
            <p><a href="find_pw.php">Forgot Password?</a></p>
            <p>Don't have an account? <a href="sign_up.php">Sign up</a></p>
            <?php
                // 메시지가 설정되어 있다면 여기에서 메시지를 표시합니다.
                if (!empty($message)) {
                    echo '<div class="message" style="color: red;">' . $message . '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
