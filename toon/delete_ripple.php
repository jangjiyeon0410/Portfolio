<?
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION);

	// table='free'
	// num=1 (부모번호) => view.php 필요
	// ripple_num=1 (댓글번호)

      include "../lib/dbconn.php";

      $sql = "delete from ripple where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num&page=$page&scale=$scale&listtype=$listtype';
	   </script>
	  ";
?>
