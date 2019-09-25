<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >





<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>




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
	$idenaa = $_GET["id"];



   // 쿼리문 생성
   $sql = "select * from `inqnr` where `number` = $number order by ldate,ltime";
 
 // 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);

   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);
 
   // JSONArray 형식으로 만들기 위해서...
  


//테이블
	



 
   // 반환된 각 레코드별로 JSONArray 형식으로 만들기.
   for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
	
	

	echo " <table width='70%' cellpaddng='0' cellspacing='1'valign=\"top\" align = \"right\" 
style='float: right' >
	<tr>
		
	</tr>";

	echo "   <div style=\"float:right;\">
    
		<tr valign=\"top\" align = \"right\">
			<td class='msg' style=\"text-align: left\">$row[lmsg]</td>
			<td class='datetime'  width=\"1px\" >$row[ltime]</td>
			
";
	
			
	echo "</tr>
	    </div>";

	if($row[rmsg] != ''){
	echo " <table width='50%' cellpaddng='0' cellspacing='1' valign=\"middle\" align = \"left\" style='float: left'>
	";

	
	

	echo "   <div style=\"float:left;\">
    
		<tr valign=\"middle\" align = \"left\"> 
			<td class='msg' bgcolor=\"Moccasin\" >$row[rmsg]</td>
			<td class='datetime' bgcolor=\"Moccasin\" width=\"1px\">$row[rtime]</td>";
		
	

echo "</tr>
	    </div>";

	//테이블끝
	echo "</table>";
}
	}


	


 
   // 마지막 레코드 이전엔 ,를 붙인다. 그래야 데이터 구분이 되니깐.  
   
    
   
   // JSONArray의 마지막 닫기

	//테이블끝
	echo "</table>";





	 	


	




	
	echo "<form method=\"get\" action=\"upload_msg.php\" >
<input id=\"edt\" type=\"text\" style=\"width:51%; height: 40px\" name=\"rmsg\" />
<input type=\"hidden\" value=\"$idenaa\" name=\"id\"><br/>
<input id=\"Buttonato\" type=\"submit\" value=\"답변등록\"  />
</form>
<button type=\"buttonret\"  onclick=\"location.href='http://ad32131.net/xe/cont1/view.php'\">돌아가기</button>
";





   
?>










</body>

</html>