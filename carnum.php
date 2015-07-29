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
$sql = "SELECT * FROM [BCProject].[dbo].[SRV_CarList]";

$select = sqlsrv_query ($connect, $sql);
//echo $select;
$a = 0;
while ($tables = sqlsrv_fetch_array($select,SQLSRV_FETCH_ASSOC))
	{
	$i = 0;
	foreach ($tables as $key => $value)
		{
		
		//if ($key == "ROUTENAME")
			/*{
			preg_match ("#[0-9]{1,}#",$value,$zn);
			$value = $zn[0];
			echo $value."<br><br><br><br>";
			}*/
		$value = iconv("windows-1251","UTF-8",$value);
		
		$arr[$a][$i] = $value;
		$i++;
		}
	$a++;
	//$tables['GOSNUM'] = iconv("windows-1251","UTF-8", $tables['GOSNUM']);
	//$tables['ROUTENAME'] = iconv("windows-1251","UTF-8", $tables['ROUTENAME']);
	/*echo $key." ";
	echo $value."<br>";*/
	//echo $tables['ID']." ";
	//echo $tables['AT_NUM']." ";
	//echo $tables['GOSNUM']." ";
	//echo $tables['ROUTENAME']."<br> ";
	
	
	
	//print_r ($tables);
	}
$arr = json_encode($arr);
echo($arr);




?>