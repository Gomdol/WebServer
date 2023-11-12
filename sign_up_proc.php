<?php
require_once 'db_func.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Check if the name already exists in the database
    $check_query = "SELECT * FROM test_table WHERE name = '$name'";
    $check_result = mysqli_query($db_conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If the name already exists, redirect with a message
        header("Location: sign_up.php?message=해당 사용자는 이미 회원가입되어 있습니다.<br><br> 비밀번호를 확인하시거나 비밀번호 찾기를 통해 비밀번호를 변경하세요.");
        exit();
    } else {
        // If the name is not in the database, insert the new user
        $insert_query = "INSERT INTO test_table (name, pass, email) VALUES ('$name', '$password', '$email')";
        $insert_result = mysqli_query($db_conn, $insert_query);

        if ($insert_result) {
            // Registration successful, redirect with a success message
            header("Location: sign_up.php?message=회원가입이 완료되었습니다.");
            exit();
        } else {
            // Registration failed, redirect with an error message
            header("Location: sign_up.php?message=회원가입 중 오류가 발생했습니다. 나중에 다시 시도해주세요.");
            exit();
        }
    }
} else {
    // Handle invalid request
    header("Location: sign_up.php?message=잘못된 요청입니다.");
    exit();
}

mysqli_close($db_conn);
?>
