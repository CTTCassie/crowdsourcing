<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../index.php"."\""."</script>";
    }
    else
    {
        $username = $_SESSION['username'];
        $sqlpass="SELECT `password` from `testinfo` where `telphone`='{$username}'";   
        foreach($pdo->query($sqlpass) as $row)
          { 
            $password = $row['password'];
            break;
          }
    }
    ?>
    <?php
        $Page_size=5; 
        $sql_count = "SELECT * FROM `history`";
        $stmt = $pdo->query($sql_count);
        $count = $stmt->rowCount(); 
        $page_count = ceil($count/$Page_size); 
        $init=1; 
        $page_len=7; 
        $max_p=$page_count; 
        $pages=$page_count;
        if(empty($_GET['page'])||$_GET['page']<0){ 
            $page=1; 
        }else { 
            $page=$_GET['page']; 
        } 
        $offset=$Page_size*($page-1);
    ?>

    <meta charset="UTF-8">
    <title>测试人员历史记录查询</title>
    <link rel="stylesheet" href="../assert/jquery-ui.min.css">
    <script src="../assert/jquery.min.js"></script>
    <script src="../assert/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../assert/style.css">

    <script src="../assert/jquery-1.11.0.min.js" type="text/javascript"></script>

    <script>
        previouspage = function(){   //返回上一页
            window.history.back(); 
        }

    </script>

</head>

<body>
<center>
    <h3>测试人员历史记录</h3>
</center>
    <?php
        echo "<div id='accort' class='table-responsive table2excel' data-tableName='Test Table 1'>";
            echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";
            echo "<tr height='40px' bgcolor='#00FFFF'>
                  <th style='width:5%;table-layout:fixed'>项目名称</th>
                  <th style='width:5%;table-layout:fixed'>测试年度</th>
                  <th style='width:5%;table-layout:fixed'>bug数</th>
                  <th style='width:5%;table-layout:fixed'>优良等级</th>
                  <th style='width:10%;table-layout:fixed'>价格</th>
                  <th style='width:10%;table-layout:fixed'>评价</th>
                  <th style='width:10%;table-layout:fixed'>备注</th>
                  </tr>";

            $sql = "SELECT `item`, `time`, `bugnum`, `finegrade`, `price`, `evaluate`, `remark`, `id` FROM `history` ORDER BY `time` desc limit $offset,$Page_size";
            foreach ($pdo->query($sql) as $row){
                 echo "<tr height='50px'>"; 
                 echo "<td>{$row['item']}</td>"; 
                 echo "<td>{$row['time']}</td>"; 
                 echo "<td>{$row['bugnum']}</td>"; 
                 echo "<td>{$row['finegrade']}</td>"; 
                 echo "<td>{$row['price']}</td>";
                 echo "<td>{$row['evaluate']}</td>";
                 echo "<td>{$row['remark']}</td>";
                 echo "</tr>";
            }
            echo "</table>";
            echo "<br><br><br>";
        echo "</div>";

        echo '<div class="page" align="right"  style="font-size:14px">'; 
            $countpages = "共 " . $count . " 条记录；" . "共 " . $pages . " 页";
            echo $countpages,"&nbsp;&nbsp;&nbsp;&nbsp;";

            echo "<span id='pagenumber'>$page/$pages</span> "; 
                if($page!=1){ 
                    echo "<a href='history.php?page=1'>第一页</a>&nbsp;";
                    echo "<a href='history.php?page=".($page-1)."'>上一页</a>&nbsp;";
                }else { 
                    echo "第一页 &nbsp;&nbsp;";
                    echo "上一页&nbsp;&nbsp;"; 
                } 

                $page_len = ($page_len%2)?$page_len:$pagelen+1;
                $pageoffset = ($page_len-1)/2;
                if($pages>$page_len){ 
                    if($page<=$pageoffset){ 
                        $init=1; 
                        $max_p = $page_len; 
                    }else{
                        if($page+$pageoffset>=$pages+1){ 
                            $init = $pages-$page_len+1; 
                        }else{ 
                            $init = $page-$pageoffset; 
                            $max_p = $page+$pageoffset; 
                        } 
                    } 
                } 
                if($page!=$pages){ 
                    echo "<a href='history.php?page=".($page+1)."'>下一页</a>&nbsp;";
                    echo "<a href='history.php?page=".($pages)."'>最后一页</a>&nbsp;";
                }else { 
                    echo "下一页 ";
                    echo "最后一页"; 
                } 
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
            echo '</div>'; 
        echo "<br><br><br><br><br>";

     ?>
     <center>
        <br><br><br><br><br><br>
        <a href="/index.php">Copyright©西安工业大学</a>
     </center>>
</table>

</body>

</html>