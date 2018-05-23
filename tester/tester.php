<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
    }
    else
    {
        $username = $_SESSION['username'];
        $sqlpass = "SELECT password FROM `testinfo` WHERE `telphone`='{$username}' ";
        foreach($pdo->query($sqlpass) as $row)
          { 
            $password = $row['password'];
            break;
          }
    }
    ?>
    <meta charset="UTF-8">

    <title>测试人员信息管理主页面</title>

    <link rel="stylesheet" href="../assert/jquery-ui.min.css">
    <script src="../assert/jquery.min.js"></script>
    <script src="../assert/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../assert/style.css">
    <style type='text/css'>
        div{
            width: 100%;
            height: 750px;
            background: -webkit-linear-gradient(
                top,blue,lightblue,white
            );
        }
    </style>

</head>
<body>
<center>
    <?php
        echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
        echo "<label><h2>移动应用众包测试平台之测试人员主页面</h2></label>";
        echo "<br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $minformation = "window.location.href='/tester/minformation.php'";
        $testapp = "window.location.href='/tester/testapp.php'";
        $history = "window.location.href='/tester/history.php'";
        $logout = "window.location.href='/index.php'";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$minformation value='测试人员基本信息维护'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$testapp value='测试App'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$history value='历史记录'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$logout value='退出登陆'/>";
    ?>
    <br><br><br>
    <a href="/index.php">Copyright©西安工业大学</a>
</center>
</body>
</html>