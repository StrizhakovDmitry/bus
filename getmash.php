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
$sql = "SELECT ID, AT_NUM, AT_POSITION, AT_ONFINAL, AT_ONROUTE, ROUTENAME FROM BCProject.dbo.OUT_CurCarsPos";
$select = sqlsrv_query ($connect, $sql);
$i=0;
while ($tables=sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	$a = 0;
	foreach ($tables as $key => $value)
		{
		if ($key == "ROUTENAME")
			{
			preg_match ("#[0-9]{1,}#",$value,$zn);
			$value = $zn[0];
			}
		$arr[$i][$a] = $value;
		$a++;
		}
	$i++;
	}
$Jarr = json_encode($arr);
echo $Jarr;
/*
ID -  ID авто
AT_NUM - номер терминала
AT_TIME - время отправления данных с терминала
SV_TIME - время прихода данных на сервер
AT_COORD - кординаты
AT_SPEED - скорость
AT_VECTOR - направление
AT_POSITION - позиция (0-999999)
AT_ONFINAL - 0 - не на конечной; 1 на конечной А; 2 на конечной Б
AT_ONROUTE -  -1 - не на маршруте; 0 - стоит на конечной, 1 - двигается в сторону А; 2 - двигается в сторону B
ROUTENAME - название маршрута.
ONSTATEBY.
*/
?>
