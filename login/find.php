<?
   session_start();
?>
    <meta charset="UTF-8">
<?
  @extract($_GET); 
  @extract($_POST); 
  @extract($_SESSION); 

   if(!$name) {
     echo("
           <script>
             window.alert('이름을 입력하세요');
             history.go(-1);
           </script>
         ");
         exit;
   }

   if(!($hp2 && $hp3)) {
     echo("
           <script>
             window.alert('연락처를 입력하세요');
             history.go(-1);
           </script>
         ");
         exit;
   }


   include "../lib/dbconn.php";

   $sql = "select * from member where name='$name'"; 
   $result = mysql_query($sql, $connect);

   $num_match = mysql_num_rows($result);
   if(!$num_match)
   {
     echo(" 
           <script>
             window.alert('등록되지 않은 이름 입니다');
             history.go(-1);
           </script>
         ");
    }
    else
    {
         $hp = $hp1."-".$hp2."-".$hp3;  // 010-1111-2222
        
		     $row = mysql_fetch_array($result); 
          //$row[id] ,.... $row[level]
         $sql ="select * from member where name='$name' and hp='$hp'";
         $result = mysql_query($sql, $connect);
         $num_match = mysql_num_rows($result);
     
  /* db에 이미 암호화 된 pass를 다시 암호화해서 기존의 pass로 알아낼수 없다,
  암호화된 pass가 입력된 pass의 암호화와 일치하는가를 확인해야함*/

        if(!$num_match)
        {
           echo("
              <script>
                window.alert('등록된 정보가 없습니다');
                history.go(-1);
              </script>
           ");

           exit;
        }
        else
        {
           $userid = $row[id];
           $username = $row[name];
           $userhp = $row[hp];
           $date = $row[regist_day];
            
           echo("
           <script>
           $('#content').css({'display':'none'});
           $('#loadtext').css({'display':'block'});
           </script>
            <p><span>{$username} </span>님의 가입정보입니다.</p>
            <dl>
                <dt>아이디</dt>
                <dd>$userid</dd>
            </dl>
            <dl>
                <dt>이름</dt>
                <dd>$username</dd>
            </dl>
            <dl>
                <dt>휴대전화</dt>
                <dd>$userhp</dd>
            </dl>
            <dl>
                <dt>가입일자</dt>
                <dd>$date</dd>
            </dl>
            <ul>
              <li><a href='./login_form.php'>로그인하기</a></li>
              <li><a href='./pw_find.php'>비밀번호 찾기</a></li>
            </ul>
           ");
        }
   }          
?>
