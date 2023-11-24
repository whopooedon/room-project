<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <title>Cube Escape</title>
    <script language="javascript">
    document.title="Cube Escape Game";
    </script>
    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
    
    <meta name="keywords" content="신천 방탈출카페,신림 방탈출카페,홍대 방탈출카페,잠실 방탈출카페,강남 방탈출카페,방탈출카페">
    <meta name="description" content="강남,홍대,잠실,노량진,신림 등 전국 40호점 국내최대 큐브 방탈출 카페">
    <meta property="og:description" content="강남,홍대,잠실,노량진,신림 등 전국 40호점 국내최대 셜록 방탈출 카페">
    <meta name="naver-site-verification" content="90315006b3ecb880974d00ad95d55b4518b7de7b">
        
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="Cube Escape Game 카페">
 
    <link rel="stylesheet" href="css/main.css" type="text/css">

	

	
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
    
<div id="reservation" class="body">
    <section id="title_area">
        <div class="container">
            <h1>예약하기</h1>
            <h4>Reservation</h4>
            <div class="line"></div>
        </div>
    </section>

    <section class="res_info_write">
        <div class="inner container">
		
		
            <div class="write_header">
                <h1>예약 정보 입력</h1>
                <h2>현생탈출에서는 입장시간 24시간 이전에만 환불되며 그후에 예약취소, <br>미방문 시에는 예약금이 환불되지않습니다.</h2>
                <p>( 입금 후 카카오톡, 게시판, 전화 등으로 지점별 입금확인 요청 부탁드립니다. )</p>
            </div>
			
			
<!--  다음 페이지로 넘겨야 할 것들
        branch_seq,theme_number,selectedDate,theme_start
-->
<?php
    $branch_seq = $_GET['branch_seq'];
    $theme_number = $_GET['theme_number'];
    $selectedDate = $_GET['selectedDate'];
    $theme_start = $_GET['theme_start'];
    $st = $_GET['st'];


    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }
    $result = mysqli_query($connect, "SELECT branch_name, branch_phone_number from p_branch where branch_seq = $branch_seq ");
        if($data = mysqli_fetch_array($result)){
           $branch_name = $data['branch_name'];
           $branch_phone_number = $data['branch_phone_number'];
        }
    $result = mysqli_query($connect, "SELECT theme_name, theme_price,right(theme_people,1) as theme_people from p_theme where theme_number = $theme_number ");
        if($data = mysqli_fetch_array($result)){
           $theme_name = $data['theme_name'];
		   $theme_price = $data['theme_price'];
           $theme_people = $data['theme_people'];   // String 타입
         }
         $max_people = (int) $theme_people;

?>





            <form method="get" action="process.php" name="reservationForm" id="reservationForm">
                <input type="hidden" name="branch_seq" value="<?=$branch_seq ?>">
                <input type="hidden" name="theme_number" value="<?= $theme_number ?>">
                <input type="hidden" name="selectedDate" value="<?= $selectedDate ?>">
                <input type="hidden" name="theme_start" value="<?= $theme_start ?>">
                <input type="hidden" name="st" value=<?= $st ?>>

                <input type="hidden" name="bank_name" value="신구은행">
                <input type="hidden" name="bank_num" value="111-222222-33-444">
                <input type="hidden" name="bank_man" value="정의표">



            <div class="write_form">
                <table>
                    
                        <tbody><tr>
                            <th>지점</th>
                            <td><?= $branch_name."(".$branch_phone_number.")"?></td>
                        </tr>
                        <tr>
                            <th>예약일</th>
                            <td><?= $selectedDate ?></td>
                        </tr>
                        <tr>
                            <th>시간</th>
                            <td><?= $theme_start ?></td>
                        </tr>
                        <tr>
                            <th>테마명</th>
                            <td><?= $theme_name ?></td>
                        </tr>
                        <tr>
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
                        <tr>
                            <th>인원</th>
                            <td>
                                <select class="gray" name="people" id="inwon_" onchange="showValue(this)">
<?php
                                for($i=2; $i<=$max_people; $i ++){
?>
                                    <option value="<?= $i ?>"><?= $i ?>명</option>
<?php
                                }
?>


                                </select>
                            </td>
                        </tr>
                        
                                                
                        <tr>
                            <th>가격</th>
                            <td>
							
				                <span id="vprice"><div class="price"><?= $theme_price * 2 ?>원</div></span>
			                    <span id="dc_str" style="display:none;"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>예약방식</th>
                            <td>
                                <div class="ipt_group">
                                
                                	<!-- 이벤트 콜라보 제외 -->
                                	                                
                                      <input name="pay_type" type="radio" class="pay_type" value="1" id="pay_type_1" checked="checked">
                                      <label for="pay_type_1">현장결제</label>
                                      <input name="pay_type" type="radio" class="pay_type" value="2" id="pay_type_2">
                                      <label for="pay_type_2">무통장결제</label>
																
																		
																		
									<!-- 기묘한 팝업 스토어 처리 -->
									
																		
									<!-- 현대 콜라보 처리 -->
									
																		
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>무통장계좌안내</th>
                            <td>신구은행 111-222222-33-444 정의표</td>
                        </tr>
                        <tr>
                            <th>문의사항</th>
                            <td>
                                <textarea name="memo" id="memo" class="ipt gray" rows="6"></textarea>
                            </td>
                        </tr>
                    
                </tbody></table>
                <div class="checktd">
                		                     <div class="fr">
                 			<a class="privacybtn" href="#" id="sitemapFirst">개인정보취급방침</a>
                 		</div>
                    <input type="checkbox" name="agree" id="agree" class="right" value="1">
                    <label for="agree">개인정보취급방침에 동의함</label>
                </div>
            </div>
            <div class="btn_group center">
                <button type="button" class="btn gray" onclick="check()">예약하기</button>
                <a href="javascript:void(0);" class="btn gray2" onclick="window.history.back();">취소</a>
            </div>
            </form>
        </div>
    </section>




<!--개인정보-->
<div class="dim_layer privacy">
<div class="white_area inbox">
  <div class="clear">
    <div class="fl right_box">
      <div class="tit">
      <h1>개인정보취급방침</h1>
    </div>
      <div class="content0">


        <div class="line"></div>
        <div class="tbox">
          <h3>1. 개인정보의 수집·이용 목적, 수집하는 개인정보의 항목 및 수집방법</h3>
          <h2>가. 컨텐츠 제공, 특정 맞춤 서비스 제공, 본인인증</h2>
          <h2>나. 회원관리 </h2>
          <p>회원제 서비스 제공, 개인 식별, "셜록홈즈" 이용약관 위반 회원에 대한 이용제한 조치, 서비스의 원활한 운영에 지장을 미치는 행위 및 서비스 부정이용 행위 제재, 가입의사 확인, 가입 및 가입횟수 제한, 분쟁 조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달, 회원탈퇴의사의 확인 </p>
          <h2>다. 신규 서비스 개발 및 마케팅·광고에의 활용</h2>
          <p>신규 서비스 개발 및 맞춤 서비스 제공, 통계학적 특성에 따른 서비스 제공 및 광고 게재, 서비스의 유효성 확인, 이벤트 정보 및 참여기회 제공, 광고성 정보 제공, 접속빈도 파악, 회원의 서비스 이용에 대한 통계 </p>
          <h2>라. 수집하는 개인정보의 항목 및 수집방법</h2>
          <p><strong>첫째,</strong> 회사는 회원가입, 원활한 고객 상담, 각종 서비스의 제공을 위해 최초 회원가입 당시 아래와 같은 최소한의 개인정보를 필수항목으로 수집하고 있습니다.</p>
          <p class="">[회원가입] - 필수항목 : 아이디, 비밀번호, 이름, 가입인증 휴대폰번호</p>
          <p><strong>둘째,</strong> 서비스 이용과정이나 사업처리 과정에서 아래와 같은 정보들이 자동으로 생성되어 수집될 수 있습니다. <br>- IP Address, 쿠키, 방문 일시, 서비스 이용 기록, 불량 이용 기록, 기기정보 </p>
          <p><strong>셋째,</strong> "셜록홈즈" 아이디를 이용한 부가 서비스 및 맞춤식 서비스 이용 또는 이벤트 응모 과정에서 해당 서비스의 이용자에 한해서만 개인정보 추가 수집이 발생할 수 있으며, 이러한 경우 별도의 동의를 받습니다. </p>
        </div>

        <div class="tbox">
          <h3>2. 개인정보를 제공받는 법인의 정보 전달 및 이용 목적.</h3>
          <p>(주)언리얼컴퍼니 (사업자등록번호 848-81-00487), 상호명 “셜록홈즈” (통신 판매업 2017-서울강남-01467)는 개인정보 수집 및 이용에 대한 안내 정보통신망법 규정에 따라 서비스의 제공을 위해 최소한의 개인정보를 필수항목으로 수집하고 있습니다.</p>
        </div>
        <div class="tbox">
          <h3>3. 개인정보의 보유 및 이용 기간, 개인정보의 파기절차 및 파기방법</h3>
          <p>이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면, 전자적 파일 형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 자동 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다. </p>
          <h2>가. 회사 내부 방침에 의한 정보보유 사유</h2>
          <p>- 부정이용기록(부정가입, 징계기록 등의 비정상적 서비스 이용기록)  <br>
          보존 항목 : 가입인증 휴대폰 번호<br>
          보존 이유 : 부정 가입 및 이용 방지<br>
          보존 기간 : 6개월<br>
          ※ ‘부정이용기록’이란 부정 가입 및 운영원칙에 위배되는 게시글 작성 등으로 인해 회사로부터 이용제한 등을 당한 기록입니다.</p>
          <h2>나. 관련법령에 의한 정보보유 사유</h2>
          <p>상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.</p>
          <p><strong>- 계약 또는 청약철회 등에 관한 기록</strong> <br>
          보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률<br>
          보존 기간 : 5년 <br>
          <strong>- 소비자의 불만 또는 분쟁처리에 관한 기록</strong> <br>
          보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률 <br>
          보존 기간 : 3년 <br>
          <strong>- 웹사이트 방문기록</strong> <br>
          보존 이유 : 통신비밀보호법 <br>
          보존 기간 : 3개월 <br>
          </p>
        </div>
        <div class="tbox">
        <h3>4. 이용자 및 법정대리인의 권리와 그 행사방법</h3>
        <p>이용자들의 개인정보 조회, 수정을 위해서는 '개인정보변경'(또는 '회원정보수정' 등)을 가입해지(동의철회)를 위해서는 "회원탈퇴"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. 혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.</p>
        <p>귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. <br>
        또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다. <br>
        회사는 이용자의 요청에 의해 해지 또는 삭제된 개인정보는 "회사가 수집하는 개인정보의 보유 및 이용기간"에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.</p>
        <p>만 14세 미만 아동의 경우 법정 대리인이 아동의 개인정보를 조회하거나 수정할
        권리, 수집 및 이용 동의를 철회할 권리를 가집니다.</p>
        </div>

        <div class="tbox">
          <h3>5. 수집한 개인정보의 위탁</h3>
          <p>회사는 서비스 이행을 위해 아래와 같은 외부 전문 업체에 위탁하여 운영하고 있습니다. <br>
            위탁 대상자 : (주)셰이퍼 <br>
            -위탁업무 내용 : 웹사이트 및 시스템 관리 (호스팅 / 유지보수)</p>
        </div>

        <div class="tbox">
          <h3>6. 인터넷 접속정보파일 등 개인 정보를 자동으로 수집하는 장치의 설치/운영 및 그 거부에 관한 사항</h3>
          <p>귀하의 정보를 수시로 저장하고 찾아내는 '쿠키(cookie)' 등을 운용합니다. 쿠키란 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다. 회사은(는) 다음과 같은 목적을 위해 쿠키를 사용합니다. </p>
          <h2>- 쿠키 등 사용 목적</h2>
          <p>회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스 제공 귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다.
          따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.
          귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용 하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.</p>
          <h2>- 쿠키 설정 거부 방법</h2>
          <p>쿠키 설정을 거부하는 방법으로는 회원님이 사용하시는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다.</p>
          <h2>- 설정방법</h2>
          <p>예(인터넷 익스플로어의 경우) : 웹 브라우저 상단의 도구 - 인터넷 옵션 - 개인정보 <br>
          단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.</p>
        </div>

        <div class="tbox">
          <h3>7. 개인정보보호에 관한 민원서비스</h3>
          <p>고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다.</p>
          <p>-고객서비스담당 부서 : 운영지원팀 <br>
            -개인정보관리책임자 성명 : 김현승<br>
            -전화번호 : 02-874-0050<br>
            -이메일 : info@unrealcompany.co.kr</p>
          <p>기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.</p>
          <p>1. 개인분쟁조정위원회 (www.1336.or.kr/1336) <br>
            2. 정보보호마크인증위원회 (www.eprivacy.or.kr/02-580-0533~4)<br>
            3. 대검찰청 인터넷범죄수사센터 (http://icic.sppo.go.kr/02-3480-3600)<br>
            4. 경찰청 사이버테러대응센터 (www.ctrc.go.kr/02-392-0330)</p>
        </div>
      </div>
    </div>

    <div class="fr">
      <a class="dim_close" href="#">닫기</a>
    </div>
  </div>

</div>
</div>
<!--개인정보-->
</div>

<?php
    mysqli_close($connect); 
?>


<script type="text/javascript">

function check(){
	if(document.getElementById("name").value == ''){		
		alert('이름을 입력해 주세요.');
		return;
	}
	if(document.getElementById("phone2").value == '' || document.getElementById("phone3").value == ''){
		alert('연락처를 입력해 주세요.');
		return;
	}
    
    const checkbox = document.getElementById('agree');
	const is_checked = checkbox.checked;
	if(is_checked==false){
		alert('개인정보취급방침에 동의해 주세요.');
		return;
	}
    document.getElementById('reservationForm').submit();
}


	const showValue = (target) => {
		const value = target.value;
		const text =  target.options[target.selectedIndex].text;
		var price = <?=$theme_price?>;
		
		document.querySelector(`.price`).innerHTML = `${price*value}원`;
	}

    $(document).ready(function(){
	$('.dim_close').click(function(){
		$("body").css({"position" : "static", "width" : "auto"});
		$('.dim_layer').removeClass('on');
		$('.dim_layer').hide();
	});
	$('.privacybtn').click(function(){
		$('.dim_layer').addClass('on');
		$("body").css({"position" : "fixed", "width" : "100%"});
		$('.privacy').show();
	});

});



</script>


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


</body></html>
