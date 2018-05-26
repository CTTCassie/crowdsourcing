<?php
 include_once "../common/conn.php";
if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'sender':{
            $name = $_POST['name'];
            $age = $_POST['age'];
            $telphone = $_POST['telphone'];
            $trade = $_POST['trade'];
            $unitname = $_POST['unitname'];
            $postion = $_POST['postion'];
            $area = $_POST['area'];
            date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $hour = date("G");
            $minute = date("i");
            $second = date("s");
            $date = $year . "-" . $month . "-" . $day . "-" . $hour . "-" . $minute . "-" . $second;

            $sql = "SELECT * FROM `sender` WHERE `name`='{$name}'";
            $stmt = $pdo->query($sql);  

            if($stmt->rowCount()>0){   //数据已存在
                $sql_update = "UPDATE `sender` SET `age`='{$age}',`telphone`='{$telphone}',`trade`='{$trade}',`unitname`='{$unitname}',`postion`='{$postion}',`area`='{$area}',`timeline`='{$date}' WHERE `name`='{$name}'";
                $rw = $pdo->exec($sql_update);
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
            else{
                $sql_insert = "INSERT INTO `sender`(`name`, `age`, `telphone`, `trade`, `unitname`, `postion`, `area`, `timeline`, `id`) VALUES ('{$name}','{$age}','{$telphone}','{$trade}','{$unitname}','{$postion}','{$area}','{$date}',null)";

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
        case 'app_test':{
            $item = $_POST['item'];
            $time = $_POST['time'];
            $describe = $_POST['describe'];
            $telphone = $_POST['telphone'];
            $price = $_POST['price'];
            $validtime = $_POST['validtime'];
            $remark = $_POST['remark'];
            $status = "未测试";
            date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $date = $year . "-" . $month . "-" . $day;

            $sql = "SELECT * FROM `appinformation` WHERE `item`='{$item}' ";
            $stmt = $pdo->query($sql);  
            $sql_insert = "";

            if($stmt->rowCount()>0){   //数据已存在
                $sql_update = "UPDATE `appinformation` SET `time`='{$time}',`describe`='{$describe}',`telphone`='{$telphone}',`price`='{$price}',`validtime`='{$validtime}',`remark`='{$remark}', `flagtime`='{$date}' WHERE `item`='{$item}'";
                $rw = $pdo->exec($sql_update);
                if($rw > 0){
                    echo "<script>alert('数据保存成功');
                        window.location='myitem.php'
                        </script>";
                }else{
                    echo "<script>alert('数据保存失败');
                        window.history.back();
                    </script>";
                }
            }
            else{
                $sql_insert = "INSERT INTO `appinformation`(`item`, `time`, `describe`, `telphone`, `price`, `validtime`, `remark`, `status`, `flagtime`, `id`) VALUES ('{$item}','{$time}','{$describe}','{$telphone}','{$price}','{$validtime}', '{$remark}','{$status}', '{$date}',null)";

                $rw = $pdo->exec($sql_insert);
                if($rw > 0){
                    echo "<script>alert('数据保存成功');
                        window.location='myitem.php'
                        </script>";
                }else{
                    echo "<script>alert('数据保存失败');
                        window.history.back();
                    </script>";
                }
            }
            break;
        }
    case 'summarize':{
        $id = $_POST['id'];
        $bugnum = $_POST['bugnum'];
        $remark = $_POST['remark'];
        $finegrade = $_POST['finegrade'];
        $price = $_POST['price'];
        $evaluate = $_POST['evaluate'];
        
        $status = "已测试";
        $sql = "SELECT * FROM `appinformation` WHERE `id`='{$id}'";
        $stmt = $pdo->query($sql);
        $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
        //修改测试状态
        $sql_update = "UPDATE `appinformation` SET `status`= '{$status}' WHERE `id`='{$id}'";
        $stmt = $pdo->query($sql_update);
        //插入数据至历史数据中
        $sql_insert = "INSERT INTO `history`(`item`, `time`, `bugnum`, `finegrade`, `price`, `evaluate`, `remark`, `id`) VALUES ('{$info['item']}','{$info['time']}','{$bugnum}','{$finegrade}','{$price}','{$evaluate}','{$remark}',null)";

        $rw = $pdo->exec($sql_insert);
        if($rw > 0){
            echo "<script>alert('评价保存成功');
                    window.location='/tester/tester.php'
                </script>";
        }else{
            echo "<script>alert('评价保存失败');
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