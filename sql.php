<html>
<link rel="stylesheet" type="text/css" href="1.css">
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
$sql = "SELECT * FROM BCProject.dbo.OUT_CurCarsPos";
$select = sqlsrv_query ($connect, $sql);
echo "<table><tbody>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>NUM</td>";
echo "<td>AT_TIME</td>";
echo "<td>SERV_TIME</td>";
echo "<td>COORDS</td>";
echo "<td>SPEED</td>";
echo "<td>VECTOR</td>";
echo "<td>POSITION</td>";
echo "<td>ONFINAL</td>";
echo "<td>Чем занят ?</td>";
echo "<td>ROUTENAME</td>";
echo "<td>ONSTATEBY</td>";
echo "</tr>";
while ($tables=sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	echo "<tr>";
	foreach ($tables as $key => $value)
		{
		if ($key == "ROUTENAME")
			{
			preg_match_all('/([0-9]{2,})/', $value, $arr);
			$value = "Маршрут ".$arr[0][0];
			}
		if ($key == "AT_POSITION")
			{
			if (!$value == 0 )$value=($value/10000)."%";
			}
		if ($key == "AT_ONROUTE")
			{
			switch($value)
				{
				case -1: {$value = "<span style='color:gray'>вне маршрута</span>"; 		break;}
				case  0: {$value = "стоит на конечной"; break;}
				case  1: {$value = "едет на конечную";	break;}
				case  2: {$value = "едет с конечной";	break;}
				}
			}
		echo "<td>".$value."</td>";
		}
	echo "</tr>";
	}
echo "<tbody></table>";


?>
</html>