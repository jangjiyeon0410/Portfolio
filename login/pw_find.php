<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>한국만화영상진흥원-비밀번호찾기</title>
    <link rel="stylesheet" href="../common/css/common.css" />
<link rel="stylesheet" href="css/login.css">
<script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
<script src="../common/js/jquery-1.12.4.min.js"></script>
<script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
<script>
	$(document).ready(function() {

         $(".find").click(function() {    // id입력 상자에 id값 입력시
            var id = $('.find_id').val(); //green2
            var name = $('.find_name').val(); //홍길동
            var hp1 = $('#hp1').val(); 
            var hp2 = $('#hp2').val(); 
            var hp3 = $('#hp3').val(); 

            $.ajax({
                type: "POST",
                url: "find2.php", /*매개변수인 check_id.php파일을 post방식으로 넘기세요*/
                data: "id="+ id+ "&name="+ name+ "&hp1="+hp1+ "&hp2="+hp2+ "&hp3="+hp3,  /*매개변수id도 같이 넘겨줌*/
                cache: false, 
                success: function(data) /*이 메소드가 완료되면 data라는 변수 안에 echo문이 들어감*/
                {
                     $("#loadtext").html(data); /*span안에 있는 태그를 사용할것이기 때문에 html 함수사용*/
                }
            });
             
        $("#loadtext").addClass('loadtexton');     
        }); 

    });
</script>
</head>
<body>
<div class="wrap">
        <header>
        <h1>
      <a class="logo" href="../index.html"
        >한국만화영상진흥원 로고</a>
      </h1>
        </header>
	    <article id="content">  
	        <h2>비밀번호 찾기</h2>
            <p>가입시 등록한 정보를 입력해주세요.</p>
            <form name="find" method="post" action="find.php"> 
            <div id="id_pw_input">
            <dl>
                    <dt><label for="id">아이디</label></dt>
                    <dd><input type="text" name="id" class="find_input find_id" placeholder="komacon123" require></dd>
                </dl>
                <dl>
                    <dt><label for="name">이름</label></dt>
                    <dd><input type="text" name="name" class="find_input find_name" placeholder="홍길동" require></dd>
                </dl>
                <dl class="phone">
                    <dt>휴대전화</dt>
                    <dd>  
                        <label class="hidden" for="hp1">전화번호앞3자리</label>
     			        <select class="find_input" name="hp1" id="hp1"> 
                            <option value='010'>010</option>
                            <option value='011'>011</option>
                            <option value='016'>016</option>
                            <option value='017'>017</option>
                            <option value='018'>018</option>
                            <option value='019'>019</option>
                        </select>
                        <span class="dash">-</span>
                        <label class="hidden" for="hp2">전화번호중간4자리</label>
                        <input type="text" class="find_input" name="hp2" id="hp2" maxlength="4" placeholder="0000" required>
                        <span class="dash">-</span>
                        <label class="hidden" for="hp3">전화번호끝4자리</label>
                        <input type="text" class="find_input" name="hp3" id="hp3" maxlength="4" placeholder="0000" required>
                    </dd>
                </dl>					
	        </div>
            <div id="button">
                <input type="button" value="비밀번호 찾기" class="find">
            </div>
            <div id="search">
                <span><a href="id_find.php">아이디 찾기</a></span>
                <span><a href="pw_find.php">비밀번호 찾기</a></span>
            </div>
            <div id="join_button">
                <span>아직 회원이 아니신가요?</span><a href="../member/join.html">회원가입</a>
            </div>
            </form>
        </article>
        <span id="loadtext"></span>
    </div>
</body>
</html>