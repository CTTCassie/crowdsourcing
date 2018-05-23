<html>
<head>
    <meta charset="UTF-8">
     <?php
        include_once "../common/strap.php";
    ?> 
</head>
<body>
<center>
  <br><br><br>
    <?php
    include_once "../common/conn.php";
     $uid = $_GET['uid'];
     if ($uid == ''){
         echo "<script> alert('没有要删除的数据');
                        window.history.back();    //返回上一页
                </script>";
    }
    $sql = "DELETE FROM `testinfo` WHERE `uid`='{$uid}'";
    $stmt = $pdo->query($sql);//返回预处理对象
    if($stmt->rowCount()>0){
        echo "<script> alert('删除成功');
            window.location.href = '/part.php';
            </script>";
        }else{
            echo "<script> alert('删除失败');
                    window.history.back();
            </script>";
        }
    ?>
</center>
</body>
</html>