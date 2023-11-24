<?php
$bno = $_GET['bno'];
$page = $_GET['page'];
$id = $_GET['id'];
$pw = $_GET['pw'];
$branch_seq = $_GET['branch_seq'];

$connect = mysqli_connect('localhost','root','','project3');
if(mysqli_connect_error()) {
    echo "데이터베이스 연결에 실패하였습니다.";
}
/*--- 테이블의 일련번호(bno) 필드명으로 조회  ---*/
$sql = "select name,title_board,write_board,count_board,insert_day from freeboard_tbl where bno = '$bno' ";
$res = mysqli_query($connect,$sql);

while($row = mysqli_fetch_row($res)){
	$name = $row[0];
    $title_board = $row[1];
	$write_board = $row[2];
	$count_board = $row[3];
	$insert_day = $row[4];
}

//역슬래시 제거
$name = stripslashes($name);
$title_board = stripslashes($title_board); 
$write_board = stripslashes($write_board); 

// 특수문자를 html태그로 변환
$name = htmlspecialchars($name);
$title_board = htmlspecialchars($title_board);
$write_board = htmlspecialchars($write_board);

$write_board = nl2br($write_board);   //줄바꿈을 <br> 처리

//조회 카운터 증가
$sql2 = "update freeboard_tbl set count_board = count_board + 1 where bno = '$bno' ";
mysqli_query($connect,$sql2);
mysqli_close($connect);
?>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<link rel="stylesheet" href="css/board_view.css" type="text/css">
<link rel="stylesheet" href="css/board_view1.css" type="text/css">

</head>
<body>

        <header id="header">
            <div class="inner">
                <div class="header_logo">
                    <a href="main.php"><img src="https://raw.githubusercontent.com/dudxoor68/teamProject/main/front/img/logo.png"></a>
                </div>
                    <nav class="header_nav">
                    <ul class="depth1">
                        <li class="theme">
                            <a href="theme.php">테마</a>
                        </li>
                       <li class="branch">
                            <a href="branch.php">지점소개</a>
                        </li>
                        <li class="board">
                            <a href="board.php">공지사항</a>
                        </li>
                        <li class="reservation active">
                            <a href="reservation.php">예약하기</a>
                        </li>
                    </ul>
            </div>
        </header>

<div id="board" class="body">
	<section id="title_area">
		<div class="container">
			<h1>게시판</h1>
			<h4>board</h4>
			<div class="line"></div>
		</div>
	</section>

	<section class="board_view">
		<div class="inner container">
			<div id="board_view">
				<table class="table">
					
						<tbody>
                        <tr>
							<td class="left view_title">제목:<?php echo $title_board; ?></td>
						</tr>
						<tr>
							<td class="left view_info">
								<ul>
									<li><span>글쓴이:</span><?php echo $name; ?></li>
									<li><span>등록일:</span><?php echo $insert_day; ?></li>
                                    <li><span>조회수:</span><?php echo $count_board; ?></li>
								</ul>
							</td>
						</tr>
						<tr>
							<!-- <td class="left view_contants"><p><br></p><p style="text-align: left;"><img src="/attach/plupload/o_1clge9of1di313jc19luk3ikada.jpg" alt="삼국지 본문.jpg" class="txc-image" style="clear:none;float:none;" /></p><p><br></p></td> -->
							<td class="left"><p><br></p><p style="text-align: left;"><img src="https://raw.githubusercontent.com/dudxoor68/teamProject/main/front/img/qwer.png" alt="삼국지 본문.jpg" class="txc-image" style="clear:none;float:none;"></p><p><br></p><?php echo $write_board; ?></td>
						</tr>
					
				</tbody></table>
			</div>
			<div class="btn_group right">
			<?php
			if($id=="admin"&&$pw=="1234"){
			?>		
					<input type="button" name="btn_update" class="btn gray2" value=" 글수정 "
					onclick="location.href='board_fix.php?bno=<?php echo $bno; ?>
					&page=<?php echo $page; ?>&id=<?php echo $id; ?>&pw=<?php echo $pw; ?>&branch_seq=<?php echo $branch_seq; ?>'">
					<input type="button" name="btn_del" class="btn gray2" value=" 글삭제 "
					onclick="godelete()">
			<?php
			}
			?>
			<a href="board.php?id=<?= $id ?>&pw=<?= $pw ?>" class="btn gray">목록</a>
			</div>
		</div>
	</section>
	<footer id="footer">
                <section class="footer_top">
                    <div class="inner container">
                        <ul class="footer_list">
                            <li><a href="/privacy/personal.php">개인정보취급방침</a></li>
                            <li><a href="/privacy/agreement.php">이용약관</a></li>
                            <li><a href="/branch">지점소개</a></li>
                            <li><a href="http://unreal-company.co.kr">프랜차이즈 가맹문의</a></li>
                        </ul>
                        </div>
                </section>
                <section class="footer_bottom">
                    <div class="inner container">
                        <div class="site_info"> 
                            <ul class="site_info_1">
                                <li><span>상호명</span> 현생탈출</li>
                                <li><span>주소</span> 경기도 성남시 중원구 광명로 377</li>
                            </ul>
                            <ul class="site_info_2">
                               <li><span>(주)현생탈출컴퍼니</span> </li>
                               <li><span> 사업자등록번호</span> 111-22-33333</li>
                               <li><span> 통신판매업 신고 </span> 2023-신구대-412호 </li>
                               <!-- 190926 요청에 따라 연락 이메일 교체 -->
                                <li><span>대표전화</span> 1800.6777  &nbsp;&nbsp;  / &nbsp;&nbsp;  E-mail shingucompany@naver.com<!--info@shingucompany.co.kr--></li>
                            </ul>
                            <div class="copyright">Copyright ⓒ Escape from the Present. All rights reserved.</div>
                        </div>
                    </div>
                </section>
            </footer>
	</div>

<script type="text/javascript">
    function godelete(){
		if(confirm("정말 삭제하시겠습니까?")==true){
			location.href="http://localhost/board/delete_db.php?bno=<?php echo $_GET['bno']?>&page=<?php echo $_GET['page'];?>&id=<?php echo $_GET['id'];?>&pw=<?php echo $_GET['pw'];?>"
		}else{
			return;
		}
    }
</script>

	
</body>
</html>