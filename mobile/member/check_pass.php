<meta charset="utf-8">
<?
   
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
  

   $fail = "<script>
            $('#pass').parent().parent('dl').removeClass('success');
            $('#pass').parent().parent('dl').addClass('fail');
            </script>";
   $success = "<script>
               $('#pass').parent().parent('dl').removeClass('fail');
               $('#pass').parent().parent('dl').addClass('success');;
               </script>";

   $num = preg_match('/[0-9]/u', $pass);
   $eng = preg_match('/[a-z]/u', $pass);
   $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$pass);

    if(!$pass) 
   {
      echo "
      <span>비밀번호를 입력하세요.</span>
      {$fail}
      ";
   }

   else if(strlen($pass) < 10 || strlen($pass) > 30)
    {
      echo "
      <span>비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 10자리 ~ 최대 30자리 이내로 입력하세요.</span>
      {$fail}
      ";
    }
 
   else if(preg_match("/\s/u", $pass) == true)
    {
      echo "
      <span>비밀번호는 공백없이 입력하세요.</span>
      {$fail}
      ";
    }

    else if( $num == 0 || $eng == 0 || $spe == 0)
    {
      echo "
      <span>영문, 숫자, 특수문자를 혼합하여 입력하세요.</span>
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
   

?>

