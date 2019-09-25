<?php

// 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server에 연결할 수 없습니다.");
 
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("dbad32131",$connect);


	$number = $_POST["number"];
	$number = str_pad($number, 11, "01", STR_PAD_LEFT); 
	
	
	$From =	$_POST["content"];
	function is_euckr($From = NULL)
	{
 	return $From != NULL && mb_detect_encoding($From, 'EUC-KR', true) == 'EUC-KR' ? TRUE : FALSE;
	}


	$data = $_POST["data"];
	function is_euckr2($data = NULL)
	{
 	return $data != NULL && mb_detect_encoding($data, 'EUC-KR', true) == 'EUC-KR' ? TRUE : FALSE;
	}

	echo $number;
	echo " ";
	echo $From;
	echo " ";
	echo $data;

 	$sql = "SELECT  `u_key` FROM `key_table`  WHERE `number` = $number";

	// 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);


   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);

      $row = mysql_fetch_array($result);

	echo $row[u_key];
 
    // 헤더 부분
    $headers = array(
            'Content-Type:application/json',
            'Authorization:key=AIzaSyAVZGvQBUFVrT0_Hy6YHnbVVWeWuuoXzC8'
            );
 
    // 푸시 내용, data 부분을 자유롭게 사용해 클라이언트에서 분기할 수 있음.
    $arr = array();
    $arr['data'] = array();
    $arr['data']['From'] = $From;
    $arr['data']['data'] = $data;
    $arr['registration_ids'] = array();
    $arr['registration_ids'][0] = $row[u_key];

		
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arr));

	
	
    $response = curl_exec($ch);
    curl_close($ch);
 
	
	

    // 푸시 전송 결과 반환.
    $obj = json_decode($response);
 

    // 푸시 전송시 성공 수량 반환.
    $cnt = $obj->{"success"};
 
    echo $cnt;

?>