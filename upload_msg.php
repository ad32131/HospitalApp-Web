<?
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
    
   mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
   session_start();
 
	$iden = $_GET["id"];
	$rmsg = $_GET["rmsg"];
	


	function is_euckr($lmsg = NULL)
	{
 	return $lmsg != NULL && mb_detect_encoding($lmsg, 'EUC-KR', true) == 'EUC-KR' ? TRUE : FALSE;
	}

	
	
	$ldate = date('Y-m-d');

	$ltime = date('H:i');

	$sql = "SELECT * FROM  `inqnr` where `iden` = $iden";
	$result = mysql_query($sql, $connect);
	 
 	$row = mysql_fetch_array($result);
	

	if( $row[rmsg] == ''){
	$rmsg = $rmsg ;
	}
	else{
	$rmsg = $row[rmsg] ."\n". $rmsg ;
	}
	$numb	=	$row[number];

	$sql = "update `inqnr` set `rmsg`=\"$rmsg\",`rdate` = \"$ldate\",`rtime` = \"$ltime\" where `iden` = $iden ";
	$result = mysql_query($sql, $connect);
	echo "<META http-equiv='refresh' content='0;
	url=http://www.ad32131.net/xe/cont1/ans.php?number=$numb&id=$iden'>";
?>