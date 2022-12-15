<?
   function latest_article($table, $loop, $char_limit, $char_limit2)
	{
		include "dbconn.php"; 

		$sql = "select * from $table order by num desc limit $loop";  
		$result = mysql_query($sql, $connect);
		while ($row = mysql_fetch_array($result))
		{
			$num = $row[num];
			$len_subject = strlen($row[subject]);
			$cat = $row[cat];
			$subject = $row[subject];
			$content = $row[content];
			$len_content = strlen($row[content]); 

			if ($len_subject > $char_limit)
			{
				$subject = mb_substr($row[subject], 0, $char_limit, 'utf-8');   // 첫번째 문자부터 $char_limit만큼 잘라낸다.
                                                  //mb_substr 은 입력받은 문자열을 정해진 길이만큼 잘라서 리턴하는데 
                                                  //2byte 문자인 한글에 대해서도 처리가 가능한 함수. 

				$subject = $subject."...";
			}

			if ($len_content > $char_limit2)
			{
				$content = mb_substr($row[content], 0, $char_limit2, 'utf-8');

				$content = $content."...";
			}


			$regist_day = substr($row[regist_day], 0, 10);

			if($table=='toon'){
				$file_copied_0 = $row[file_copied_0];
				
				if($file_copied_0){
					echo "
					<li>
						<a href='./toon/view.php?table=toon&num=$num'>
						<dl>
							<dt>&#8249; $subject &#8250;</dt>
							<dd><img src='./toon/data/$file_copied_0' alt='이달의웹툰'></dd>
						</dl>
						</a>
					</li>
					";
				}else{
					echo "
					<li>
						<a href='./toon/view.php?table=toon&num=$num'>
						<dl>
							<dt>&#8249; $subject &#8250;</dt>
							<dd><img src='./toon/data/default.jpg' alt='이달의웹툰'></dd>
						</dl>
						</a>
					</li>
					";
				}
			}
			
			else{
				echo "
				<li>
					<span>$cat</span>
					<a href='./notice/view.php?table=notice&num=$num'>
					<dl>
						<dt>$subject</dt>
						<dd>$content</dd>
						<dd>$regist_day</dd>
					</dl>
					</a>
				</li>
				";
			}
		}
		mysql_close();  
	}
?>
