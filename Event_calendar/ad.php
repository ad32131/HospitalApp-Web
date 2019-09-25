<html>
<head>
		<title> Event Calendar </title>

	<link rel="stylesheet" href="css/master.css" type="text/css" media="screen" charset="utf-8" />
		<script src="js/jquery-1.3.min.js" type="text/javascript"> </script>
		<script src="js/coda.js" type="text/javascript"> </script>
	</head>

	<body>
<?

	$now_year = $_GET['Ya'];
	$now_month = $_GET['Mon'];

	if(!$now_year) $now_year = date('Y');
	if(!$now_month) $now_month = date('m');


// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);

	$nm = str_pad($now_month, 2, "0", STR_PAD_LEFT);
	$sql = "SELECT * FROM `g4_lunartosolar` where `solar_date` LIKE \"$now_year-$nm%\" and `memo` != ''";
	
	$setau = " ";

 $result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result);

for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
   // 반환된 전체 레코드 수 저장.
	
	$setau = $setau. substr($row[solar_date],8,2);
	$setau = $setau. " ";

	}
	
	
	

  // 1. 총일수 구하기
$last_day = date("t", mktime(0, 0, 1, $now_month, 1, $now_year));

    echo  $lastMonthDay ;
// 2. 시작요일 구하기
$start_week = date("w", strtotime(date("$now_year-$now_month")."-01"));

// 3. 총 몇 주인지 구하기
$total_week = ceil(($last_day + $start_week) / 7);

// 4. 마지막 요일 구하기
$last_week = date('w', strtotime(date("$now_year-$now_month")."-".$last_day));

 ?>

   <h1  height="50" align="center" colspan="7">
<?
if($now_month <= 1){

echo "<input id=\"a1\" type=\"button\" style=\"font-size: 30pt; cursor: pointer; \" align=\"left\" value=\"<-\" 
onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/ad.php?Ya=";
echo ($now_year-1);
echo "&Mon=12'\"/>";

}else{

echo "<input id=\"a1\" type=\"button\" style=\"font-size: 30pt; cursor:pointer; \"  align=\"left\" value=\"<-\" 
onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/ad.php?Ya=";
echo ($now_year);
echo "&Mon=";
echo ($now_month-1);
echo "'\" />";

}
?>

  <?echo($now_year);
							echo"년 ";
							echo($now_month);
							echo"월"; ?>
<?
if($now_month >= 12){

echo "<input id=\"a1\" type=\"button\" style=\"font-size: 30pt; cursor: pointer; \"  align=\"right\" value=\"->\" 
onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/ad.php?Ya=";
echo ($now_year+1);
echo "&Mon=1'\"/></p>";

}else{

echo "<input id=\"a1\" type=\"button\" style=\"font-size: 30pt; cursor: pointer; \"   align=\"right\" value=\"->\" 
onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/ad.php?Ya=";
echo ($now_year);
echo "&Mon=";
echo ($now_month+1);
echo "'\" /></p>";

}
?>

</h1>

 <table width='500' cellpadding='0' cellspacing='1' >
   <tr>



	</br>
	
	







   </tr>
   <tr>
     <td height="30" align="center" >일</td>
     <td align="center" >월</td>
     <td align="center" >화</td>
     <td align="center" >수</td>
     <td align="center" >목</td>
     <td align="center" >금</td>
     <td align="center" >토</td>
   </tr>
         
   <?
     // 5. 화면에 표시할 화면의 초기값을 1로 설정
    $day=1;

	// 6. 총 주 수에 맞춰서 세로줄 만들기
    for($i=1; $i <= $total_week; $i++){?>
   <tr>
     <?
	$setau = $setau;
	
          // 7. 총 가로칸 만들기
        for ($j=0; $j<7; $j++){
     ?>
     <td height="30" align="center" class="padding"
       <?
         // 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않아야하므로
        //    그 반대의 경우 -  ! 으로 표현 - 에만 날자를 표시한다.
         if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))){
		
		
		$ppa = str_pad($day, 2, "0", STR_PAD_LEFT);
		$tacd = strpos($setau,$ppa);
		echo $tacd;
			


             if( $tacd != 0){
                 // 공휴일표시
		echo ">";

                 echo "<font color='#FF0000'>";         
             }else if($j == 0){
                 // 9. $j가 0이면 일요일이므로 빨간색
		echo ">";
                echo "<font color='#FF0000'>";
             }else if($j == 6){
                 // 10. $j가 0이면 일요일이므로 파란색
		echo " style=\"cursor: pointer;\"";
		echo "onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/appoit.php?date=";
		echo ($now_year);
		echo "-";

		echo ($now_month);
		echo "-";
		
		$daa = str_pad($day, 2, "0", STR_PAD_LEFT);
		echo($daa);
		echo "'\" >";

                echo "<font color='#0000FF'>";
             }	else{
		
                  // 11. 그외는 평일이므로 검정색
		echo " style=\"cursor: pointer;\"";
		echo "onclick=\"location.href='http://ad32131.net/xe/cont1/Event_calendar/appoit.php?date=";
		echo ($now_year);
		echo "-";

		echo ($now_month);
		echo "-";
		
		$daa = str_pad($day, 2, "0", STR_PAD_LEFT);
		echo($daa);
		echo "'\" >";

                echo "<font color='#000000'>";
             }

	

              // 12. 오늘 날자면 굵은 글씨
            if( ($day == date("j")) and (date('m') == $now_month)){
                 echo "<b>";
             }
             
            // 13. 날자 출력
            echo $day;

            if($day == date("j")){
                 echo "</b>";
             }

            echo "</font>";

           // 14. 날자 증가
            $day++;
		
         }
else{
	echo ">";
}

         ?>
     </td>
     <?}?>
   </tr>
   <?}?>
 </table> 



</body>
</html>
