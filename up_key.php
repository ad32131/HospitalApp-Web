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