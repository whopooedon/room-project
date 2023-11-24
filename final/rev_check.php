<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <title>Cube Escape</title>
    <script language="javascript">
    document.title="Cube Escape Game";
    </script>
    <link rel="stylesheet" href="css/main.css">
    
        <meta name="keywords" content="Cubs Escape 방탈출 카페">
    <meta name="description" content="전국 40호점 국내최대 Cube Escape 방탈출 카페">
    <meta property="og:description" content="전국 40호점 국내최대 Cube Escape 방탈출 카페">
    <meta name="naver-site-verification" content="90315006b3ecb880974d00ad95d55b4518b7de7b">
        
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="Cube Escape Game 카페">
 
    <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>
    <body>
        <header id="header">
            <div class="inner">
                <div class="header_logo">
                    <a href="/"><img src="https://raw.githubusercontent.com/dudxoor68/teamProject/main/front/img/logo.png"></a>
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
            </div>
        </header>
<div id="reservation" class="body">
	<section id="title_area">
		<div class="container">
			<h1>예약확인</h1>
			<h4>Reservation</h4>
			<div class="line"></div>
		</div>
	</section>

	<section class="res_info_write">
		<div class="inner container">
			<div class="write_header">
				<h1>예약 정보 입력</h1>
				<h2>현생탈출에서는 예약후 24시간 이전에만 환불되며 그후에 예약취소, <br>미방문 시에는 예약금이 환불되지않습니다.</h2>
				<p>( 입금 후 카카오톡, 게시판, 전화 등으로 지점별 입금확인 요청 부탁드립니다. )</p>
			</div>

			<form method="post" action="rev_checked.php" name="reservationConfirmForm" id="reservationConfirmForm">
			<input type="hidden" name="Mode" value="confirmReservation">
			<div class="write_form">
				<table>
					
						<tbody><tr>
							<th>예약자</th>
							<td><input type="text" class="ipt gray" name="name" id="name"></td>
						</tr>
						<tr>
							<th>연락처</th>
							<td>
								<select class="gray" name="phone1" id="phone1" style="width:20px;">
																	<option value="010">010</option>
																	<option value="011">011</option>
																	<option value="016">016</option>
																	<option value="017">017</option>
																	<option value="018">018</option>
																	<option value="019">019</option>
																</select>
								<input type="text" class="ipt gray numField" name="phone2" id="phone2" style="width:48px;" maxlength="4">
								<input type="text" class="ipt gray numField" name="phone3" id="phone3" style="width:48px;" maxlength="4">
							</td>
						</tr>
					
				</tbody></table>
				<div class="em">* 예약시 등록한 정보를 입력하면 예약조회가 가능합니다.<br>* 예약정보는 3일후 삭제됩니다.</div>
			</div>
			<div class="btn_group center">
				<button type="button" class="btn gray" onclick="check()">예약조회</button>
			</div>
			</form>

		</div>
	</section>
	
</div>

<footer id="footer">
                <section class="footer_top">
                    <div class="inner container">
                        <ul class="footer_list">
                            <li><a href="#">개인정보취급방침</a></li>
                            <li><a href="#">이용약관</a></li>
                            <li><a href="branch.php">지점소개</a></li>
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
                               <li><span> 통신판매업 신고 </span> 2023-신구대-212호 </li>
                               <!-- 190926 요청에 따라 연락 이메일 교체 -->
                                <li><span>대표전화</span> 1111.2222  &nbsp;&nbsp;  / &nbsp;&nbsp;  E-mail shingucompany@naver.com<!--info@shingucompany.co.kr--></li>
                            </ul>
                            <div class="copyright">Copyright ⓒ Escape from the Present. All rights reserved.</div>
                        </div>
                            
                </section>
            </footer>

<script>
function check(){
	if(document.getElementById("name").value == ''){		
		alert('이름을 입력해 주세요.');
		return;
	}
	if(document.getElementById("phone2").value == '' || document.getElementById("phone3").value == ''){
		alert('연락처를 입력해 주세요.');
		return;
	}

    document.getElementById('reservationConfirmForm').submit();
}

</script>

</body></html>