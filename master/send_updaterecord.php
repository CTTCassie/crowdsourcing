<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/conn.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['query'])) {
    if ($_POST['team']=="所有基本信息") {
        $data = array();
        $data['rows'][0]['team'] = "";
        $data['total'] = "";
        $curtime = date('Y-m-d');
        $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
        $rows = (isset($_GET['rows'])) ? intval($_GET['rows']) : 50;
        $offset = ($page - 1) * $rows;
        //`name`, `age`, `telphone`, `trade`, `unitname`, `postion`, `area`, `timeline`, `id`
        $sql = "SELECT `name`, `age`, `telphone`, `trade`, `unitname`, `postion`, `area`, `timeline` FROM `sender` ORDER BY `sender`.`timeline` desc limit $offset,$rows ";
        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['age'] = $v['age'];
            $data['rows'][$k]['telphone'] = $v['telphone'];
            $data['rows'][$k]['trade'] = $v['trade'];
            $data['rows'][$k]['unitname'] = $v['unitname'];
            $data['rows'][$k]['postion'] = $v['postion'];
            $data['rows'][$k]['area'] = $v['area'];
            $data['rows'][$k]['timeline'] = $v['timeline'];
        }
        $sql_count = "SELECT count(*) FROM `sender`";
        $st_count = $pdo->query($sql_count);
        $row_count = $st_count->fetch();
        $data['total'] = $row_count[0];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
if (isset($_POST['flag'])) {
    try {
        $sql = "";
        if ($_POST['flag'] == "insert") {
            $sql = "INSERT INTO `sender`(`name`, `age`, `telphone`, `trade`, `unitname`, `postion`, `area`, `timeline`) VALUES ('{$_POST['name']}','{$_POST['age']}','{$_POST['telphone']}','{$_POST['trade']}','{$_POST['unitname']}','{$_POST['postion']}','{$_POST['area']}', '{$_POST['timeline']}' )";
        } else {    //更新数据
            $sql = "UPDATE `sender` SET `name`='{$_POST['name']}', `age`='{$_POST['age']}', `telphone`='{$_POST['telphone']}', `trade`='{$_POST['trade']}', `unitname`='{$_POST['unitname']}', `postion`='{$_POST['postion']}', `area`='{$_POST['area']}' WHERE `timeline`='{$_POST['timeline']}'";
        }
        $st = $pdo->exec($sql);
        echo $st->rowCount();
    }
    catch(PDOException $ex) {
        echo $sql_inser;
    }
}
if(isset($_POST['del'])){
    try{
        $sql = "DELETE FROM `sender` WHERE `timeline`='{$_POST['timeline']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}
?>