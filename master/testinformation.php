<!DOCTYPE html>
<html>
<?php
    session_start();
    include_once "../common/top_bottom.php";
?>
<style>
    .datagrid-header span {
        font-size: 15px !important;
    }s
    .datagrid-header-row {
        Height: 50px;
    }
    #table .datagrid-btable tr {
        height: 35px;
    }
    .datagrid-header-row td {
        font-size: 15px !important;
    }
</style>
<script src="../assert/jquery.self-bd7ddd393353a8d2480a622e80342adf488fb6006d667e8b42e4c0073393abee.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../assert/jquery_ujs.self-784a997f6726036b1993eb2217c9cb558e1cbb801c6da88105588c56f13b466a.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../assert/bootstrap.min.js"></script>
<script src="../assert/jquery-3.2.1.min.self-5c2148f394c0d0085e316066a9ec847d1d5335885c0ab4a32480ad882998ed3f.js?body=1"></script>
<script type="text/javascript" src="../assert/jqueryTime.js"></script>
<script type="text/javascript" src="../assert/jquery-calendarTime.js"></script>
<link rel="stylesheet" type="text/css" href="../assert/css/jquery-calendar.css">
<link rel="stylesheet" type="text/css" href="../assert/css/stylesTime.css">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
<meta name="csrf-param" content="authenticity_token"/>
<meta name="csrf-token"
      content="RUBLbnWo8X3pdUynyA9v8fPStXj6nXmN2+vSkrPQZ+xJUcxZ7i5p3KSOE08g0xCB89VNDFWPKR9P/BwdEgxZ/w=="/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../assert/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="../assert/bootstrap-theme.min.css" crossorigin="anonymous">
<link href="../assert/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../assert/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../assert/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../assert/easyui/locale/easyui-lang-zh_CN.js"></script>
<link rel="stylesheet" href="../assert/easyui/themes/default/easyui.css" type="text/css"/>
<link rel="stylesheet" href="../assert/easyui/themes/icon.css" type="text/css"/>

<script src="../assert/echarts.min.js"></script>
<body>
<body class="easyui-layout">
<div data-options="region:'north',split:true" style="height:60px;"></div>
<div data-options="region:'south',split:true" style="height:60px;"></div>
<div data-options="region:'east',split:true" style="width:60px;"></div>
<div data-options="region:'west',split:true" style="width:60px;"></div>
<div data-options="region:'center',title:'移动应用众包测试系统管理子系统-测试人员'" style="padding:5px;height:90%;background:#eee;">
    <table id="dd" class="easyui-datagrid" toolbar="#tb" style="width:100%;height:100%;font-size:50px">
        <div>
            <select id="customCombobox" class='btn btn-default' style="width:5;height:5;font-size:10px">
                <option value="所有基本信息">所有基本信息</option>
            </select>
            <?php
                $testapp = "window.location.href='/tester/testapp.php'";
                $history = "window.location.href='/tester/history.php'";
                echo "&nbsp;&nbsp;";
                echo "<input type='button' class='btn btn-default' style='width:5;height:5;font-size:10px' onclick=$testapp value='测试APP'/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo "<input type='button' class='btn btn-default' style='width:5;height:5;font-size:10px' onclick=$history value='历史记录'/>";
            ?>
        </div>
    </table>
</div>
</body>


</body>
</html>

<script type="text/javascript" charset="utf-8">
    var datagrid; 
    var editRow = undefined;
    $('#customCombobox').change(function () {
        getdata($("#customCombobox").val());
    });
    function isEndEdit(){    //判断是否结束编辑
        if(editRow == undefined){
            return true;
        }
        if($('#dd').datagrid('validateRow', editRow)){
            $('#dd').datagrid('endEdit', editRow);
            editRow = undefined;
            return true;
        }else{
            return false;
        }
    }

    function GetDateStr(AddDayCount) {
        var dd = new Date();
        dd.setDate(dd.getDate() + AddDayCount);//获取AddDayCount天后的日期
        var y = dd.getFullYear();     //返回表示年份的四位数字
        var m = (dd.getMonth() + 1) < 10 ? "0" + (dd.getMonth() + 1) : (dd.getMonth() + 1);//获取当前月份的日期，不足10补0
        var d = dd.getDate() < 10 ? "0" + dd.getDate() : dd.getDate();//获取当前几号，不足10补0
        var hours = dd.getHours();    //获取系统时
        var minutes = dd.getMinutes();  //获取系统分
        var seconds = dd.getSeconds();  //获取系统秒
        return y + "-" + m + "-" + d + "-" + hours + "-" + minutes + "-" + seconds;
    }
    function getdata(arr) {
        var Address = [
             {"value": "博士","text": "博士"}, 
             {"value": "研究生", "text": "研究生"}, 
             {"value": "本科生", "text": "本科生"}, 
             {"value": "本科以下", "text": "本科以下"}, 
        ];
        var Address1 = [
             {"value": "Java", "text": "Java"}, 
             {"value": "PHP", "text": "PHP"}, 
             {"value": "C++", "text": "C++"}, 
             {"value": "C#", "text": "C#"}, 
             {"value": "Node.js", "text": "Node.js"}, 
        ];
        datagrid = $("#dd").datagrid({
            url: "/master/test_updaterecord.php",  //请求的数据源
            iconCls: 'icon-save', //图标
            fitColumns: true, singleSelect: true,
            pagination: true, //显示分页
            pageSize: 50, //页大小
            pageList: [50, 65, 80, 100], //页大小下拉选项此项各value是pageSize的倍数
            fitColumn: false, //列自适应宽度
            striped: true, //行背景交换
            nowap: true, //列内容多时自动折至第二行
            border: false,
            fitColumns: true,
            pageNumber: 1,
            method: 'post',
            rownumbers: true,
            idField: 'ID', //主键
            columns: [[    //显示的列
                {field: 'Id', title: '编号', checkbox: true, hidden: true},
                {
                    field: 'name',title: '姓名',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'age',title: '年龄',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'telphone',title: '电话号码',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'education',title: '学历类别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'major',title: '专业',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'account',title: '账号',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'specialty',title: '测试特长',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address1, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'timeline', title: '统计日期'
                }
            ]],
            queryParams: {query: "true", team: arr}, //查询参数
            toolbar: [
            
                {
                    text: '增加', iconCls: 'icon-add', handler: function () {
                        var lastLine = $('#dd').datagrid("getRows").length;
                        if (editRow == undefined) {
                            datagrid.datagrid('insertRow', {
                                index: lastLine,   //从最后一条记录插入
                                row: {
                                    timeline: GetDateStr(0)
                                }
                            });
                            datagrid.datagrid('beginEdit', lastLine);
                            editRow = lastLine;
                        }
                    }
                }, '-', {
                        text: '保存',iconCls: 'icon-save',handler: function(){
                        if(isEndEdit()){ 
                            var check = true;
                            var arr;
                            var row = datagrid.datagrid("getChanges", "updated");
                            if (row.length == 0) {
                                row = datagrid.datagrid("getChanges", "inserted");
                                arr = {
                                    "flag": "insert",
                                    "name": row[0].name,
                                    "age": row[0].age,
                                    "telphone": row[0].telphone,
                                    "education": row[0].education,
                                    "major": row[0].major,
                                    "account": row[0].account,
                                    "specialty": row[0].specialty,
                                    "timeline": row[0].timeline
                                }
                            } else {
                                arr = {
                                    "flag": "rowIndex",
                                    "name": row[0].name,
                                    "age": row[0].age,
                                    "telphone": row[0].telphone,
                                    "education": row[0].education,
                                    "major": row[0].major,
                                    "account": row[0].account,
                                    "specialty": row[0].specialty,
                                    "timeline": row[0].timeline
                                }
                            }
                            if (check) {
                                $.ajax({
                                    type: "post",
                                    url: 'test_updaterecord.php',
                                    data: arr,
                                    async: false,
                                    dataType: "json",
                                    success: function (data) {
                                        $("#dd").datagrid('reload');
                                    },
                                    complete: function () {
                                        //请求完成的处理  
                                        alert("基本信息存储成功");
                                        $("#dd").datagrid('reload');
                                    },
                                    error: function (data) {
                                        flag = -1;
                                        $("#dd").datagrid('reload');
                                    }
                                });
                            } else {
                                alert("输入含有非法字符或为空");
                                $("#dd").datagrid('reload');
                            }
                        }
                        editRow = undefined;
                    }
                }, '-', {
                    text: '删除', iconCls: 'icon-remove', handler: function () {
                        var row = $('#dd').datagrid("getSelections","deleted");
                        if(row.length <= 0){
                            alert("您尚未选择要删除的数据");
                        }
                        else{
                            
                            var arr = {
                                "del": "true", 
                                "timeline": row[0].timeline
                            };
                            $.ajax({
                                url: "test_updaterecord.php",  //请求的url地址  
                                dataType: "json",   //返回格式为json
                                async: true,//请求是否异步，默认为异步，这也是ajax重要特性
                                data: arr,    //参数值
                                type: "post",   //请求方式 get 或者post
                                beforeSend: function () {
                                    //请求前的处理  
                                },
                                success: function (req) {
                                    $("#dd").datagrid('reload');
                                },
                                complete: function () {
                                    //请求完成的处理  
                                    alert("基本信息删除成功");
                                    $("#dd").datagrid('reload');
                                },
                                error: function (req) {
                                    //请求出错处理
                                    $("#dd").datagrid('reload');
                                }
                            });
                        }
                        editRow = undefined;    //当删除结束之后清空当前编辑行
                    }
                }, '-', {  
                    text: '取消',iconCls: 'icon-undo',handler: function(){
                        $('#dd').datagrid('rejectChanges');
                        editRow = undefined;
                    }
                }, '-'],
            onClickRow: function (rowIndex, rowData) {
                if (editRow != undefined) {
                    datagrid.datagrid("endEdit", editRow);
                }
                if (editRow == undefined) {
                    datagrid.datagrid("beginEdit", rowIndex);
                    editRow = rowIndex;
                }
            },
            onClickCell: function (rowIndex, field, value) {
                if (editRow != undefined) {
                    datagrid.datagrid("endEdit", editRow);
                    editRow = undefined;
                }
            }
        })
    }
    getdata("所有基本信息");
    
</script>