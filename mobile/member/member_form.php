<? 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>한국만화영상진흥원 - 회원가입</title>
    
	<link rel="stylesheet" href="./css/member_form.css">
	
    <script
      src="https://kit.fontawesome.com/32507a69fa.js"
      crossorigin="anonymous"
    ></script>
    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/jquery-migrate-1.4.1.min.js"></script>
	
	<script>
	    $(document).ready(function() {

        //정규식체크
        //id 한영 체크
        function onlyEng(objtext1) {
        var inText = objtext1.value;
        var ret;
        for (var i = 0; i < inText.length; i++) {
            ret = inText.charCodeAt(i);  //키보드 키값(아스키코드)
	           //alert(inText.charCodeAt(i));
            // if ((ret < 48) || (ret > 57 && ret < 65) || (ret > 90 && ret < 97)) { // 한글은 허용
           if ((ret > 122) || (ret < 48) || (ret > 57 && ret < 65) || (ret > 90 && ret < 97)) { 
	           // 한글,특수문자 허용않음
            //    alert("영문자와 숫자만을 입력하세요\n\n한글과 특수문자는 안됩니다.");
            $("#loadtext").html("<span>비밀번호를 한번 더 입력하세요.</span>")
               return false;
           }
        }
        return true;
        }


        //id 중복검사
        $("#id").keyup(function() {    // id입력 상자에 id값 입력시
           var id = $('#id').val(); //aaa

           $.ajax({
               type: "POST",
               url: "check_id.php",
               data: "id="+ id,  
               cache: false, 
               success: function(data)   //data에 check_id.php의 에코문(span)이 저장됨 (ajax에선 echo가 return)
               {
                $("#loadtext").html(data);
               }
           });
        });

        //name 유효성검사		 
                $("#name").keyup(function() {    // id입력 상자에 id값 입력시
            var name = $('#name').val();
        
            $.ajax({
                type: "POST",
                url: "check_name.php",
                data: "name="+ name,  
                cache: false, 
                success: function(data)
                {
                     $("#loadtext5").html(data);
                }
            });
        });	
		 
        //nick 중복검사		 
        $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
            var nick = $('#nick').val();
        
            $.ajax({
                type: "POST",
                url: "check_nick.php",
                data: "nick="+ nick,  
                cache: false, 
                success: function(data)
                {
                     $("#loadtext2").html(data);
                }
            });
        });		 

//password 정규식 체크
function fail(){
    $('#pass_confirm').parent().parent('dl').removeClass('success');
    $('#pass_confirm').parent().parent('dl').addClass('fail');
}
function success(){
    $('#pass_confirm').parent().parent('dl').removeClass('fail');
    $('#pass_confirm').parent().parent('dl').addClass('success');
}

$("#pass").keyup(function() {    // id입력 상자에 id값 입력시
            var pass = $('#pass').val();
        
            $.ajax({
                type: "POST",
                url: "check_pass.php",
                data: "pass="+ pass,  
                cache: false, 
                success: function(data)
                {
                     $("#loadtext3").html(data);
                }
            });
        });		 

//password 일치 검사
$("#pass_confirm").keyup(function() {    // id입력 상자에 id값 입력시
    var pass = $('#pass').val();
    var pass_confirm = $('#pass_confirm').val();
    if(!pass_confirm){
        $("#loadtext4").html("<span>비밀번호를 한번 더 입력하세요.</span>")
        fail();
    }
    
    if (pass != pass_confirm)
      {
        $("#loadtext4").html("<span>비밀번호가 일치하지 않습니다.</span>")
        fail();
      }else if(pass = pass_confirm){
        $("#loadtext4").html("<span>비밀번호가 일치합니다.</span>")
        success();
      }
    
});	

// //전화번호 숫자 검사
// $("#hp2").keyup(function() {    // id입력 상자에 id값 입력시
//     var hp2 = $('#hp2').val();
//     let check = /^[0-9]+$/; 
//     if (!check.test(hp2)) {
//         $('#hp2').parent().parent('dl').addClass('fail');
//     }
//     else{
//         $('#h2').parent().parent('dl').removeClass('fail');
//     }
// });		 



});
	</script>
	<script>
 
   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }


      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit(); 
		   // insert.php 로 변수 전송
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
</script>
</head>
<body>
	 <div class="wrap">
     <header>
      <h1>
      <a class="logo" href="../index.html">한국만화영상진흥원 로고</a>
      </h1>
      <a class="back" href="javascript:history.go(-1);"
          ><i class="fas fa-arrow-left"><i>뒤로</i></i></a>
    </header>
	<article id="content">  
	  <h2>회원가입</h2>
      <!-- <ul class="steps">
              <li class="active">약관동의</li>
              <li>정보입력</li>
              <li>가입완료</li>
        </ul> -->
	  <form  name="member_form" method="post" action="insert.php"> 
        <dl>
            <dt><label for="id">아이디</label></dt>
            <dd>
                <input type="text" name="id" id="id" placeholder="komacon123" required maxlength="20">
                <span id="loadtext"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="pass">비밀번호</label></dt>
            <dd>
                <input type="password" name="pass" id="pass" placeholder="****" maxlength="30" required>
                <span id="loadtext3"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="pass_confirm">비밀번호 재확인</label></dt>
            <dd>
            <input type="password" name="pass_confirm" id="pass_confirm" placeholder="****" maxlength="30" required>
            <span id="loadtext4"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="name">이름</label></dt>
            <dd>
                <input type="text" name="name" id="name" placeholder="홍길동" required maxlength="20">
                <span id="loadtext5"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="nick">닉네임</label></dt>
            <dd>
                <input type="text" name="nick" id="nick" placeholder="코마콘" required maxlength="20">
                <span id="loadtext2"></span>
            </dd>
        </dl>
        <dl>
            <dt>휴대전화</dt>
            <dd>
                <label class="hidden" for="hp1">전화번호앞3자리</label>
     			<select class="hp" name="hp1" id="hp1"> 
                    <option value='010'>010</option>
                    <option value='011'>011</option>
                    <option value='016'>016</option>
                    <option value='017'>017</option>
                    <option value='018'>018</option>
                    <option value='019'>019</option>
                </select>
                <span class="dash">-</span>
                <label class="hidden" for="hp2">전화번호중간4자리</label>
                <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="0000" required>
                <span class="dash">-</span>
                <label class="hidden" for="hp3">전화번호끝4자리</label>
                <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="0000" required>
            </dd>
        </dl>
        <dl>
            <dt>이메일</dt>
            <dd>
                <label class="hidden" for="email1">이메일아이디</label>
     			<input type="text" id="email1" name="email1" placeholder="komacon" required>
                <span class="email">@</span>
     			<label class="hidden" for="email2">이메일주소</label>
     			<input type="text" name="email2" id="email2" placeholder="komacon.com" required>
            </dd>
        </dl>
        <ul>
		    <li><a href="#" onclick="reset_form()">취소하기</a></li>
     	    <li><a href="#" onclick="check_input()">가입하기</a></li>
     	</ul>
	 </form>
	  
	</article>
     </div>
</body>
</html>


