<?


	$max_time = $_POST[max_time];
	$min_time = $_POST[min_time];
	
	if(!$max_time) $max_time=38;
	if(!$min_time) $min_time=18;

// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
   session_start();

	


	// 쿼리문 생성
   $sql = "update `work_time` set min_time=$min_time, max_time=$max_time";
 

 mysql_query($sql, $connect);



echo "<META http-equiv='refresh' content='0;
	url=http://www.ad32131.net/xe/cont1/setting_time1.html'>";
	
	

?>
