<?
   // �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "db.ad32131.net", "ad32131", "dpem@dnjem2") or  
        die( "SQL server�� ������ �� �����ϴ�.");
 
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("dbad32131",$connect);
 
   // ���� ����
   session_start();
 
	$number = $_GET["number"];

   // ������ ����
   $sql = "select * from `appoint` where `number` = $number";
 
 // ���� ���� ����� $result�� ����
   $result = mysql_query($sql, $connect);

   // ��ȯ�� ��ü ���ڵ� �� ����.
   $total_record = mysql_num_rows($result);
 
   // JSONArray �������� ����� ���ؼ�...
   echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
 
   // ��ȯ�� �� ���ڵ庰�� JSONArray �������� �����.
   for ($i=0; $i < $total_record; $i++)                    
   {
      // ������ ���ڵ�� ��ġ(������) �̵�  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
   echo "{\"number\":\"$row[number]\",\"date\":\"$row[date]\",\"iden\":\"$row[iden]\"}";
 
   // ������ ���ڵ� ������ ,�� ���δ�. �׷��� ������ ������ �Ǵϱ�.  
   if($i<$total_record-1){
      echo ",";
   }
    
   }
   // JSONArray�� ������ �ݱ�
   echo "]}";
?>