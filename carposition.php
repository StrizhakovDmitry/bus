<?php
header ("content-type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Yekaterinburg');
$serverName = "82.151.200.222";
$connectionInfo = array( "Database"=>"BCProject", "UID"=>"BcClient", "PWD"=>"client2013");
$connect = sqlsrv_connect($serverName, $connectionInfo);
$id = $_GET['id'];
//$id = 1391;
if($connect === false ) 
	{
	die( print_r( sqlsrv_errors(), true ));
	}
$sql = "SELECT AT_COORD  FROM [BCProject].[dbo].[OUT_CurCarsPos]WHERE ID = $id";
$select = sqlsrv_query ($connect, $sql);
while ($tables=sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	foreach ($tables as $key => $value)
		{
		echo $value;
		}
	}