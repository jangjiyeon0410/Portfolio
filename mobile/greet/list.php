<? session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>진흥원소식-공지사항</title>
    <link rel="stylesheet" href="../common/css/common.css" />
    <link rel="stylesheet" href="../common/css/sub_common.css" />
    <link rel="stylesheet" href="./css/sub6_common.css" />
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

	if(!$scale)$scale = 8;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</>
			");
			exit;
		}

		$sql = "select * from greet where $find like '%$search%' order by num desc";	//서치를 포힘하는 $find 변수를 내림차순으로 정렬
	}
	else
	{
		$sql = "select * from greet order by num desc";		//아니면 전체 글목록 내림차순으로 정렬
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수 

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     //10의 배수면(scale이 10일때)
		$total_page = floor($total_record/$scale);      //총페이지개수
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
      <div class="contentArea">
        <div class="serch_wrap">
          <form  name="board_form" method="post" action="list.php?mode=search&listtype=<?=$listtype?>" class="search_form"> 
            <label class="hidden" for="find">검색 카테고리</label>
            <select name="find">
                <option value='subject'>제목</option>
                <option value='content'>내용</option>
                <option value='nick'>별명</option>
                <option value='name'>이름</option>
            </select>
            <label class="hidden" for="search">검색</label>
            <input type="text" name="search" id="search" placeholder="검색어를 입력해주세요">
            <button type="submit">검색</button>
          </form>
        </div>
        <div class="listcount">
          <p>총 <strong><?= $total_record ?></strong> 개의 소식이 있습니다.</p>
          <label class="hidden" for="scale">리스트개수</label>
          <select id="scale" name="scale" onchange="location.href='list.php?scale='+this.value+'&listtype=<?=$listtype?>'">
            <option value=''>보기</option>
            <option value='8'>8</option>
            <option value='12'>12</option>
            <option value='16'>16</option>
            <option value='20'>20</option>
          </select>
          <ul class="list_type list">
            <li><a href="list.php?listtype=list&scale=<?=$scale?>"><i class="fas fa-list-ol"></i></a></li>
						<li><a href="list.php?listtype=box&scale=<?=$scale?>"><i class="fas fa-box"></i></a></li>
          </ul>
        </div>
        <ul class="list_content list">
          <li class="list_title">
            <dl>
              <dd>번호</dd>
              <dt>제목</dt>
              <dd>작성자</dd>
              <dd>등록일</dd>
              <dd>조회</dd>
            </dl>
          </li>
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
    $item_hit     = $row[hit]; 
    $item_date    = $row[regist_day];
    $item_date = substr($item_date, 0, 10);  //0번부터 10자만 뽑아내기
  
   $item_subject = str_replace(" ", "&nbsp;", $row[subject]);	//제목의 공백을 &nbsp로 바꿈
  
?>
          <li class="list_item">
            <dl>
              <dd ><?= $number ?></dd>
              <dt><a href="view.php?num=<?=$item_num?>&page=<?=$page?>&scale=<?=$scale?>&listtype=<?=$listtype?>"><?= $item_subject ?><p><?= $item_content?></p></a></dt>
              <dd><?= $item_nick ?></dd>
              <dd><?= $item_date ?></dd>
              <dd><?= $item_hit ?></dd>
            </dl>
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
										echo "<span><a href='list.php?page=$i&scale=$scale&listtype=$listtype&mode=search&find=$find&search=$search'>{$i}</a></span>";
									}
									else
									{    // 일반 리스트일 때
										echo "<span><a href='list.php?page=$i&scale=$scale&listtype=$listtype'>{$i}</a></span>";
									}
								}
							}
?>			
        <i class="fas fa-angle-right"></i>
        </div>

        <div class="button_wrap">
				<a href="list.php?page=<?=$page?>&listtype=<?=$listtype?>">목록</a>
						<? if($userid){	// 로그인 했을 경우 ?>
						<a href="write_form.php?listtype=<?=$listtype?>" class='active'>글쓰기</a>
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
