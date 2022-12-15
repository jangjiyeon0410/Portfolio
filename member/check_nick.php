<meta charset="utf-8">
<?
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);

   $fail = "<script>
            $('#nick').parent().parent('dl').removeClass('success');
            $('#nick').parent().parent('dl').addClass('fail');
            </script>";
   $success = "<script>
               $('#nick').parent().parent('dl').removeClass('fail');
               $('#nick').parent().parent('dl').addClass('success');;
               </script>";


   if(!$nick) 
   {
      echo "
      <span>닉네임을 입력하세요.</span>
      {$fail}
      ";
   }
   else if(strpos($nick, ' ') !== false)
   {
       echo "
           <span>닉네임은 공백을 포함할 수 없습니다.</span>
           {$fail}
       ";

   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where nick='$nick' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      if ($num_record)
      {
       
         echo "
            <span>다른 닉네임을 사용하세요.</span>
            {$fail}
         ";
      }
      else
      {
         echo "
            <span>사용가능한 닉네임입니다.</span>
            {$success}
         ";
      }
		 
      mysql_close();
   }
?>

