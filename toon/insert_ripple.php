<?
   session_start();
?>
<meta charset="utf-8">
<?

// $table='free'
//$num=1 (부모번호)
//$ripple_content

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
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장


   if ($mode=="modify"){   // 댓글 수정일 때
        
	$sql = "update ripple set content='$ripple_content', regist_day='$regist_day' where num=$ripple_num"; // sql 업데이트문



}
	else{
   // 레코드 삽입 명령
   $sql = "insert into ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";   
	} 
   
   mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
   mysql_close();                // DB 연결 끊기

   echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num&page=$page&scale=$scale&listtype=$listtype';
	   </script>
	";
?>

   
