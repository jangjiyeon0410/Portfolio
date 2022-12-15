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
  	$item_cat    = $row[cat];
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
		function check_input()
		{
			if (!document.ripple_form.ripple_content.value)
			{
				alert("내용을 입력하세요!");    
				document.ripple_form.ripple_content.focus();
				return;
			}
			document.ripple_form.submit();
		}

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
				<a class="current" href="../gallery/list.php"
					>포토갤러리<i class="fas fa-circle-notch"></i
				></a>
				</li>
				<li>
				<a href="./list.php"
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
				<a href="./list.php"><span>추천만화</span></a>
				</div>
				<h2>추천만화</h2>
				<p>이달의 <span>추천만화</span>를 지금만나보세요.</p>
			</div>
			<div class="contentArea toon">
				<ul class="view_title">
					<li><?= $item_subject ?></li>
					<li>
						<span><?= $item_nick ?></span>
						<span><?= $item_date ?></span>
						<span><i class="fa-regular fa-eye"><i>조회수</i></i> <?= $item_hit ?></span>
					</li>
				</ul>
				<div class="view_content">
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
				</div>

				<div class="comment_wrap">
					<ul class="commnet_list">
						<?
							$sql = "select * from ripple where parent='$item_num'";
							$ripple_result = mysql_query($sql);

							while ($row_ripple = mysql_fetch_array($ripple_result))
							{
								$ripple_num     = $row_ripple[num];
								$ripple_id      = $row_ripple[id];
								$ripple_nick    = $row_ripple[nick];
								$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
								$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
								$ripple_date    = $row_ripple[regist_day];
						?>
						<li>
							<dl>
								<dt>
									<?=$ripple_nick?>
									<span><?=$ripple_date?></span>
								</dt>
								<dd>
									<p><?=$ripple_content?></p>
									<?  if($userid==$ripple_id || $userlevel==1){	// 관리자, 글쓴이만 수정 가능 ?>
									<div class="comment_modify">
										<form name='ripple_form_modify' method='post' action='insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&ripple_num=<?=$ripple_num?>&mode=modify'>
											<textarea name='ripple_content'><?=$row_ripple[content]?></textarea>
											<a href='#'>수정</a>
										</form>
									</div>
									<? } ?>
								</dd>
							</dl>
							<?  if($userid==$ripple_id || $userlevel==1){	// 관리자, 글쓴이만 삭제 가능 ?>
								<div class='modify_button'>
									<a href='#' class="modify">
										<i class='fas fa-pencil'><i>수정</i></i>
									</a>
									<? 
										if($userlevel==1 || $userid==$ripple_id)
											echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num&listtype=$listtype'>"; 
									?>
									<i class='fas fa-trash-can'><i>삭제</i></i>
									</a>
								</div>
							<? } ?>
						</li>
					<?
						}
					?>
					</ul>

					<form name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&scale=<?=$scale?>&listtype=<?=$listtype?>">
						<ul class="ripple_input">
							<li>
								<?	
									if($userid){
										echo "<textarea placeholder='댓글을 입력하세요.' name='ripple_content'></textarea>";
									} else {
										echo "<textarea placeholder='로그인 후 입력하세요.' name='ripple_content' readonly></textarea>";
									}
								?>
							</li>
							<li><a href="#" onclick="check_input()">등록</a></li>
						</ul>
					</form>
				</div><!-- end of ripple -->
				<div class="button_wrap">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>&listtype=<?=$listtype?>">목록</a>
					<? 
						if($userid==$item_id || $userlevel==1 || $userid=="superadmin")
						
						{
					?>
					<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>&listtype=<?=$listtype?>">수정</a>
					<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>&listtype=<?=$listtype?>')">삭제</a>
					<?
						}
					?>
					<? 
						if($userid)
						{
					?>
					<a class="write" href="write_form.php?table=<?=$table?>&listtype=<?=$listtype?>">글쓰기</a>
					<?
						}
					?>
				</div>
			</div>
		</article>
		<? include '../common/sub_footer.html' ?>

		<script>

			var modify = "<i class='fas fa-pencil'><i>수정</i></i>";
			var cancel = "<i class='fas fa-xmark'><i>취소</i></i>";

			var repple_value;

			// 수정하기
			// let modifyBtn = document.querySelector('.modify');
			// modifyBtn.addEventListener('click', function(e){
			// 	e.preventDefault;
			// 	modifyBtn.
				
			// })
			$(document).on('click', '.modify', function(e){
				e.preventDefault();

				$('.comment_wrap .comment_list li dl dd p').show();
				$('.comment_wrap .comment_list li dl dd .comment_modify').hide();
				$('.comment_wrap .comment_list li .func .modify').html(modify);

				repple_value = $(this).parent().prev().find('dd').find('p').text();
				// console.log(repple_value);

				$(this).parent().prev().find('p').hide();
				$(this).parent().prev().find('.comment_modify').show();
				$(this).parent().prev().find('.comment_modify').find('textarea').html(repple_value);
				// console.log(aaa);

				$(this).html(cancel);
				$(this).removeClass('modify').addClass('cancel');

			});

			// 수정취소		
			$(document).on('click', '.cancel', function(e){
				e.preventDefault();

				$(this).parent().prev().find('p').show();
				$(this).parent().prev().find('.comment_modify').hide();
				$(this).html(modify);
				$(this).removeClass('cancel').addClass('modify');
				
			});

			$(document).on('click', '.comment_modify form a', function(e){
				e.preventDefault();
				var modify_form_name = $(this).parent('form');
				modify_form_name.submit();
			});

		</script>
	</body>
</html>
