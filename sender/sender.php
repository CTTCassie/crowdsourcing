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
        $sqlpass = "SELECT password FROM `senderinfo` WHERE `telphone`='{$username}' ";
        foreach($pdo->query($sqlpass) as $row)
          { 
            $password = $row['password'];
            break;
          }
    }
    ?>
    <meta charset="UTF-8">

    <title>发包方信息管理主页面</title>

    <link rel="stylesheet" href="../assert/jquery-ui.min.css">
    <script src="../assert/jquery.min.js"></script>
    <script src="../assert/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../assert/style.css">
    <style type='text/css'>
        div{
            width: 100%;
            height: 750px;
            background: -webkit-linear-gradient(
                top,green,lightgreen,white
            );
        }
    </style>

</head>
<body>
<center>
    <?php
        echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
        echo "<label><h2>移动应用众包测试平台之发包方主页面</h2></label>";
        echo "<br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $minformation = "window.location.href='/sender/minformation.php'";
        $achieve = "window.location.href='/sender/achieve.php'";
        $myitem = "window.location.href='/sender/myitem.php'";
        $logout = "window.location.href='/index.php'";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$minformation value='发包方基本信息维护'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$achieve value='发布项目'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$myitem value='我的项目'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$logout value='退出登陆'/>";
    ?>
</center>
</body>
</html>