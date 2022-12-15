<?
   session_start();
?>
<meta charset="utf-8">
<?

	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION);
   if(!$userid) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }   
   include "../lib/dbconn.php";

   $regist_day = date("Y-m-d (H:i)"); 


   if ($mode=="modify"){
        
	$sql = "update ripple set content='$ripple_content', regist_day='$regist_day' where num=$ripple_num";



}
	else{

   $sql = "insert into ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";   
	} 
   
   mysql_query($sql, $connect);
   mysql_close();

   echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num&page=$page&scale=$scale&listtype=$listtype';
	   </script>
	";
?>

   
