<!-- 겟 메소드로 로그인id 받은게 있는지 확인해서
없으면 login.php로 이동
있으면 mini_mission.php로 이동 -->

<?php
    if(empty($_GET['login_id'])){
        header("Location: login.php");
        exit;
    }else{
        header("Location: mini_mission.php");
        exit;
    }
?>