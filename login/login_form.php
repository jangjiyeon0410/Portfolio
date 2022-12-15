<? session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
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
	        <h2>로그인</h2>
            <p>가입시 등록한 아이디와 비밀번호를 입력해주세요.</p>
            <form  name="member_form" method="post" action="login.php"> 
            <div id="id_pw_input">
                <dl>
                    <dt><label for="id">아이디</label></dt>
                    <dd><input id="id" type="text" name="id" class="login_input" placeholder="komacon123" required></dd>
                </dl>
                <dl>
                    <dt><label for="pass">비밀번호</label></dt>
                    <dd><input id="pass" type="password" name="pass" class="login_input" placeholder="******" required></dd>
                </dl>						
	        </div>
            <div id="login_button">
	        	<button type="submit">로그인</button>
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
    </div>
</body>
</html>