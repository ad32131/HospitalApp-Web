﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >



<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<?
$number = $_GET["num_add"];

	



 $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);



	$sql = "SELECT * FROM `inqnr` where `number` = '$number'";
	
	 $result = mysql_query($sql, $connect);
	
	$data = mysql_fetch_array($result);
	$isset_check = $data["number"];
	
 	

 if(isset($isset_check)) { 
  echo"<script>alert('추가하려는 전화번호가 이미 존재합니다.')</script>";
	echo"<META http-equiv='refresh' content='0;
	url=http://ad32131.net/xe/cont1/view.php'>";

 } else { 
	$date = date("Y-m-d");
	$date2 = date("H:i");
 	$sql = "INSERT INTO `inqnr` (`lmsg`,`ldate`,`ltime`,`number` ) VALUES ( '무엇이든 질문해주세요.', '$date','$date2','$number')";
	 $result = mysql_query($sql, $connect);
	echo"<META http-equiv='refresh' content='0;
	url=http://ad32131.net/xe/cont1/view.php'>";
 }




?>

</body>

</html>