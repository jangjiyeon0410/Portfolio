<meta charset="utf-8">
<?
@extract($_POST);

   $hp = $hp1."-".$hp2."-".$hp3;
   $email = $email1."@".$email2; 

   $regist_day = date("Y-m-d (H:i)"); 
   $ip = $REMOTE_ADDR;

   include "../lib/dbconn.php"; 

   $sql = "select * from member where id='$id'";
   $result = mysql_query($sql, $connect);
   $exist_id = mysql_num_rows($result);

   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   { 
	  $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level) ";
		$sql .= "values('$id', password('$pass'), '$name', '$nick', '$hp', '$email', '$regist_day', 9)";

		mysql_query($sql, $connect); 
   }

   mysql_close();  
   echo "
	   <script>
     alert('회원가입이 완료되었습니다!');
	    location.href = '../index.html';
	   </script>
	";
?>

   
