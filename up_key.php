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
	
	$key = $_GET["key"];

	

	$sql = "DELETE FROM `key_table` WHERE `number` = \"$number\"";	
	$result = mysql_query($sql, $connect);
	echo "de:$result";

	$sql = "SELECT MAX(  `iden` ) AS  `iden` FROM  `key_table`";
	$result = mysql_query($sql, $connect);
  
 
 	$row = mysql_fetch_array($result);
	$id = $row[iden] + 1;
	echo "id:$id";

	$sql = "INSERT INTO `key_table`(`number`,`u_key`,`iden`) VALUES (\"$number\",\"$key\",$id)";
	$result = mysql_query($sql, $connect);
	echo "   $result";
?>