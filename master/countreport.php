<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    //include_once "../common/top_bottom.php";
    if (empty($_SESSION['username'])){
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../index.php"."\""."</script>";
    }
    else{
        $username = $_SESSION['username'];
    }
    ?>
    <?php
        $Page_size=5; 
        $sql_count = "SELECT * FROM `report`";
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


        date_default_timezone_set ("Asia/Chongqing");   //选用格林威志时间
        $year = date("Y");
        $month = date("m");   
        $date = $year . "-" . $month;
    ?>

    <meta charset="UTF-8">
    <title>统计报表</title>
    <link rel="stylesheet" href="../assert/jquery-ui.min.css">
    <script src="../assert/jquery.min.js"></script>
    <script src="../assert/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../assert/style.css">

    <script src="../assert/jquery-1.11.0.min.js" type="text/javascript"></script>

    <script>

        searchData = function(){   //查询数据
            var value = $("#date1").val();
            var date1= $.trim(value); 
            $.get('countpage.php',{
                value:date1,
                page:1
            },function(data) {
                $("#accort").html(data);
             })   
        };

        previouspage = function(){   //返回上一页s
            window.history.back(); 
        };

    </script>

</head>

<body>
<center>
    <h3>统计报表</h3>
</center>

            <input id='date1' name='date1' style='width:200px;height:20px;' placeholder='2018-05' />&nbsp;&nbsp;&nbsp;
            <input type='button' onclick='searchData()'  value='统计报表'/>
    <br><br>
    <?php
        echo "<div id='accort' class='table-responsive table2excel' data-tableName='Test Table 1'>";
            echo "<table width='75%' cellspacing='0'  cellpadding='0' border='1' style='width:75%;table-layout:fixed'>";
            echo "<tr height='40px' bgcolor='#00FFFF'>
                  <th style='width:5%;table-layout:fixed'>发包个数</th>
                  <th style='width:5%;table-layout:fixed'>新注册用户个数</th>
                  <th style='width:5%;table-layout:fixed'>活跃用户个数</th>
                  </tr>";

            $sql = "SELECT `packetnum`, `newuser`, `activeuser`, `time`, `id` FROM `report`  WHERE `flagtime` like '%{$date}%'ORDER BY `time` desc limit $offset,$Page_size";
            foreach ($pdo->query($sql) as $row){
                 echo "<tr height='50px'>"; 
                 echo "<td>{$row['packetnum']}</td>"; 
                 echo "<td>{$row['newuser']}</td>"; 
                 echo "<td>{$row['activeuser']}</td>"; 
                 echo "</tr>";
            }
            echo "</table>";
            echo "<br><br><br>";
        echo "</div>";

        /*echo '<div class="page" align="right"  style="font-size:14px">'; 
            $countpages = "共 " . $count . " 条记录；" . "共 " . $pages . " 页";
            echo $countpages,"&nbsp;&nbsp;&nbsp;&nbsp;";

            echo "<span id='pagenumber'>$page/$pages</span> "; 
                if($page!=1){ 
                    echo "<a href='countreport.php?page=1'>第一页</a>&nbsp;";
                    echo "<a href='countreport.php?page=".($page-1)."'>上一页</a>&nbsp;";
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
                    echo "<a href='countreport.php?page=".($page+1)."'>下一页</a>&nbsp;";
                    echo "<a href='countreport.php?page=".($pages)."'>最后一页</a>&nbsp;";
                }else { 
                    echo "下一页 ";
                    echo "最后一页"; 
                } 
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
            echo '</div>'; 
        echo "<br><br><br><br><br>";*/

     ?>
</table>

</body>

</html>