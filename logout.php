<?php
    session_start();

    // 모든 세션 변수 제거
    session_unset();

    // 세션 파괴
    session_destroy();

    header("Location: login.php");
    exit;  
?>