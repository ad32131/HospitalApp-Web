<?
// �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server�� ������ �� �����ϴ�.");
 
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("dbad32131",$connect);
 
   // ���� ����
   session_start();
 
	$lmsg = $_GET["lmsg"];
	function is_euckr($lmsg = NULL)
	{
 	return $lmsg != NULL && mb_detect_encoding($lmsg, 'EUC-KR', true) == 'EUC-KR' ? TRUE : FALSE;
	}
	echo  "$lmsg";
	
	$number = $_GET["number"];	
	
	$ldate = date('Y-m-d');

	$ltime = date('H:i');

	$sql = "SELECT MAX(  `iden` ) AS  `iden` FROM  `inqnr`";
	$result = mysql_query($sql, $connect);
	   
 	$row = mysql_fetch_array($result);
	$id = $row[iden] + 1;

	$sql = "INSERT INTO `inqnr`(`lmsg`, `ldate`, `ltime`, `iden`,  `number`) VALUES ($lmsg,\"$ldate\",\"$ltime\",$id,$number)";
	$result = mysql_query($sql, $connect);
	echo "   $result";
?>