<meta charset="utf-8">
<?
   
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
  

   $fail = "<script>
            $('#id').parent().parent('dl').removeClass('success');
            $('#id').parent().parent('dl').addClass('fail');
            </script>";
   $success = "<script>
               $('#id').parent().parent('dl').removeClass('fail');
               $('#id').parent().parent('dl').addClass('success');;
               </script>";

    if(!$id) 
   {
      echo "
      <span>아이디를 입력하세요.</span>
      {$fail}
      ";
   }
   else if(preg_match("/[^a-z0-9-_]/i", $id))
   {
       echo "
           <span>아이디는 영문, 숫자, -, _ 만 사용할 수 있습니다.</span>
           {$fail}
            ";

   }
   else if(!preg_match("/^[a-z]/i", $id)) {
      echo "
           <span>아이디의 첫글자는 영문이어야 합니다.</span>
           {$fail}
       ";
   }
   else if(strlen($id) <= 8){
      echo "
           <span>아이디는 8자 이상이어야 합니다.</span>
           {$fail}
       ";
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where id='$id' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);


     
      if ($num_record)
      {
       
         echo "
            <span>다른 아이디를 사용하세요.</span>
            {$fail}
         ";
      }
      else
      {
         echo "
            <span>사용가능한 아이디입니다.</span>
            {$success}
         ";
      }
    
 
      mysql_close();
   }

?>

