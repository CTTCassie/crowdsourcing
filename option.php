<?php
 include_once "/common/conn.php";
if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'edit':{
            $uid = $_POST['uid'];
            $name = $_POST['name'];
            $birthday = $_POST['birthday'];
            $title = $_POST['title'];
            $education = $_POST['education'];
            $password = $_POST['password'];
            $introduce = $_POST['introduce'];
            $sql_update = "UPDATE `senderinfo` SET `telphone`='{$name}', `birthday`='{$birthday}', `title`='{$title}', `education`='{$education}', `password`='{$password}', `introduce`='{$introduce}' WHERE `uid`='{$uid}'";
            
            $rw = $pdo->exec($sql_update);
            if($rw > 0){
                echo "<script>alert('修改成功');
                     window.location='part.php'
                      
                </script>";
            }else{
                echo "<script>alert('修改失败');
                      window.history.back();
                </script>";
            }
            break;
        }
 } 
}
if(!empty($_GET["act"])){
    switch ($_GET["act"]) {
      
    }
}
?>