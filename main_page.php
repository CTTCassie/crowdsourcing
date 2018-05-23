
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
        <br>
        <?php
        session_start();
        include_once "/common/strap.php";
        include_once "/common/conn.php";
        include_once "/common/top_bottom.php";
        if (empty($_SESSION['username'])){
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
        }
        else{
            $username = $_SESSION['username'];
            $sqlpass = "SELECT password from `senderinfo` where `telphone`='{$username}'";
            foreach($pdo->query($sqlpass) as $row)
            { 
                $password = base64_decode($row['password']);
                break;
            }
        }
        ?>
        <!-- 页面部分 -->  

        <div class="row" width="100%">  
            <div class="col-sm-2" width="50%">
                <iframe  src="part.php" name="frame2" frameborder="0" width="1585" height="1400" marginheight="0" marginwidth="0" scrolling="no">
                </iframe>   
            </div>
        </div>
        <script type="text/javascript" src="/assert/jquery.min.js"></script>  
        <script type="text/javascript" src="/assert/bootstrap.min.js"></script>  
    </body>  
</html> 