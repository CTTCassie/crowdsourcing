
   <?php  
                include_once "../common/conn.php";
                $id = $_GET['id'];
                $status = "已测试";
                $sql = "SELECT * FROM `appinformation` WHERE `id`='{$id}'";
                $stmt = $pdo->query($sql);

                $sql_update = "UPDATE `appinformation` SET `status`= '{$status}' WHERE `id`='{$id}'";
                $stmt = $pdo->query($sql_update);

                echo "<table width='50%' cellspacing='0'  cellpadding='0' border='1' style='width:50%;table-layout:fixed'>";
                echo "<tr height='40px' bgcolor='#00FFFF'>
                        <th style='width:3%;table-layout:fixed'>APP名称</th>
                        <th style='width:3%;table-layout:fixed'>测试状态</th>
                    </tr>";

                $sql_query = "SELECT * FROM `appinformation` WHERE `status` like '%已测试%'";

                foreach ($pdo->query($sql_query) as $row){
                    echo "<tr height='50px'>"; 
                    echo "<td>{$row['item']}</td>"; 
                    echo "<td>{$row['status']}</td>"; 
                    echo "</tr>";
                }

                echo "</table>";

            echo "<br><br><br>";

              

    ?>  