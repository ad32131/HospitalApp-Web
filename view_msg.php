﻿<?
// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
   session_start();
 
	$number = $_GET["number"];

   // 쿼리문 생성
   $sql = "select * from `inqnr` where `number` = $number";
 
 // 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);

   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);
 
   // JSONArray 형식으로 만들기 위해서...
   echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
 
   // 반환된 각 레코드별로 JSONArray 형식으로 만들기.
   for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
   echo "{\"lmsg\":\"$row[lmsg]\",\"ldate\":\"$row[ldate]\",\"ltime\":\"$row[ltime]\",\"iden\":\"$row[iden]\",\"rmsg\":\"$row[rmsg]\",\"rdate\":\"$row[rdate]\",\"rtime\":\"$row[rtime]\"}";
 
   // 마지막 레코드 이전엔 ,를 붙인다. 그래야 데이터 구분이 되니깐.  
   if($i<$total_record-1){
      echo ",";
   }
    
   }
   // JSONArray의 마지막 닫기
   echo "]}";
?>