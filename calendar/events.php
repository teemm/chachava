<?php
	header("Content-Type:text/html;charset=utf-8");
	include ('config.php');
	include ('codebase/scheduler_connector.php');
	require("codebase/db_mysqli.php");
    $res=mysqli_connect($mysql_server,$mysql_user,$mysql_pass,$mysql_db);
	$scheduler = new schedulerConnector($res, "MySQLi");
	$scheduler->render_table("events","event_id","start_date,end_date,details,fname,procedur,personal,tel,price,pro_date,company_id");
?>
