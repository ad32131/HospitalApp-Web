<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >



<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script>
<!--
var isAsc = false;
function sortTable(startRow)
{
    var obj_div   = event.srcElement;

    if( obj_div == null ) return;

    var obj_td    = obj_div;



    while(obj_td.tagName != 'TD' && obj_td.parentNode != null) {
        obj_td = obj_td.parentNode;
    }
 
    var cellNum   = obj_td.cellIndex; 


    //get tr obj;
    var obj_tr    = obj_td;

    while(obj_tr.tagName != 'TR' && obj_tr.parentNode != null) {
        obj_tr = obj_tr.parentNode;
    }

    //get table obj;
    var obj_table = obj_tr;


    while(obj_table.tagName != 'TABLE' && obj_table.parentNode != null) {
        obj_table = obj_table.parentNode;
    }

    var obj_trs = obj_table.rows;

    var obj_tds = obj_tr.cells;


    //get Start Rows
    if(startRow == null){
        for(startRow = 0; obj_trs.length; startRow++) {   
            if(obj_trs[startRow] == obj_tr) break;
        }
        startRow += 1;
    }

    if( isAsc ) {
        for(var i = startRow, max = obj_trs.length; i < max; i++) {
            var tmp_tr0       = obj_trs[i];
            var tmp_tr0_value = getValue(tmp_tr0.cells[cellNum]);
            for(var j = i ; j < max; j++) {
                var tmp_tr1 = obj_trs[j];
                if(tmp_tr0_value > getValue(tmp_tr1.cells[cellNum])) {
                    obj_table.moveRow(j, i);
                    tmp_tr0 = tmp_tr1;
                    tmp_tr0_value = getValue(tmp_tr0.cells[cellNum]);
                }
            }
        }
  isAsc = false;        
    }else if( !isAsc ) {//obj_div.order.toUpperCase() == 'DESC'
        for(var i = startRow, max = obj_trs.length; i < max; i++) {
            var tmp_tr0       = obj_trs[i];
            var tmp_tr0_value = getValue(tmp_tr0.cells[cellNum]);
            for(var j = i ; j < max; j++) {
                var tmp_tr1 = obj_trs[j];
                if(tmp_tr0_value < getValue(tmp_tr1.cells[cellNum])) {
                    obj_table.moveRow(j, i);
                    tmp_tr0 = tmp_tr1;
                    tmp_tr0_value = getValue(tmp_tr0.cells[cellNum]);
                }
            }
        }
  isAsc = true;        
    }
}
function getValue(obj)
{
    var retVal = obj.innerText;
    var objs   = obj.childNodes;
    for(var i = 0, max = objs.length; i < max; i++) {
        var obj = objs[i];
        if( obj.tagName != null && obj.tagName.toUpperCase() == 'INPUT') {
            if( obj.type.toUpperCase() == 'TEXT' ) {
                retVal += obj.value;
            }
        }
    }
    return retVal;
}
//-->
window.onload = function(){
document.getElementById("coc").click();
}

</script>




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
 

	



   // 쿼리문 생성
   $sql = "select * from `inqnr` order by number, iden,rmsg";
 
 // 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);
	$result2 = mysql_query($sql, $connect);
   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);
 
   // JSONArray 형식으로 만들기 위해서...
  


//테이블
	
echo " <table width='100%' cellpaddng='0' cellspacing='1' id=\"tbl\">
	<tr>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=\"500px\">메세지</td>
		<td id =\"coc\" onclick=\"sortTable()\" class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=\"51px\">질문수</td>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=\"70px\">접수일</td>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=\"64px\">전화번호</td>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=\"80px\">답변</td>
		
	</tr>";

echo"	<tr>
		<td class='counsel_head'  style=\"font-size:10; text-align:center;\" width=\"500px\"><form style=\"width: 200px; margin-top: 0px\"  method=\"get\" action=\"del_number.php\"><input id=\"num_add\" name=\"num_add\" maxlength=\"11\" type=\"text\" /><input type=\"submit\" value=\"-\" /></form></td>
		<td id =\"coc\" onclick=\"sortTable()\" class='counsel_head' style=\"font-size:10; text-align:center;\" width=\"51px\"></td>
		<td class='counsel_head'  style=\"font-size:10; text-align:center;\" width=\"70px\"></td>
		<td class='counsel_head'  style=\"font-size:10; text-align:center;\" width=\"64px\"><form style=\"width: 200px; margin-top: 0px\"  method=\"get\" action=\"add_number.php\"><input id=\"num_add\" name=\"num_add\" maxlength=\"11\" type=\"text\" /><input type=\"submit\" value=\"+\" /></form></td>
		<td class='counsel_head' style=\"font-size:10; text-align:center;\" width=\"80px\"></td>
		
	</tr>";



$p = 0;
 $sa=0;
   // 반환된 각 레코드별로 JSONArray 형식으로 만들기.
   for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
	$o = $i+1;
 	mysql_data_seek($result2, $o);     
	$row2 = mysql_fetch_array($result2);

	
	$p++;
	error_reporting(0); 
	
	if( strlen($row[rmsg]) > 1 ){
	$p=0;
	}
	
	if( $row[number] != $row2[number]  ){
	
	if($sa == 0){
	$sa = $sa + 1;
	continue;
		}

echo "   <div style=\"float:left;\">
    
		<tr>";
			
	if(strlen($row[lmsg]) > 31){
	$apaa = mb_substr($row[lmsg],0,31,"UTF-8")."...";
	echo "<td class='counsel_msg'  >$apaa</td>";
	}else{
	echo "<td class='counsel_msg'  >$row[lmsg]</td>";
	}
	

		if($row[rmsg] == ''){
			echo "<td class='counsel_msg'   style=\"font-size:10; text-align:center;font-weight: 900; color: #0000FF \"> $p</td>";
}
		else{
			echo "<td class='counsel_msg'   style=\"font-size:10; text-align:center;\"> 0</td>";
}
		if($row[ltime] > "12:00"){
			
			$apa = substr($row[ldate],5,2)."월".substr($row[ldate],8,2)."일";
		echo   "<td class='counsel_datetime'  >$apa</td>";
		}
		else{
			
			$apa = substr($row[ldate],5,2)."월".substr($row[ldate],8,2)."일";	
		echo   "<td class='counsel_datetime'>$apa</td>";
		}


		echo	"<td class='counsel_number'>$row[number]</td>";
		
 echo "<td class='counsel_datetime'><a href='ans.php?number=$row[number]&id=$row[iden]'><button class='btn-e btn-e-sm btn-e-dark-blue' type='button'>답변</button></a></td>";
	
	$p = 0;

}

			
	echo "</tr>
	    </div>";


 
   // 마지막 레코드 이전엔 ,를 붙인다. 그래야 데이터 구분이 되니깐.  
   if($i<$total_record-1){
      echo "\n";
   }
    
   }
   // JSONArray의 마지막 닫기

	//테이블끝
	echo "</table>";

	


   
?>







</body>

</html>