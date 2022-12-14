<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject = $row[subject];
		$item_content = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>고객지원 - 공지사항</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../common/css/sub_common.css">
    <link rel="stylesheet" href="../common/css/sub6_common.css">
    <link rel="stylesheet" href="./css/list.css">
	<script src="https://kit.fontawesome.com/cdd59ed73b.js" crossorigin="anonymous"></script>
    <script src="../common/js/prefixfree.min.js"></script>
	</head>

	<body>
		<? include "../common/sub_header.html" ?>
		<div class="main">
			<img src="./images/sub6_main.jpg" alt="">
			<h3>진흥원소식</h3>
			<span>NOTICE</span>
			</div>
			<div class="subNav">
			<ul>
				<li>
				<a href="../notice/list.php"
					>공지사항<i class="fas fa-circle-notch"></i
				></a>
				</li>
				<li>
				<a class="current" href="./list.php"
					>포토갤러리<i class="fas fa-circle-notch"></i
				></a>
				</li>
				<li>
				<a href="../toon/list.php"
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
				<a href="../notice/list.php"><span>진흥원소식</span></a>
				<i class="fa-solid fa-angle-right"></i>
				<a href="./list.php"><span>포토갤러리</span></a>
				</div>
				<h2>포토갤러리</h2>
				<p>한국만화영상진흥원의 <span>새로운 소식</span>을 전해드립니다.</p>
			</div>
			<div class="contentArea write_modify">
			<?
				if($mode=="modify")		
				{

			?>
				<form  name="board_form" method="post" action="insert.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data"> 

			<?
				}
				else
				{
			?>
				<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data">
			<?
				}
			?>
					<ul>
						<li>
							<dl>
								<dt><label for="nick">닉네임</label></dt>
								<dd><input type="text" name="nick" id="nick" class="disabled_input " value="<?=$usernick?>" disabled=""></dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="subject">제목</label></dt>
								<dd><input type="text" id="subject" name="subject"  value="<?=$item_subject?>" placeholder="제목을 입력해주세요."></dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt>
									<label for="contents">내용</label>
								</dt>
								<?
			if( $userid && ($mode != "modify") )
				{
			?>
								<dd class="check">
									<input type="checkbox" name="html_ok" id="html_ok" value="y">
									<label for="html_ok">HTML 쓰기</label>
								</dd>
			<?
				}
			?>	
								<dd>
									<textarea name="contents" id="contents" placeholder="내용을 입력해주세요."><?=$item_content?></textarea>
								</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="file1">이미지파일1</label></dt>
								<dd>
									<input type="file" id="file1" name="upfile[]">

									<? if ($mode=="modify" && $item_file_0){ ?>
									<div class="delete_ok">
										<span><?=$item_file_0?> 파일이 등록되어 있습니다.</span>
										<div class="check">
											<input type="checkbox" id="del_file1" name="del_file[]" value="0">
											<label for="del_file1">삭제</label>
										</div>
									</div>
									<? } ?>
								</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="file2">이미지파일2</label></dt>
								<dd>
									<input type="file" id="file2" name="upfile[]">
									
									<? if ($mode=="modify" && $item_file_1) {?>
									<div class="delete_ok">
										<span><?=$item_file_1?> 파일이 등록되어 있습니다.</span>
										<div class="check">
											<input type="checkbox" id="del_file2" name="del_file[]" value="1">
											<label for="del_file2">삭제</label>
										</div>
									</div>
									<? } ?>
								</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt><label for="file3">이미지파일3</label></dt>
								<dd>
									<input type="file" id="file3" name="upfile[]">
									
									<? if ($mode=="modify" && $item_file_2){?>
									<div class="delete_ok">
										<span><?=$item_file_2?> 파일이 등록되어 있습니다.</span>
										<div class="check">
											<input type="checkbox" id="del_file3" name="del_file[]" value="2">
											<label for="del_file3">삭제</label>
										</div>
									</div>
									<? } ?>
								</dd>
							</dl>
						</li>
					</ul>

					<div class="button_wrap">
						<a href="list.php?page=<?=$page?>">목록</a>
						<button class="write" type="submit">완료</button>
					</div>
				</form>
			</div>
		</article>
		<? include '../common/sub_footer.html' ?>
	</body>
</html>

