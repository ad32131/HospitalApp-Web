<?


	$max_time = $_POST[max_time];
	$min_time = $_POST[min_time];
	
	if(!$max_time) $max_time=38;
	if(!$min_time) $min_time=18;

// �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server�� ������ �� �����ϴ�.");
 
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("dbad32131",$connect);
 
   // ���� ����
   session_start();

	


	// ������ ����
   $sql = "update `work_time` set min_time=$min_time, max_time=$max_time";
 

 mysql_query($sql, $connect);



echo "<META http-equiv='refresh' content='0;
	url=http://www.ad32131.net/xe/cont1/setting_time1.html'>";
	
	

?>
