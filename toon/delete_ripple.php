<?
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION);

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
