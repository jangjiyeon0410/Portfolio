<? 
	session_start(); 
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);

	//$num / $page /$scale 

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);       	
	$item_subject     = $row[subject];
	$item_content     = $row[content];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>고객지원 - 공지사항</title>
    <link rel="stylesheet" href="../common/css/common.css" />
    <link rel="stylesheet" href="../common/css/sub_common.css" />
    <link rel="stylesheet" href="./css/sub6_common.css" />
    <link rel="stylesheet" href="./css/list.css" />
	<script src="https://kit.fontawesome.com/cdd59ed73b.js" crossorigin="anonymous"></script>
    <script src="../common/js/prefixfree.min.js"></script>
</head>

<body>
<? include "../common/sub_header.html" ?>
		<div class="main">
			<img src="./images/sub6_main.jpg" alt="" />
			<h3>공지사항</h3>
			<span>NOTICE</span>
		</div>
		<div class="subNav">
			<ul>
				<li>
				<a class="current" href="./list.php"
					>공지사항<i class="fas fa-circle-notch"></i
				></a>
				</li>
				<li>
				<a href="./sub_6_2.html"
					>포토갤러리<i class="fas fa-circle-notch"></i
				></a>
				</li>
				<li>
				<a href="./sub_6_3.html"
					>추천만화<i class="fas fa-circle-notch"></i
				></a>
				</li>
			</ul>
		</div>
		<article id="content">
			<div class="titleArea">
				<div class="lineMap">
				<a href="../index.html"><i class="fas fa-house"></i></a>
				<i class="fa-solid fa-angle-right"></i>
				<a href="./list.php"><span>진흥원소식</span></a>
				<i class="fa-solid fa-angle-right"></i>
				<a href="./list.php"><span>공지사항</span></a>
				</div>
				<h2>공지사항</h2>
				<p>한국만화영상진흥원의 <span>새로운 소식</span>을 전해드립니다.</p>
			</div>
			<div class="contentArea write_modify">
				<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&listtype=<?=$listtype?>">
					<ul class="bbs_write_top">
						<li>
							<dl>
								<dt>닉네임</dt>
								<dd><input type="text" name="nick" id="nick" class="disabled_input " value='<?=$usernick?>' disabled=""></dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="subject">제목</label></dt>
								<dd>
								<input type="text" name="subject" id="subject" value="<?=$item_subject?>">
								</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="content">내용</label></dt>
								<dd>
								<textarea name="content" id="content"><?=$item_content?></textarea>
								</dd>
							</dl>
						</li>
					</ul>
					<div class="button_wrap">
						<a href="list.php?page=<?=$page?>&listtype=<?=$listtype?>">목록</a>
						<button class="write" type="submit" value="완료">완료</button>
					</div>
				</form>
			</div>
        </article>
    <? include '../common/sub_footer.html' ?>

</body>
</html>