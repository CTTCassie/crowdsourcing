
<?php
 include_once "../common/conn.php";
if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'tester':{
            $name = $_POST['name'];
            $age = $_POST['age'];
            $telphone = $_POST['telphone'];
            $education = $_POST['education'];
            $major = $_POST['major'];
            $account = $_POST['account'];
            $specialty = $_POST['specialty'];
            date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $hour = date("G");
            $minute = date("i");
            $second = date("s");
            $date = $year . "-" . $month . "-" . $day . "-" . $hour . "-" . $minute . "-" . $second;
            $sql = "SELECT * FROM `tester` WHERE `name`='{$name}'";
            $stmt = $pdo->query($sql);
            $sql_insert = "";
            if($stmt->rowCount()>0){   //数据已存在
                $sql_update = "UPDATE `tester` SET `age`='{$age}',`telphone`='{$telphone}',`education`='{$education}',`major`='{$major}',`account`='{$account}',`specialty`='{$specialty}',`timeline`='{$date}' WHERE `name`='{$name}' ";
                $rw = $pdo->exec($sql_update);
                if($rw > 0){
                    echo "<script>alert('基本信息修改成功');
                        window.history.back();
                        </script>";
                }else{
                    echo "<script>alert('基本信息修改失败');
                        window.history.back();
                        </script>";
                }
            }
            else{
                $sql_insert = "INSERT INTO `tester`(`name`, `age`, `telphone`, `education`, `major`, `account`, `specialty`, `timeline`, `id`) VALUES ('{$name}','{$age}','{$telphone}','{$education}','{$major}','{$account}','{$specialty}','{$date}',null)";
                $rw = $pdo->exec($sql_insert);
                if($rw > 0){
                    echo "<script>alert('基本信息保存成功');
                        window.history.back();
                        </script>";
                }else{
                    echo "<script>alert('基本信息保存失败');
                        window.history.back();
                        </script>";
                }
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