<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="/assert/bootstrap.min.css" />  
        <title>移动应用众包测试平台</title>  

        <style type="text/css"></style>  

    </head>
    <body>
    <?php
    session_start();
    //include_once "/common/top_bottom.php";
    //error_reporting(0);

    ?>
    <div class="page" width="100%">
        <form id="iterInfo" name="iterInfo" method="post" action="index.php" class="form-inline" role="form">
            <div class="panel panel-success" width="100%">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <center>移动应用众包测试平台</center>
                    </h3>
                </div>
                <div class="panel-body">
                    <center><label>用户登陆</label></center>
                    <center>账号：
                    <input type="text"  id='username' class="form-control" name="username" placeholder="请输入用户账号"/></center><br />
                    <center>密码：
                    <input type="password" id='password' class="form-control" name="password" placeholder="请输入登录密码"/></center><br />
                    <center>
                    <label><input name="individual" type="radio" value="发包方" />发包方</label> 
                    <label><input name="individual" type="radio" value="测试人员"/>测试人员</label> 
                    <label><input name="individual" type="radio" value="管理员" checked="true"/>管理员</label></center><br />
                    <center>
                    <input type="submit" id='log' width="80px" height="100px" value="登录" class='btn btn-info' name="log"></center><br />
                    <center>
                    <a href="sender_register.php">发包方注册</a>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="test_register.php">测试人员注册</a>
                    </center>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/assert/jquery.min.js"></script>  
    <script type="text/javascript" src="/assert/bootstrap.min.js"></script>
    </body> 
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/common/conn.php");
    if (!empty($_POST['log'])) 
    {
    if($pdo)
    {
        $name=$_POST["username"];
        $password=$_POST["password"];
        $individual = $_POST["individual"];
        if($name=="" || $password=="")//判断是否为空
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请输入用户名和密码！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
          exit;
        }
        else{
        if($individual == "发包方"){
          $sqlname = "SELECT `uid`,`numbers` FROM `senderinfo` WHERE `telphone`='{$name}'";
          $result = $pdo->query($sqlname);
          if($result->rowCount()!=0){
            $sqlpass = "SELECT `password` FROM `senderinfo` WHERE `telphone`='{$name}'";
            foreach($pdo->query($sqlpass) as $row)
            { 
              $pass = $row['password'];
              break;
            }
            $_SESSION["username"]=$name;
            $stmt = $pdo->query($sqlname);
            $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
            $count = $info['numbers'] + 1;
            $sql_update = "UPDATE `senderinfo` SET `numbers`='{$count}' WHERE `telphone`='{$name}'";
            $stmt = $pdo->query($sql_update);

            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."欢迎您  ".$name."   ！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/sender/sender.php"."\""."</script>";
            }
          else{  
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."密码不正确！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
            }
          }
        if($individual == "测试人员"){
          $sql = "SELECT `uid`, `numbers` FROM `testinfo` WHERE `telphone`='{$name}'";
          $result = $pdo->query($sql);
          if($result->rowCount()!=0){
            $sql_pass = "SELECT password FROM `testinfo` WHERE `telphone`='{$name}'";
            foreach($pdo->query($sql_pass) as $row)
            { 
              $pass = $row['password'];
              break;
            }
            $_SESSION["username"]=$name;
            $stmt = $pdo->query($sql);
            $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
            $count = $info['numbers'] + 1;
            $sql_update = "UPDATE `testinfo` SET `numbers`='{$count}' WHERE `telphone`='{$name}'";
            $stmt = $pdo->query($sql_update);

            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."欢迎您  ".$name."   ！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/tester/tester.php"."\""."</script>";
            }
          else{  
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."密码不正确！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
            }
          }
        if($individual == "管理员"){
            if($name == "root"){
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."欢迎您  ".$name."   ！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/main_page.php"."\""."</script>";
            }
            else{
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名错误，管理员必须为root登陆"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
            }
        }
    }




    }
}

    ?> 
</html>  