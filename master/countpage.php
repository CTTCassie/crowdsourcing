   <?php  

                include_once "../common/conn.php";
                $activenum = 1;
                $value = $_GET['value'];   //获得日期

                $newuser = 0;   //统计新注册用户
                $activeuser = 0;  //统计活跃用户

                date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
                $year = date("Y");
                $month = date("m");
                $day = date("d");
                $date = $year . "-" . $month . "-" . $day;

                $packetnum = 0;   //发包个数
                $task = 0;   //月任务

                //统计测试人员
                $sql_test = "SELECT * FROM `testinfo` WHERE `time` like '%{$value}%'";
                foreach ($pdo->query($sql_test) as $Info){
                    if(strcmp($Info['time'],$date)){
                        $newuser++;
                    }
                    if($Info['numbers'] >= $activenum){
                        $activeuser++;
                    }
                }
                //统计发包方
                $sql_sender = "SELECT * FROM `senderinfo` WHERE `time` like '%{$value}%' ";
                foreach ($pdo->query($sql_sender) as $Info){
                    if(strcmp($Info['time'],$date)){
                        $newuser++;
                    }
                    if($Info['numbers'] >= $activenum){
                        $activeuser++;
                    }
                }

                $sql = "SELECT * FROM `report` WHERE `time` like '%{$value}%'";
                $stmt = $pdo->query($sql);//返回预处理对象
                if($stmt->rowCount() > 0){
                    $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
                    $sql_update = "UPDATE `report` SET `packetnum`='{$packetnum}',`task`='{$task}',`newuser`='{$newuser}',`activeuser`='{$activeuser}' WHERE `time` like '%{$value}%' ";
                    $rw = $pdo->exec($sql_update);
                    if($rw > 0){
                        echo "<script>alert('统计成功111');
                        </script>";
                    }else{
                        echo "<script>alert('统计失败111');
                        </script>";
                    }
                }else{
                    //`packetnum`, `task`, `newuser`, `activeuser`, `time`, `flagtime`, `id`
                    $sql_insert = "INSERT INTO `report`(`packetnum`, `task`, `newuser`, `activeuser`, `time`, `flagtime`, `id`) VALUES ('{$packetnum}','{$task}','{$newuser}','{$activeuser}','{$date}','{$value}', null)";
                    $rw = $pdo->exec($sql_insert);
                    if($rw > 0){
                        echo "<script>alert('统计成功222');
                        </script>";
                    }else{
                        echo "<script>alert('统计失败222');
                        </script>";
                    }
                }



                echo "<table width='75%' cellspacing='0'  cellpadding='0' border='1' style='width:75%;table-layout:fixed'>";
                echo "<tr height='40px' bgcolor='#00FFFF'>
                        <th style='width:5%;table-layout:fixed'>发包个数</th>
                        <th style='width:5%;table-layout:fixed'>月任务</th>
                        <th style='width:5%;table-layout:fixed'>新注册用户个数</th>
                        <th style='width:5%;table-layout:fixed'>活跃用户个数</th>
                    </tr>";
                $sql_query = "SELECT `packetnum`, `task`, `newuser`, `activeuser` FROM `report` WHERE `flagtime` like '%{$value}%'";

                foreach ($pdo->query($sql_query) as $row){
                    echo "<tr height='50px'>"; 
                    echo "<td>{$row['packetnum']}</td>"; 
                    echo "<td>{$row['task']}</td>"; 
                    echo "<td>{$row['newuser']}</td>"; 
                    echo "<td>{$row['activeuser']}</td>"; 
                    echo "</tr>";
                }
                echo "</table>";
            echo "<br><br><br><br><br><br><br>";
              
    ?>  