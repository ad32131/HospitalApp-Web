<?
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
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