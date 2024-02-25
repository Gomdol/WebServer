<?php
require_once 'db_func.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    if (empty($email)) {
        // 이메일 필드가 비어있으면 에러 메시지를 출력
        echo "이메일 주소를 입력해주세요.";
    } else {
        // 데이터베이스에서 이메일 주소 검색
        $search_query = "SELECT * FROM accounts WHERE email = '$email'";
        $result = mysqli_query($db_conn, $search_query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['name'];

            // 세션에 사용자 이름 저장
            $_SESSION['id'] = $username;
            header("Location: change_password.php");
            exit();
        } else {
            // 이메일 주소가 데이터베이스에 존재하지 않으면 에러 메시지 출력
            echo "해당 이메일 주소로 등록된 계정이 없습니다.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>비밀번호 찾기</title>
</head>
<body>
    <div class="email-container">
        <div class="find-email">
            <form action="" method="post">
                <label for="email">이메일 주소:</label>
                <input type="email" id="email" name="email">
                <button type="submit">확인</button>
            </form>
        </div>
    </div>
</body>
</html>
