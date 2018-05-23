<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>发包方基本信息维护</title>
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
     <h4>维护发包方基本信息</h4>
     <br>
     <?php
        include_once "../common/conn.php";
     ?>
            <form id="editInfo" name="editInfo" method="post" action="option.php">
                <input type="hidden" name="action" value="sender"/>
                <table>
                    <tr>
                        <td>姓名</td>
                        <td><input style="width:100%;height:100%;" id="name" name="name" type="text" /></td>
                    </tr>
                    <tr>
                        <td>年龄</td>
                        <td><input style="width:100%;height:100%;" type="text" name="age" id="age"/></td>
                    </tr>
                    <tr>
                        <td>电话号码</td>
                        <td><input style="width:100%;height:100%;" id="telphone" name="telphone" type="text"/></td>
                    </tr>
                    <tr>
                        <td>行业</td>
                        <td><input style="width:100%;height:100%;" id="trade" name="trade" type="text"/></td>
                    </tr>
                    <tr>
                        <td>单位名称</td>
                        <td><input style="width:100%;height:100%;" id="unitname" name="unitname" type="text"</td>
                    </tr>
                    <tr>
                        <td>职位</td>
                        <td><input style="width:100%;height:100%;" id="postion" name="postion" type="text"</td>
                    </tr>
                    <tr>
                        <td>所在地区</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="area" name="area" type="text"/></textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="保存"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>&nbsp;&nbsp;
                            <input type='button' onclick='previouspage()' value='返回'/>
                        </td>
                    </tr>
                </table>
            </form>
</center>
</body>
</html>