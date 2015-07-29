<?php
header ("content-type:text/html; charset='utf-8'");
date_default_timezone_set('Asia/Yekaterinburg');
$serverName = "82.151.200.222";
$connectionInfo = array( "Database"=>"BCProject", "UID"=>"BcClient", "PWD"=>"client2013");
$connect = sqlsrv_connect($serverName, $connectionInfo);
if($connect === false ) 
	{
	die( print_r( sqlsrv_errors(), true ));
	}
$sql = "SELECT DISTINCT ROUTENAME FROM BCProject.dbo.OUT_CurCarsPos";
$select = sqlsrv_query ($connect, $sql);
while ($tables=sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	foreach ($tables as $key => $value)
		{
		preg_match ("#[0-9]{1,}#",$value,$zn);
		$mar[] = $zn[0];
		}
	}
$Jmar = json_encode($mar);
echo $Jmar;
?>