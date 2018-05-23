<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>发包方修改用户信息</title>
    <style type='text/css'>
    </style>
    <script>
    </script>
</head>
<body>
<center>
     <br><br><br>
     <h4>发包方修改用户信息</h4>
     <br>
    <?php
    include_once "../common/conn.php";
    $uid = $_GET['uid'];
     
    if($uid == ''){
         echo "<script> alert('没有要修改的数据');
                    window.history.back();
                </script>";
    }
    if($uid != ''){
            $sql_send = "SELECT * FROM `senderinfo` WHERE `uid`='{$uid}'";
            $stmt = $pdo->query($sql_send);//返回预处理对象
            if($stmt->rowCount() > 0){
                $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
            }else{
                
                die("没有要修改的数据！");
            }
    ?>
            <form id="editInfo" name="editInfo" method="post" action="option.php">
                <input type="hidden" name="action" value="send_edit"/>
                <input type="hidden" name="uid" id="uid" value="<?php echo $info['uid'];?>"/>
                <table>
                    <tr>
                        <td>用户名</td>
                        <td><input style="width:100%;height:100%;" id="name" name="name" type="text"  value="<?php echo $info['telphone']?>"/></td>
                    </tr>
                    <tr>
                        <td>生日</td>
                        <td><input style="width:100%;height:100%;" type="text" name="birthday" id="birthday" value="<?php echo $info['birthday']?>"/></td>
                    </tr>
                    <tr>
                        <td>标签</td>
                        <td><input style="width:100%;height:100%;" id="title" name="title" type="text"  value="<?php echo $info['title']?>"/></td>
                    </tr>
                    <tr>
                        <td>学历</td>
                        <td><input style="width:100%;height:100%;" id="education" name="education" type="text"  value="<?php echo $info['education']?>"/></td>
                    </tr>
                    <tr>
                        <td>密码</td>
                        <td><input style="width:100%;height:100%;" id="password" name="password" type="text"  value="<?php echo $info['password']?>"/></td>
                    </tr>
                    <tr>
                        <td>简介</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="introduce" name="introduce" type="text" value="<?php echo $info['introduce']?>"/><?php echo $info['introduce']?></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="修改"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>
                        </td>
                    </tr>
                </table>
            </form>
    <?php
        }
    ?>
</center>
</body>
</html>