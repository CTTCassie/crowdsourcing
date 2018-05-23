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
        $sql = "SELECT `name`, `age`, `telphone`, `education`, `major`, `account`, `specialty`, `timeline` FROM `tester` ORDER BY `tester`.`timeline` desc limit $offset,$rows ";
        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['age'] = $v['age'];
            $data['rows'][$k]['telphone'] = $v['telphone'];
            $data['rows'][$k]['education'] = $v['education'];
            $data['rows'][$k]['major'] = $v['major'];
            $data['rows'][$k]['account'] = $v['account'];
            $data['rows'][$k]['specialty'] = $v['specialty'];
            $data['rows'][$k]['timeline'] = $v['timeline'];
        }
        $sql_count = "SELECT count(*) FROM `tester`";
        $st_count = $pdo->query($sql_count);
        $row_count = $st_count->fetch();
        $data['total'] = $row_count[0];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else {
        $data = array();
        $data['rows'][0]['team'] = "";
        $data['total'] = "";
        $curtime = date('Y-m-d');
        $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
        $rows = (isset($_GET['rows'])) ? intval($_GET['rows']) : 50;
        $sql = "SELECT `name`, `age`, `telphone`, `education`, `major`, `account`, `specialty`, `timeline` FROM `tester` WHERE `education` = '{$_POST['education']}' ORDER BY `tester`.`timeline` desc limit $offset,$rows";
        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['age'] = $v['age'];
            $data['rows'][$k]['telphone'] = $v['telphone'];
            $data['rows'][$k]['education'] = $v['education'];
            $data['rows'][$k]['major'] = $v['major'];
            $data['rows'][$k]['account'] = $v['account'];
            $data['rows'][$k]['specialty'] = $v['specialty'];
            $data['rows'][$k]['timeline'] = $v['timeline'];
        }
        $sql_count = "SELECT  count(*) FROM `tester` WHERE `education` = '{$_POST['team']}'";
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
            $sql = "INSERT INTO `tester`(`name`, `age`,`telphone`, `education`, `major`, `account`, `specialty`, `timeline`) VALUES ('{$_POST['name']}','{$_POST['age']}','{$_POST['telphone']}', '{$_POST['education']}','{$_POST['major']}','{$_POST['account']}','{$_POST['specialty']}','{$_POST['timeline']}' )";
        } else {    //更新数据
            $sql = "UPDATE `tester` SET `name`='{$_POST['name']}', `age`='{$_POST['age']}', `telphone`='{$_POST['telphone']}', `education`='{$_POST['education']}', `major`='{$_POST['major']}', `account`='{$_POST['account']}', `specialty`='{$_POST['specialty']}' WHERE `timeline`='{$_POST['timeline']}'";
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
        $sql = "DELETE FROM `tester` WHERE `timeline`='{$_POST['timeline']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}
?>