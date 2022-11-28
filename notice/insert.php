<? session_start(); ?>
<meta charset="utf-8">
<?
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION); 
	
	// 새 글 저장 => post
	// $html_ok='y'
	// $subject='제목글'
	// $content='본문글'

	// 수정 저장 
	// get
	// $mode = modify	//mode가 아닌 num이 넘어오면 수정, 으로 작성할 수 있음(num은 수정시에만 넘어오니까)
	// $num=2
	// post
	// $subject='제목글'
	// $content='본문글'


	if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	if(!$subject) {
		echo("
	   <script>
	     window.alert('제목을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	if(!$content) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장









	// 다중 파일 업로드
	$files = $_FILES["upfile"];
	$count = count($files["name"]);			
	$upload_dir = './data/';

	for ($i=0; $i<$count; $i++)
	{
		$upfile_name[$i]     = $files["name"][$i];
		$upfile_tmp_name[$i] = $files["tmp_name"][$i];
		$upfile_type[$i]     = $files["type"][$i];
		$upfile_size[$i]     = $files["size"][$i];
		$upfile_error[$i]    = $files["error"][$i];
	
		$file = explode(".", $upfile_name[$i]);
		$file_name = $file[0];
		$file_ext  = $file[1];

		if (!$upfile_error[$i])
		{
			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name[$i] = $new_file_name.".".$file_ext;      
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i];

			if( $upfile_size[$i]  > 5000000 ) 	{		//5MB
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(5MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
				exit;
			}

			if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i]) )
			{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}














	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	if ($mode=="modify") 	// 수정일 때
	{
		$num_checked = count($_POST['del_file']);	//3
		$position = $_POST['del_file'];		

		for($i=0; $i<$num_checked; $i++)                      // delete checked item
		{
			$index = $position[$i];		//0 1 2
			$del_ok[$index] = "y";		//del_ok[0]='y' del_ok[1]='y' del_ok[2]='y'
		}

		$sql = "select * from $table where num=$num";   // get target record
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
		{

			$field_org_name = "file_name_".$i;			//file_name		file_name_1		file_name_2
			$field_real_name = "file_copied_".$i;		//file_copied_0		file_copied_1		file_copied_2

			$org_name_value = $upfile_name[$i];			// dog.1jpg
			$org_real_value = $copied_file_name[$i];		//2022_11_@1_12_18_50_01.jpg

			if ($del_ok[$i] == "y")		//삭제 체크된 것은
			{
				$delete_field = "file_copied_".$i;		//file_copied_0
				$delete_name = $row[$delete_field];		//2022_11_21_10_20_15_0.jpg
				
				$delete_path = "./data/".$delete_name;		//	./data/2022_11_21_10_20_15_0.jpg

				unlink($delete_path);		// =>삭제

				$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
			}
			else		//삭제체크 안한 것
			{
				if (!$upfile_error[$i])
				{
					$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
					mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행					
				}
			}

		}
        $subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);

		$sql = "update greet set cat='$cat', subject='$subject', content='$content' where num=$num"; // sql 업데이트문
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}
	else  //새글쓰기
	{
		if ($html_ok=="y")
		{
			$is_html = "y";
		}
		else
		{
			$is_html = "";
		}
		
		$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);
	 	//  "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)

		$sql = "insert into greet (id, name, nick, cat, subject, content, regist_day, hit, is_html) ";

		$sql .= " file_name_0, file_name_1, file_name_2, file_type_0, file_type_1, file_type_2, file_copied_0,  file_copied_1, file_copied_2) ";

		$sql .= "values('$userid', '$username', '$usernick', '$cat', '$subject', '$content', '$regist_day', 0, '$is_html')";
		$sql .= " '$upfile_name[0]', '$upfile_name[1]',  '$upfile_name[2]', '$upfile_type[0]', '$upfile_type[1]',  '$upfile_type[2]', ";
		$sql .= " '$copied_file_name[0]', '$copied_file_name[1]','$copied_file_name[2]')";
	}

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	mysql_close();                // DB 연결 끊기

	echo "
		<script>
			location.href = 'list.php?page=$page&listtype=$listtype';
			alert('등록이 완료되었습니다.')
		</script>
	";
?>

  
