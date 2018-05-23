
<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="/assert/bootstrap.min.css" />  
        <title>用户信息展示</title>  
        <style type="text/css"></style>  
        <?php
        session_start();
        include_once "/common/strap.php";
        include_once "/common/conn.php";
        if (empty($_SESSION['username'])){
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../index.php"."\""."</script>";
        }
        else{
          $username = $_SESSION['username'];
          $sqlpass = "SELECT password FROM `senderinfo` WHERE telphone='{$username}'";
          foreach($pdo->query($sqlpass) as $row)
          { 
            $password = base64_decode($row['password']);
            break;
          }
        }
        ?>
        <script>
        </script>
    </head>
    <body>
    <br><br><br>
    <div class="panel panel-success" width="50%">
        <div class="panel-heading">
            <h3 class="panel-title">
                测试人员用户信息
            </h3>
        </div>
        <div class="panel-body">
          <table width="50%" cellspacing="0"  cellpadding="0" border="1" style="width:25%;table-layout:fixed">
            <tr height="40px" bgcolor="">
            <th style='width:100px;'>用户名</th>
            <th style='width:100px;'>生日</th>
            <th style='width:100px;'>标签</th>
            <th style='width:100px;'>学历</th>
            <th style='width:100px;'>密码</th>
            <th style='width:200px;'>简介</th>
            <th style='width:100px;'>操作</th>
        </tr>
        <?php
           $sql = "SELECT `uid`, `telphone`, `birthday`, `title`, `education`, `password`, `introduce` FROM `senderinfo` WHERE 1";
           foreach ($pdo->query($sql) as $row){
            echo "<tr height='50px'>";
            echo "<td>{$row['telphone']}</td>"; 
            echo "<td>{$row['birthday']}</td>"; 
            echo "<td>{$row['title']}</td>"; 
            echo "<td>{$row['education']}</td>"; 
            echo "<td>{$row['password']}</td>"; 
            echo "<td>{$row['introduce']}</td>"; 
            echo "<td style='width:6%;table-layout:fixed'>
                    <a href='/master/send_edit.php?uid={$row['uid']}'>修改</a>
                    <a href='/master/send_delete.php?uid={$row['uid']}'>删除</a>
                  </td>";
            echo "</tr>";
           }
        ?>
      </table>
        </div>
    </div>
    <div class="panel panel-success" width="50%">
        <div class="panel-heading">
            <h3 class="panel-title">
                发包方用户信息
            </h3>
        </div>
      <div class="panel-body">
        <table width="50%" cellspacing="0"  cellpadding="0" border="1" style="width:25%;table-layout:fixed">
        <tr height="40px" bgcolor="">
            <th style='width:100px;'>用户名</th>
            <th style='width:100px;'>生日</th>
            <th style='width:100px;'>标签</th>
            <th style='width:100px;'>学历</th>
            <th style='width:100px;'>密码</th>
            <th style='width:200px;'>简介</th>
            <th style='width:100px;'>操作</th>
        </tr>
        <?php
           $sql = "SELECT `uid`, `telphone`, `birthday`, `title`, `education`, `password`, `introduce` FROM `testinfo` WHERE 1";
           foreach ($pdo->query($sql) as $row){
            echo "<tr height='50px'>";
            echo "<td>{$row['telphone']}</td>"; 
            echo "<td>{$row['birthday']}</td>"; 
            echo "<td>{$row['title']}</td>"; 
            echo "<td>{$row['education']}</td>"; 
            echo "<td>{$row['password']}</td>"; 
            echo "<td>{$row['introduce']}</td>"; 
            echo "<td style='width:6%;table-layout:fixed'>
                    <a href='/master/tester_edit.php?uid={$row['uid']}'>修改</a>
                    <a href='/master/tester_delete.php?uid={$row['uid']}'>删除</a>
                  </td>";
            echo "</tr>";
           }
        ?>
      </table>
      </div>
    </div>
    <script type="text/javascript" src="/assert/jquery.min.js"></script>  
    <script type="text/javascript" src="/assert/bootstrap.min.js"></script>
    </body> 
</html>