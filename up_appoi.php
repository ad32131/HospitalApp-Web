<?
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
   session_start();
 

	
	$number = $_GET["number"];	
	
	$date = $_GET["date"];

	

	$sql = "DELETE FROM `appoint` WHERE `number` = \"$number\"";	
	$result = mysql_query($sql, $connect);
	echo "de:$result";

	$sql = "SELECT MAX(  `iden` ) AS  `iden` FROM  `appoint`";
	$result = mysql_query($sql, $connect);
  
 
 	$row = mysql_fetch_array($result);
	$id = $row[iden] + 1;
	echo "id:$id";

	$sql = "INSERT INTO `appoint`(`number`,`date`,`iden`) VALUES (\"$number\",\"$date\",$id)";
	$result = mysql_query($sql, $connect);
	echo "   $result";
?>