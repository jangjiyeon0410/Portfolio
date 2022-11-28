<? 
	session_start(); 
	$table = "toon";
?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>진흥원소식-공지사항</title>
    <link rel="stylesheet" href="../common/css/common.css" />
    <link rel="stylesheet" href="../common/css/sub_common.css" />
    <link rel="stylesheet" href="../common/css/sub6_common.css" />
    <link rel="stylesheet" href="./css/list.css" />
    <script
      src="https://kit.fontawesome.com/32507a69fa.js"
      crossorigin="anonymous"
    ></script>
    <script src="../common/js/prefixfree.min.js"></script>
  </head>
<?
	@extract($_GET); 
	@extract($_POST); 
	@extract($_SESSION); 

	include "../lib/dbconn.php";
	$scale=6;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>
<body>

<? include "../common/sub_header.html" ?>
    <div class="main">
      <img src="./images/sub6_main.jpg" alt="" />
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
          <a href="../gallery/list.php"
            >포토갤러리<i class="fas fa-circle-notch"></i
          ></a>
        </li>
        <li>
          <a class="current" href="./list.php"
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
	  <div class="serch_wrap">
          <form  name="board_form" method="post" action="list.php?mode=search&listtype=<?=$listtype?>" class="search_form"> 
            <label class="hidden" for="find">검색 카테고리</label>
            <select name="find">
                <option value='subject'>제목</option>
                <option value='content'>내용</option>
                <option value='nick'>닉네임</option>
                <option value='name'>이름</option>
            </select>
            <label class="hidden" for="search">검색</label>
            <input type="text" name="search" id="search" placeholder="검색어를 입력해주세요">
            <button type="submit">검색</button>
          </form>
        </div>
		<div class="listcount">
          <p>총 <strong><?= $total_record ?></strong> 개의 추천만화가 있습니다.</p>
          <label class="hidden" for="scale">리스트개수</label>
          <select id="scale" name="scale" onchange="location.href='list.php?scale='+this.value+'&listtype=<?=$listtype?>">
            <option value=''>보기</option>
            <option value='6'>6</option>
            <option value='9'>9</option>
            <option value='12'>12</option>
            <option value='15'>15</option>
          </select>
          <ul class="list_type list">
            <li><a href="list.php?listtype=list&scale=<?=$scale?>"><i class="fas fa-list-ol"></i></a></li>
						<li><a href="list.php?listtype=box&scale=<?=$scale?>"><i class="fas fa-box"></i></a></li>
          </ul>
        </div>
        <ul class="list_content list">
		<?		
  for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)          //제일 마지막 페이지 처리         
  {
     mysql_data_seek($result, $i);       
     // 가져올 레코드로 위치(포인터) 이동  
     $row = mysql_fetch_array($result);       
     // 하나의 레코드 가져오기
  
    $item_num     = $row[num];
    $item_id      = $row[id];
    $item_name    = $row[name];
    $item_content = $row[content];
    $item_nick    = $row[nick];
    $item_cat    = $row[cat];
    $item_hit     = $row[hit]; 
    $item_date    = $row[regist_day];
    $item_date = substr($item_date, 0, 10);  //0번부터 10자만 뽑아내기
   $item_subject = str_replace(" ", "&nbsp;", $row[subject]);	//제목의 공백을 &nbsp로 바꿈
  
   $sql = "select * from ripple where parent=$item_num"; // 추가 $item_num=메인게시글의 num
   $result2 = mysql_query($sql, $connect); // 추가
   $num_ripple = mysql_num_rows($result2); // 추가 해당 메인게시글의 댓글의 갯수

   if($row[file_copied_0]){
	    $item_img = './data/'.$row[file_copied_0];
    }
    else{
	    $item_img = './data/default.jpg';
    }

?>
          <li class="list_item">
            <a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&scale=<?=$scale?>&listtype=<?=$listtype?>">
              <div><img src="<?=$item_img?>" alt="썸네일 이미지"></div>
              <dl>
                <dd><?= $item_cat ?></dd>
                <dt><?= $item_subject ?></dt>
                <dd><?=$item_content?></dd>
                <dd><span><?= $item_nick ?></span><span><?= $item_date ?></span><span><i class="fa-regular fa-eye"><i>조회수</i></i> <?= $item_hit ?></span>
                <span>
                <?
											if ($num_ripple){	// 댓글이 있으면
												echo "<i class='fa-regular fa-comment-dots'><i>댓글</i></i>{$num_ripple}";
											}
										?>
                  </span></dd>
              </dl>
            </a>  
          </li>
        <?
  $number--;
}
?>
      </ul>
      <div class="page_num"><i class="fas fa-angle-left"></i>
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
  for ($i=1; $i<=$total_page; $i++)
  {
  if ($page == $i)     // 현재 페이지 번호 링크 안함
  {
  	echo "<b> $i </b>";
  }
  else
	{
		if($mode=="search")	// 검색리스트일 때 (page, scale, mode, find, search)
		{
			echo "<span><a href='list.php?page=$i&scale=$scale&listtype=<?=$listtype?>&mode=search&find=$find&search=$search'>{$i}</a></span>";
		}
		else
		{    // 일반 리스트일 때
			echo "<span><a href='list.php?page=$i&scale=$scale&listtype=<?=$listtype?>'>{$i}</a></span>";
		}
	}
}
?>			
        <i class="fas fa-angle-right"></i>
        </div>

        <div class="button_wrap">
				<a href="list.php?page=<?=$page?>&table=<?=$table?>&scale=<?=$scale?>&listtype=<?=$listtype?>">목록</a>
						<? if($userid){	// 로그인 했을 경우 ?>
						<a href="write_form.php?table=<?=$table?>&page=<?=$page?>&scale=<?=$scale?>&listtype=<?=$listtype?>" class='write'>글쓰기</a>
						<? } ?>
        </div>
      </div>
    </article>
    <? include "../common/sub_footer.html" ?>
    <?
    if($listtype == 'box'){
      $listtype = 'box';	// 리스트 스타일
      echo "
        <script>
          $('.list_content').removeClass('list');
          $('.list_type').removeClass('list');
          $('.list_content').addClass('box');
          $('.list_type').addClass('box');
        </script>
      ";
    }
    ?>
  </body>
</html>