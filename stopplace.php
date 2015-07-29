<?php
header ("content-type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Yekaterinburg');
$serverName = "82.151.200.222";
$connectionInfo = array( "Database"=>"BCProject", "UID"=>"BcClient", "PWD"=>"client2013");
$connect = sqlsrv_connect($serverName, $connectionInfo);
if($connect === false ) 
	{
	die( print_r( sqlsrv_errors(), true ));
	}
$sql = "SELECT * FROM [BCProject].[dbo].[OUT_BusStops]";



$select = sqlsrv_query ($connect, $sql);



$a = 0;
while ($tables = sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	$b=1;
	$arr[$a][0] = $a;
	foreach ($tables as $key => $value)
		{
		$value = iconv("windows-1251","UTF-8",$value);

		$arr[$a][$b] = $value;
		$b++;
		if ($b == 3)
			{
			preg_match("#[0-9]{1,}#", $value, $zn);
			$arr[$a][$b] = $zn;
			}
		}
	$a++;
	}
$Jmar = json_encode($arr);
echo $Jmar;