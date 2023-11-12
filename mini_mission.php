<!-- 학생 이름, 점수가 들어가있는 DB
GET방식으로 학생 이름 나오면, 점수가 출력되는 페이지 만들기 -->

<?php
require_once 'db_func.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>학생 성적 조회</title>
        <link rel="stylesheet" type="text/css" href="mini_mission.css">
    </head>
    <body>
        <h2>학생의 이름을 입력하면 성적을 확인할 수 있습니다.</h2>
        <form action="">
            <input type="text" name="sname" placeholder="이름을 입력하세요.">
            <button type="submit">확인</button>
        </form>    
        <div style="<?php if(!isset($_GET['sname'])) echo 'display: none;'; ?>">
        <?php
                if(isset($_GET['sname'])){
                    $sname = $_GET['sname'];

                    $sql = "select * from test_table where name ='$sname'";
                    $result = mysqli_query($db_conn, $sql);
                    $row = mysqli_fetch_array($result);

                    if(isset($row)){
                        echo "<h1>".$row['name'] . " 학생의 점수는 " . $row['score'] . " 입니다.</h1>";
                    } else {
                        echo "<h1>해당 학생은 DB에 존재하지 않습니다.</h1>";
                    }
                }
                mysqli_close($db_conn);
            ?>
        </div>
    </body>
</html>