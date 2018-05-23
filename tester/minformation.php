<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>测试人员基本信息维护</title>
    <style type='text/css'>
        div{
            width: 100%;
            height: 750px;
            background: -webkit-linear-gradient(
                top,blue,lightblue,white
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
     <h4>维护测试人员基本信息</h4>
     <br>
     <?php
        include_once "../common/conn.php";
     ?>
            <form id="editInfo" name="editInfo" method="post" action="option.php">
                <input type="hidden" name="action" value="tester"/>
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
                        <td>学历</td>
                        <td><select style="width:100%;height:100%;" id="education" name="education" type="text">
                            <option value="博士">博士</option>
                            <option value="研究生">研究生</option>
                            <option value="本科生">本科生</option>
                            <option value="本科以下">本科以下</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>专业</td>
                        <td><input style="width:100%;height:100%;" id="major" name="major" type="text"</td>
                    </tr>
                    <tr>
                        <td>账号</td>
                        <td><input style="width:100%;height:100%;" id="account" name="account" type="text"</td>
                    </tr>
                    <tr>
                        <td>测试特长</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="specialty" name="specialty" type="text"/>熟悉PHP</textarea></td>
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
            <br><br><br>
            <a href="/index.php">Copyright©西安工业大学</a>
</center>
</body>
</html>