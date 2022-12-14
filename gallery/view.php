<? 
	session_start(); 
	
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION); 

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       

	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];
	

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];

	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];


    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}


	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);		
	

			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";
	mysql_query($sql, $connect);
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
	<script>
		function del(href) 	
		{
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
					document.location.href = href;
			}
		}
	</script>
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
			<div class="contentArea">
				<ul class="view_title">
					<li><?= $item_subject ?></li>
					<li>
						<span><?= $item_nick ?></span>
						<span><?= $item_date ?></span>
						<span><i class="fa-regular fa-eye"><i>조회수</i></i> <?= $item_hit ?></span>
					</li>
				</ul>
				<p class="view_content">
					<?
						for ($i=0; $i<3; $i++)
						{
							if ($image_copied[$i])
							{
								$img_name = $image_copied[$i];
								$img_name = "./data/".$img_name;
								$img_width = $image_width[$i];
								
								echo "<img src='$img_name' width='$img_width' alt=''>"."<br><br>";
							}
						}
					?>
					<?= $item_content ?>
				</p>
				<div class="button_wrap">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
					<? 
						if($userid==$item_id || $userlevel==1 || $userid=="admin")
						{
					?>
					<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>
					<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>
					<?
						}
					?>
					<? 
						if($userid)
						{
					?>
					<a class="write" href="write_form.php?table=<?=$table?>">글쓰기</a>
					<?
						}
					?>
				</div>
			</div>
		</article>
		<? include '../common/sub_footer.html' ?>
	</body>
</html>
