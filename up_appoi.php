<?
// �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server�� ������ �� �����ϴ�.");
 
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("dbad32131",$connect);
 
   // ���� ����
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