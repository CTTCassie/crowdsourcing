 <?php
	 try{
	        $pdo = new PDO("mysql:host=localhost;dbname=zbcs;","root","zww");
	    }catch(PDOException $e){
	        die("数据库连接失败".$e->getMessage());
	    }

	    $pdo->query("SET NAMES 'UTF8'");

 ?>