<?
    session_start();

    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="ko">
<head> 
<meta charset="utf-8">
<title>한국만화영상진흥원 - 정보수정</title>
<link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="./css/member_form.css">
    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/jquery-migrate-1.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
    
        $("#name").keyup(function() {
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
        $("#nick").keyup(function() {
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
        $("#loadtext4").html("<span>비밀번호가 일치합니다.</span>")
        $('#pass_confirm').parent().parent('dl').removeClass('fail');
        $('#pass_confirm').parent().parent('dl').addClass('success');
    }

    $("#pass").keyup(function() {
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
    $("#pass_confirm").keyup(function() {
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


    });
        </script>
    <script>
    function check_id()
    {
        window.open("check_id.php?id=" + document.member_form.id.value,
            "IDcheck",
            "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
    }

    function check_nick()
    {
        window.open("../member/check_nick.php?nick=" + document.member_form.nick.value,
            "NICKcheck",
            "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
    }

    function check_input()
    {
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
    <?
        include "../lib/dbconn.php";

        $sql = "select * from member where id='$userid'";
        $result = mysql_query($sql, $connect);

        $row = mysql_fetch_array($result);

        $hp = explode("-", $row[hp]);
        $hp1 = $hp[0];
        $hp2 = $hp[1];
        $hp3 = $hp[2];

        $email = explode("@", $row[email]);
        $email1 = $email[0];
        $email2 = $email[1];

        mysql_close();
    ?>
<body>
<div class="wrap">
    <header>
    <h1><a class="logo" href="../index.html">한국만화영상진흥원</a></h1>
    </header>
    <article id="content" class="modify">  
    <h2>나의정보</h2>
    <p>가입 시 등록한 회원정보입니다.</p>
    <form  name="member_form" method="post" action="modify.php">  
        <dl>
            <dt><label for="id">아이디</label></dt>
            <dd>
                <input type="text" name="id" id="id" value="<?= $row[id] ?>" disabled>
            </dd>
        </dl>
        <dl>
            <dt><label for="pass">비밀번호</label></dt>
            <dd>
                <input type="password" name="pass" id="pass" placeholder="******" maxlength="30" required>
                <span id="loadtext3"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="pass_confirm">비밀번호 재확인</label></dt>
            <dd>
            <input type="password" name="pass_confirm" id="pass_confirm" placeholder="******" maxlength="30" required>
            <span id="loadtext4"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="name">이름</label></dt>
            <dd>
                <input type="text" name="name" id="name" placeholder="홍길동" required maxlength="20" value="<?= $row[name] ?>">
                <span id="loadtext5"></span>
            </dd>
        </dl>
        <dl>
            <dt><label for="nick">닉네임</label></dt>
            <dd>
                <input type="text" name="nick" id="nick" placeholder="코마콘" required maxlength="20" value="<?= $row[nick] ?>">
                <span id="loadtext2"></span>
            </dd>
        </dl>
        <dl>
            <dt>휴대전화</dt>
            <dd>
                <label class="hidden" for="hp1">전화번호앞3자리</label>
                <select class="hp" name="hp1" id="hp1"> 
                    <option value='010' <? if($hp1 == '010') echo 'selected'; ?>>010</option>
                    <option value='011' <? if($hp1 == '011') echo 'selected'; ?>>011</option>
                    <option value='016' <? if($hp1 == '016') echo 'selected'; ?>>016</option>
                    <option value='017' <? if($hp1 == '017') echo 'selected'; ?>>017</option>
                    <option value='018' <? if($hp1 == '018') echo 'selected'; ?>>018</option>
                    <option value='019' <? if($hp1 == '019') echo 'selected'; ?>>019</option>
                </select>
                <span class="dash">-</span>
                <label class="hidden" for="hp2">전화번호중간4자리</label>
                <input type="text" class="hp" name="hp2" id="hp2" maxlength="4" placeholder="0000" required value="<?= $hp2 ?>">
                <span class="dash">-</span>
                <label class="hidden" for="hp3">전화번호끝4자리</label>
                <input type="text" class="hp" name="hp3" id="hp3" maxlength="4" placeholder="0000" required value="<?= $hp3 ?>">
            </dd>
        </dl>
        <dl>
            <dt>이메일</dt>
            <dd>
                <label class="hidden" for="email1">이메일아이디</label>
                <input type="text" id="email1" name="email1" placeholder="komacon" required value="<?= $email1 ?>">
                <span class="email">@</span>
                <label class="hidden" for="email2">이메일주소</label>
                <input type="text" name="email2" id="email2" placeholder="komacon.com" required value="<?= $email2 ?>">
            </dd>
        </dl>
        <ul>
            <li><a href="#" onclick="reset_form()">초기화하기</a></li>
            <li><a href="#" onclick="check_input()">수정하기</a></li>
        </ul>
    </form>
    
    </article>
    </div>

</body>
</html>
