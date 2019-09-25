<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >



<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<?
$number = $_GET["number"];
$date = $_GET["date"];
$rd = substr($date,0,10);

	if(strlen($number) < 8){
	echo"<script>alert('정상적인 번호가 아닙니다.')</script>";
	echo"<META http-equiv='refresh' content='0;
	url=http://ad32131.net/xe/cont1/Event_calendar/appoit.php?date=$rd'>";
	exit();
	}



 $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);



	$sql = "DELETE  FROM `appoint` where `number` = '$number'";
	
	 $result = mysql_query($sql, $connect);

	$sql = "INSERT INTO `appoint` (`number` ,`date`) VALUES ( '$number', '$date')";
	
	 $result = mysql_query($sql, $connect);

	echo"<script>alert('예약완료.')</script>";
	echo"<META http-equiv='refresh' content='0;
	url=http://ad32131.net/xe/cont1/Event_calendar/appoit.php?date=$rd'>";
?>

</body>

</html>