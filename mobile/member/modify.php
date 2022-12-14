<?
	session_start();

  @extract($_POST);
  @extract($_GET);
  @extract($_SESSION);
?>
<meta charset="utf-8">
<?
   $hp = $hp1."-".$hp2."-".$hp3;
   $email = $email1."@".$email2;

   $regist_day = date("Y-m-d (H:i)");

   include "../lib/dbconn.php";

   $sql = "update member set pass=password('$pass'), name='$name' , ";
   $sql .= "nick='$nick', hp='$hp', email='$email', regist_day='$regist_day' where id='$userid'";

   mysql_query($sql, $connect);
    
    $_SESSION['username'] = $name;
    $_SESSION['usernick'] = $nick;
    


   mysql_close();
   echo "
	   <script>
	     window.alert('회원정보가 수정되었습니다.');
	    location.href = '../index.html';
	   </script>
	";
?>


