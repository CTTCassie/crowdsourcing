<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="/assert/bootstrap.min.css" />  
        <title>移动应用众包测试平台注册</title>  
        <style type="text/css"></style>  

    </head>
    <body>
    <?php
    session_start();
    //include_once "/common/top_bottom.php";
    //error_reporting(0);
    ?>
    <div class="page" width="100%">
        <form id="iterInfo" name="iterInfo" method="post" action="test_register.php" class="form-inline" role="form">
            <div class="panel panel-success" width="100%">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <center>移动应用众包测试平台注册</center>>
                    </h3>
                </div>
                <div class="panel-body">
                    <center>测试人员注册</center>
                    <center>手机号：&nbsp;&nbsp;&nbsp;
                    <input type="text"  id='telphone' class="form-control" name="telphone" style="width:200px;height:30px;" placeholder="请使用手机号注册"/></center><br />
                    <center>生日：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input id='birthday' class="form-control" name='birthday' type="date" style="width:200px;height:30px;"/></center><br />
                    <center>标签：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select id="title" name="title" class="form-control" style="width:200px;height:30px;font-size:10px">
                        <option value="Java">Java</option>
                        <option value="PHP">PHP</option>
                        <option value="C#">C#</option>
                        <option value="Node.js">Node.js</option>
                    </select></center><br />
                    <center>学历：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select id="education" name="education" class="form-control" style="width:200px;height:30px;font-size:10px">
                        <option value="博士">博士</option>
                        <option value="研究生">研究生</option>
                        <option value="本科生">本科生</option>
                        <option value="本科生以下学历">本科以下学历</option>
                    </select>
                    </center><br />
                    <center>密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="password" id='password' class="form-control" name="password" style="width:200px;height:30px;" placeholder="请输入密码"/></center><br />
                    <center>确认密码：
                    <input type="password" id='password2' class="form-control" name="password2"  style="width:200px;height:30px;" placeholder="请确认密码"/></center><br />
                    <center>简介：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <textarea id="introduce" name="introduce" class="form-control" style="width:200px;height:100px;" value="使用PHP">熟悉PHP</textarea></center><br />
                    <center>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" id='reg' width="80px" height="100px" value="注册" class='btn btn-info' name="reg">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="index.php">返回登录页面</a>
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
    if (!empty($_POST['reg'])) 
    {
    if($pdo)
    {
        $telphone = $_POST['telphone'];
        $birthday = $_POST['birthday'];
        $title = $_POST['title'];
        $education = $_POST['education'];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $introduce = $_POST['introduce'];
        date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $date = $year . "-" . $month . "-" . $day;
        $count = 0;   //初次注册应该为0次

        if($telphone == "" || $birthday == "" || $title == "" || $education == "" || $password == "" || $password2 == "" || $introduce == "")//判断是否为空
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请输入完整的注册信息！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/test_register.php"."\""."</script>";
          exit;
        }
        $sqlreg = "SELECT * FROM `testinfo` WHERE `telphone`='{$telphone}'";
        $result = $pdo->query($sqlreg);
        if($result->rowCount()!=0)
        {
        	echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户已存在！"."\"".")".";"."</script>";
        	echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/test_register.php"."\""."</script>";
        }
        else
             {
        if($password==$password2)//判断密码与确认密码是否一致
          {
            $sqlreg = "INSERT INTO `testinfo` VALUES (null,'{$telphone}','{$birthday}','{$title}','{$education}','{$password}','{$introduce}','{$count}','{$date}')";
            $rw = $pdo->exec($sqlreg);
            if ($rw > 0) 
            {
            //echo"数据库关闭";
            //echo"注册成功！";
           	    echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."注册成功，请登录！"."\"".")".";"."</script>";
     			echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";  
            }
            else{

            }
        }
        else
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请确认密码一致！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."test_register.php"."\""."</script>";    
        }
      }
    }
  }
    ?> 
</html>  