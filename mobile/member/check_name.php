<meta charset="utf-8">
<?
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);

   $fail = "<script>
            $('#name').parent().parent('dl').removeClass('success');
            $('#name').parent().parent('dl').addClass('fail');
            </script>";
   $success = "<script>
               $('#name').parent().parent('dl').removeClass('fail');
               $('#name').parent().parent('dl').addClass('success');;
               </script>";


   if(!$name) 
   {
      echo "
      <span>이름을 입력하세요.</span>
      {$fail}
      ";
   }
   else if(!preg_match("/^([a-zA-Z가-힣' ]+)$/",$name))
   {
       echo "
           <span>올바른 이름을 입력해주세요.</span>
           {$fail}
       ";

   }
   else
      {
         echo "
            <span>사용가능한 이름입니다.</span>
            {$success}
         ";
      }
		 
      mysql_close();
?>

