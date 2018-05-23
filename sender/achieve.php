<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>发布项目</title>
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
        previouspage = function(){
            window.history.back();
        }
    </script>
</head>
<body>
<center>
     <br><br><br>
     <h4>APP测试</h4>
     <br>
     <?php
        include_once "../common/conn.php";
     ?>
            <form id="editInfo" name="editInfo" method="post" action="option.php">
                <input type="hidden" name="action" value="app_test"/>
                <table>
                    <tr>
                        <td>APP名称</td>
                        <td><input style="width:100%;height:100%;" id="item" name="item" type="text" /></td>
                    </tr>
                    <tr>
                        <td>统计日期</td>
                        <td><input style="width:100%;height:100%;" id='time' name='time' type="date"/></td>
                    </tr>
                    <tr>
                        <td>项目描述</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="describe" name="describe" type="text"/></textarea></td>
                    </tr>
                    <tr>
                        <td>联系电话</td>
                        <td><input style="width:100%;height:100%;" id="telphone" name="telphone" type="text"/></td>
                    </tr>
                    <tr>
                        <td>价格</td>
                        <td><input style="width:100%;height:100%;" id="price" name="price" type="text"/></td>
                    </tr>
                    <tr>
                        <td>有效期</td>
                        <td><input style="width:100%;height:100%;" id="validtime" name="validtime" type="date"</td>
                    </tr>
                    <tr>
                        <td>备注</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="remark" name="remark" type="text"/>无</textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="发布"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>&nbsp;&nbsp;
                            <input type='button' onclick='previouspage()' value='返回'/>
                        </td>
                    </tr>
                </table>
            </form>
</center>
</body>
</html>