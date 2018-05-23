<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>发包方评价测试App</title>
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
     <h4>发包方评价测试App</h4>
     <br>
     <?php
        include_once "../common/conn.php";
        $id = $_POST['id'];
        $bugnum = $_POST['bugnum'];
        $remark = $_POST['remark'];
        $str = "bug数：共 " . $bugnum . " 个bug；" . "评价： " . $remark;
     ?>
            <form id="editInfo" name="editInfo" method="post" action="option.php">
                <input type="hidden" name="action" value="summarize"/>
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
                <input type="hidden" name="bugnum" id="bugnum" value="<?php echo $bugnum;?>"/>
                <input type="hidden" name="remark" id="remark" value="<?php echo $remark;?>"/>
                <table>
                    <tr>
                        <td>测试结论</td>
                        <td><textarea readonly rows="3" cols="50" style="width:100%;height:100%;" type="text" value="<?php echo $str?>"/><?php echo $str?></textarea></td>
                    </tr>
                    <tr>
                        <td>优良等级</td>
                        <td><select style="width:100%;height:100%;" id="finegrade" name="finegrade" type="text">
                            <option value="优秀">优秀</option>
                            <option value="良好">良好</option>
                            <option value="一般">一般</option>
                            <option value="不合格">不合格</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>价格</td>
                        <td><input style="width:100%;height:100%;" id="price" name="price" type="text"</td>
                    </tr>
                    <tr>
                        <td>评价</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="evaluate" name="evaluate" type="text"/>无</textarea></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="评价"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>&nbsp;&nbsp;
                            <input type='button' onclick='previouspage()' value='返回'/>
                        </td>
                    </tr>
                </table>
            </form>
</center>
</body>
</html>