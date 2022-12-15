<? session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>진흥원소식-공지사항</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../common/css/sub_common.css">
    <link rel="stylesheet" href="../common/css/sub6_common.css">
    <link rel="stylesheet" href="./css/list.css">
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

	if(!$scale)$scale = 8;

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

		$sql = "select * from greet where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from greet order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result);

	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)
		$page = 1;
 

	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
?>
  <body>
    <? include "../common/sub_header.html" ?>
    <div class="main">
      <img src="./images/sub6_main.jpg" alt="">
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
          <a href="../gallery/list.php"
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
              <dt>번호</dt>
              <dd>카테고리</dd>
              <dd>제목</dd>
              <dd>작성자</dd>
              <dd>등록일</dd>
              <dd>조회</dd>
            </dl>
          </li>
<?		
  for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)       
  {
     mysql_data_seek($result, $i);         
     $row = mysql_fetch_array($result);       
  
    $item_num     = $row[num];
    $item_id      = $row[id];
    $item_name    = $row[name];
    $item_content = $row[content];
    $item_nick    = $row[nick];
    $item_cat     = $row[cat];
    $item_hit     = $row[hit]; 
    $item_date    = $row[regist_day];
    $item_date = substr($item_date, 0, 10);
  
   $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
  
?>
          <li class="list_item">
            <dl>
              <dt><?= $number ?></dt>
              <dd><?= $item_cat ?></dd>
              <dd><a href="view.php?num=<?=$item_num?>&page=<?=$page?>&scale=<?=$scale?>&listtype=<?=$listtype?>"><?= $item_subject ?><p><?= $item_content?></p></a></dd>
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
  for ($i=1; $i<=$total_page; $i++)
  {
  if ($page == $i)
  {
  	echo "<b> $i </b>";
  }
  else
								{
									if($mode=="search")
									{
										echo "<span><a href='list.php?page=$i&scale=$scale&listtype=$listtype&mode=search&find=$find&search=$search'>{$i}</a></span>";
									}
									else
									{
										echo "<span><a href='list.php?page=$i&scale=$scale&listtype=$listtype'>{$i}</a></span>";
									}
								}
							}
?>			
        <i class="fas fa-angle-right"></i>
        </div>

        <div class="button_wrap">
				<a href="list.php?page=<?=$page?>&listtype=<?=$listtype?>">목록</a>
						<? if($userid){?>
						<a href="write_form.php?page=<?=$page?>&listtype=<?=$listtype?>" class='write'>글쓰기</a>
						<? } ?>
        </div>
      </div>
    </article>
    <? include "../common/sub_footer.html" ?>
    <?
    if($listtype == 'box'){
      $listtype = 'box';
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
