<?php
$page = (isset($_GET["page"]) && $_GET["page"]) ? $_GET["page"] : NULL;
$id = (isset($_GET["id"]) && $_GET["id"]) ? $_GET["id"] : NULL;
$pw = (isset($_GET["pw"]) && $_GET["pw"]) ? $_GET["pw"] : NULL;
$_POST['selectedBranch'] =  isset($_POST['selectedBranch']) ? $_POST['selectedBranch'] : '';
$_POST['s_where'] =  isset($_POST['s_where']) ? $_POST['s_where'] : '';

$s_where = $_POST['h'];
if(strlen($s_where) == 0){	
	$s_where = 0;
}else{
	$s_where = $_POST['h'];
}

$connect = mysqli_connect('localhost','root','','project3');
if(mysqli_connect_error()) {
    echo "데이터베이스 연결에 실패하였습니다.";
}

/* --- 자유 게시판의 목록 보기  --- */
if($page == ""){
	$page = 1;                          //페이지 번호가 없으면 페이지번호를 1
}
$view_num = 5;                          //화면에 표시되는 글 목록의 수
$page_num = 3;                          //페이지 링크의 개수
$offset = $view_num * ($page - 1);      //한 페이지에 시작하는 글의 번호
 
$sql = "select count(*) from freeboard_tbl";   //전체 레코드의 개수 구하기
$res = mysqli_query($connect,$sql);

while($row = mysqli_fetch_row($res)){
	$total_no = $row[0];            
}
//전체 레코드의 수를 페이지당 레코드의 수로 나눈 값 올림
$total_page = ceil($total_no / $view_num);   
$cur_num = $total_no - $view_num * ($page - 1);  //현재 레코드의 번호 설정
				
$searchtext = $_POST['s_keyword'];
if(strlen($searchtext) == 0){	
	$res2 = mysqli_query($connect, "select bno,title_board,name,insert_day,count_board,branch_seq from freeboard_tbl order by branch_seq limit $offset, $view_num");
}else{
	if($s_where==1){
		$res2 = mysqli_query($connect, "select bno,title_board,name,insert_day,count_board,branch_seq from freeboard_tbl where name like '%$searchtext%' order by branch_seq  limit $offset, $view_num");
	}else if($s_where==2){
		$res2 = mysqli_query($connect, "select bno,title_board,name,insert_day,count_board,branch_seq from freeboard_tbl where write_board like '%$searchtext%' order by branch_seq limit $offset, $view_num");
	}else{
		$res2 = mysqli_query($connect, "select bno,title_board,name,insert_day,count_board,branch_seq from freeboard_tbl where name like '%$searchtext%' order by branch_seq limit $offset, $view_num");
	}
}

$result1 = mysqli_query($connect, "SELECT branch_name FROM p_branch JOIN freeboard_tbl ON p_branch.branch_seq = freeboard_tbl.branch_seq ORDER BY freeboard_tbl.branch_seq ASC limit $offset, $view_num");

//테이블에서 목록을 쿼리문으로 가져오기
//$sql2 = "select bno,title_board,name,insert_day,count_board from freeboard_tbl order by bno desc limit $offset, $view_num";                                                                                         
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="css/board.css" type="text/css">
			<link rel="stylesheet" href="css/board1.scss" type="text/css">
			<!-- <link rel="stylesheet" href="css/test1.css" type="text/css"> -->
	
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
						<h4>공지사항</h4>
					<div class="line"></div>
				</div>
			</section>

		<section class="board_list">
			<div class="inner container">
				<div id="board_tab">
					<ul>
						<li class="active"><a href="/board/press.php">공지사항</a></li>
					</ul>			
            	</div>
					<div id="board_top">
						<div class="board_info">
							Total:<span><?= $total_no ?></span>, page:<span><?= $page ?>/<?= $total_page ?></span>
						</div>
						<form method="post" action="board.php" name="frm" id="frm">
							<div class="board_search">
								<div class="ipt_group">
									<span class="ipt_left">
										<select name="s_where" id="s_where" onchange="change1()">
											<?php
												if($s_where==0){
											?>
												<option value=0>전체</option>
												<option value=1>제목</option>
												<option value=2>내용</option>
											<?php
												}else if($s_where==1){
											?>	
												<option value=0>전체</option>
												<option value=1 selected>제목</option>
												<option value=2>내용</option>
											<?php
												}else if($s_where==2){
											?>
												<option value=0>전체</option>
												<option value=1>제목</option>
												<option value=2 selected>내용</option>
											<?php
												}
											?>
										</select>
									</span>
				    					<input type="text" class="ipt" name="s_keyword" id="s_keyword" value="">
				    					<span class="ipt_right addon">
										  <button class="btn orange" onclick="change1()">
											<img src="https://raw.githubusercontent.com/dudxoor68/teamProject/main/front/img/search.png" class="ico_zoom_black"></i>
										  </button>
									</span>
								</div>
							</div>										
							<input type="hidden" name="h">
						</form>
			</div>
			<div id="board_list">
				<table class="table">
					<colgroup>
						<col class="num" width="10%">
						<col width="">
						<col width="100px">
						<col width="150px">
						<col class="view" width="10%">
					</colgroup>
					<thead>
						<tr>
							<th class="num">지점</th>
							<th>제목</th>
							<th>작성자</th>
							<th>등록일</th>
							<th class="view">조회</th>
						</tr>
					</thead>
					<tbody>
					<?php
						while($row2 = mysqli_fetch_row($res2)) {
					?>
							<tr>
										<?php
											while($data = mysqli_fetch_array($result1)){
												if($data['branch_name'] == $row2[5]){
										?>
													<td class='num'><?= $data['branch_name'] ?></td>
										<?php
													continue;
												}else{
										?>
													<td class='num'><?= $data['branch_name'] ?></td>
										<?php		
													break;
												}
											}
										?>
								<td class='left title'>
								<a href='board_view.php?branch_seq=<?= $row2[5] ?>&bno=<?= $row2[0] ?>&page=<?= $page ?>&id=<?= $id ?>&pw=<?= $pw ?>'><?= $row2[1] ?></a></td>
								<td class='name'><?=  $row2[2]  ?></td>
								<td class='date'><?=  $row2[3]  ?></td>
								<td class='view'><?=  $row2[4]  ?></td>
							</tr>
					<?php	
						}
					?>	
					</tbody>
					<tr height="25">
						<td colspan="5" align="center">
					<?php
					//$view_num     화면에 표시되는 글 목록의 수
					//$page_num     페이지 링크의 개수
					//$total_no     전체 글 개수
					//$total_page   전체 페이지 수
					//$total_block  페이지 링크의 개수 만큼을 블럭으로 하는 총 블럭 수
					//$block        현재 블럭
					
					$total_block = ceil($total_page / $page_num);
					$block = ceil($page / $page_num);              //현재의 블록
					$first = ($block - 1) * $page_num;             //페이지 블록의 시작하는 첫 페이지 
					$last = $block * $page_num;                    //페이지 블록의 끝 페이지
					
					if($block >= $total_block) {
						$last = $total_page;
					}
					if($block > 1) {
						echo "[<a href='board.php?page=1'>처음</a>]&nbsp;&nbsp;";  //첫 페이지
					}
					if($page > 1) {
						$go_page = $page - 1;
						echo "[<a href='board.php?page=$go_page'>◀</a>]&nbsp;&nbsp;";
					}
					for($page_link=$first+1; $page_link <= $last; $page_link++) {
						// [1] [2] [3] ... 각 페이지 표시
						if($page_link == $page) {
							echo " <font color='red'><b> {$page_link}</b></font> &nbsp;";
						} else {
							echo "[<a href='board.php?page=$page_link'>$page_link</a>]&nbsp;";
						}
					}
					if($total_page > $page) {          //다음 페이지로 이동
						$go_page = $page + 1;
						echo "&nbsp;[<a href='board.php?page=$go_page'>▶</a>]";
					}
					if($block < $total_block) {
						echo "&nbsp;[<a href='board.php?page=$total_page'>끝</a>]";
					}
					mysqli_close($connect);
					?>
					</td>
					</tr>
				</table>
			</div>
	
<?php
if($id=="admin"&&$pw=="1234"){
?>
		<form name="write_botton" method="post" action="board_write.php">
		<div class="btn_group right">
			<input type="submit" name="submit" class="btn black" value=" 글쓰기 ">
		</div>	
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="pw" value="<?php echo $pw; ?>">
		</form>
<?php
}
?>
	
		</div>
	</section>
</div>

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
			
<script type="text/javascript">
		
		function change1(){
			var obj = document.getElementById("s_where");
			for (i=0;i<obj.length;i++ ){
				if(obj[i].selected){
					document.frm.h.value = obj[i].value;
				}
			}
			document.frm.submit();
		}
		
</script>

</body>
</html>