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

</script>




</head>

<body>


<?
echo " <table width='100%' cellpaddng='0' cellspacing='1' id=\"tbl\">
	<tr>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=20%> </td>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=20%>번호</td>
		<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=20%></td>
        	<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=20%></td>
        	<td class='counsel_head' bgcolor=\"SkyBlue\" style=\"font-size:10; text-align:center;\" width=20%></td>
	
		
	</tr>";

	//오류보고 없애기
	error_reporting(0);

// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);
 
   // 세션 시작
   session_start();
 
	$date = $_GET["date"];


// 쿼리문 생성
   $sql = "SELECT * FROM `work_time`";
 
// 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);

   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);

	mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
	
	
	$max_time = $row[max_time];
	$min_time = $row[min_time];
		
	if(!$max_time) $max_time =48;	
	//테이블 맥스시간 /2

	if(!$min_time) $min_time =0;
	// 테이블 표시시간 /2

   // 쿼리문 생성
   $sql = "select * from `appoint` where `date` like \"$date%\" order by `date` ";
 
// 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);

   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);
 
     // JSONArray 형식으로 만들기 위해서...
   
	echo "<div style=\"float:left;\">";
	$apdate = $date;

     // 반환된 각 레코드별로 JSONArray 형식으로 만들기.
   $i=0 ;              
   
       // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
	
	
	
	for($p=$min_time+1; ($min_time <= $p)&&($p <= $max_time); $p++){
	
	if( ($p%2) ==0 ){

	$aptime = $p/2 -1;
	$aptime = str_pad($aptime, 2, "0", STR_PAD_LEFT);
	$apdate = $date."-".$aptime.":30";

	}else{

	if($p ==1){}
	else{
	$aptime = $p/2;
	$aptime =floor($aptime);
	}
	$aptime = str_pad($aptime, 2, "0", STR_PAD_LEFT);
	$apdate = $date."-".$aptime.":00";

	}
	

	
	

		


	
  $apdate =iconv("euc-kr", "utf-8", $apdate);
	   	 echo "<td>$apdate</td>";  
		

		while($row[date] == $apdate){
		echo "<td>";
		echo "<form style=\"width: 200px\" method=\"get\" action=\"remove_app.php\" >
		<input id=\"date\" name=\"date\" type=\"hidden\" value=\"$apdate\" />
     		<input border:0px id=\"number\" 
         type=\"number\" name=\"number\"  value=";

		echo ($row[number]);
		
		echo " \" readonly=\"readonly\" 
         style=\"border-style: 0; border-width: 0px; width:100px;\" /><input type=\"submit\" value=\"DEL\" /> </form></td>";

		
		$i = $i +1;
		 mysql_data_seek($result, $i); 
		      $row = mysql_fetch_array($result);
		if($i > $total_record){break;}
		
		
		}
		
		echo "<td><form style=\"width: 200px; margin-top: 0px\"  method=\"get\" action=\"add_app.php\">
	<input id=\"date\" name=\"date\" type=\"hidden\" value=\"$apdate\" />
         <input id=\"number \" name=\"number\" maxlength=\"11\" type=\"text\" />
		<input type=\"submit\" value=\"+\" /> </form></td>";
				

		echo "</td>";
		echo "<td></td>";
		echo "</tr>";



	 
		echo "</tr>
	    </div>";
    

    
   }
 


 
echo "</table>";

?>





</body>

</html>