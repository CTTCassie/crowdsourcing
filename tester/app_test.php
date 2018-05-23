<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>测试App基本信息录入</title>
    <style type='text/css'>
        div{
            width: 100%;
            height: 750px;
            background: -webkit-linear-gradient(
                top,green,lightgreen,white
            );
        }
    </style>
    <script>
        previouspage = function(){   //返回上一页
            window.history.back(); 
        }
    </script>
</head>
<body>
<center>
     <br><br><br>
     <h4>测试App基本信息录入</h4>
     <br>
     <?php
        include_once "../common/conn.php";
        $id = $_GET['id'];
        $sql = "SELECT * FROM `appinformation` WHERE `id`='{$id}'";
        $stmt = $pdo->query($sql);
        $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
     ?>
            <form id="editInfo" name="editInfo" method="post" action="/sender/summarize.php">
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                <table>
                    <tr>
                        <td>App名称</td>
                        <td><input readonly style="width:100%;height:100%;" id="item" name="item" type="text" value="<?php echo $info['item']?>"/></td>
                    </tr>
                    <tr>
                        <td>统计日期</td>
                        <td><input readonly style="width:100%;height:100%;" id="time" name="time" type="text" value="<?php echo $info['time']?>"/></td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td><textarea readonly rows="3" cols="50" style="width:100%;height:100%;" id="remark" name="remark" type="text" value="<?php echo $info['remark']?>"/><?php echo $info['remark']?></textarea></td>
                    </tr>
                    <tr>
                        <td>bug数</td>
                        <td><input style="width:100%;height:100%;" id="bugnum" name="bugnum" type="text" /></td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="remark" name="remark" type="text"/>无</textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="测试"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>&nbsp;&nbsp;
                            <input type='button' onclick='previouspage()' value='返回'/>
                        </td>
                    </tr>
                </table>
            </form>
</center>
</body>
</html>