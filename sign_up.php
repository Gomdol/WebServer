<?php
// URL 매개변수에서 메시지 가져오기
$message = $_GET['message'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" type="text/css" href="sign_up.css">
</head>
<body>
    <div class="container">
        <div class="signup_wrap">
            <h1>회원가입 페이지입니다.</h1>
            <form action="sign_up_proc.php" method="post">
                <div class="login_input">
                    <input type="text" name='email' placeholder="이메일 주소">
                </div>
                <div class="login_input">
                    <input type="text" name='name' placeholder="사용자 이름">
                </div>
                <div class="login_input">
                    <input type="password" name='password' placeholder="비밀번호">
                </div>
                <input type="submit" value="가입하기">
                <hr>
                <p>계정이 있으신가요? <a href="index.php">로그인</a></p>
                <?php
                    // 메시지가 비어있지 않다면 메시지 표시
                    if (!empty($message)) {
                        echo '<div class="message">' . $message . '</div>';
                        if ($message == "회원가입이 완료되었습니다."){
                            header("Refresh: 1.5; URL=mini_mission.php");
                        }
                        exit;
                    }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
