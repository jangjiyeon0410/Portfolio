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
	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	//수정글쓰기
	if ($mode=="modify")	//modify넘어오면 수정
	{
    	$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		// $subject = str_replace("'", "&#039;", $subject);
		// $content = str_replace("'", "&#039;", $content);

		$sql = "update greet set subject='$subject', content='$content' where num=$num";
	}
	else	//새글쓰기
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
		//알파벳과 같은 단순 문자를 제외한 모든 기호를 HTML 엔티티로 변환(5가지 문지(",',&,<,>)에 대해서만)
		$content = htmlspecialchars($content);
		// $subject = str_replace("'", "&#039;", $subject);
		// $content = str_replace("'", "&#039;", $content);
	 //  "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)

		$sql = "insert into greet (id, name, nick, subject, content, regist_day, hit, is_html) ";
		$sql .= "values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html')";
	}

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	mysql_close();                // DB 연결 끊기

	echo "
	   <script>
	   location.href = 'list.php?page=$page&listtype=$listtype';
	   alert('등록이 완료되었습니다.');
	   </script>
	";
?>

  
