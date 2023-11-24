<html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <!--<title>SHERLOCK HOLMES - 셜록홈즈 방탈출 게임</title>-->
    <title>Cube Escape</title>
    <script language="javascript">
    document.title="Cube Escape - 큐브형식의 방 탈출 게임";
    </script>
    	<script  src="http://code.jquery.com/jquery-latest.min.js"></script>

    <link rel="stylesheet" href="css/board.css" type="text/css">
	<link rel="stylesheet" href="css/board1.scss" type="text/css">
	<link rel="stylesheet" href="css/main.css" type="text/css">
    
    <meta name="keywords" content="신천 방탈출카페,신림 방탈출카페,홍대 방탈출카페,잠실 방탈출카페,강남 방탈출카페,방탈출카페">
    <meta name="description" content="강남,홍대,잠실,노량진,신림 등 전국 40호점 국내최대 셜록 방탈출 카페">
    <meta property="og:description" content="강남,홍대,잠실,노량진,신림 등 전국 40호점 국내최대 셜록 방탈출 카페">
    <meta name="naver-site-verification" content="90315006b3ecb880974d00ad95d55b4518b7de7b">
        
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="현생탈출 방탈출 카페">
 
    
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
		
<div id="board" class="body">
	<section id="title_area">
		<div class="container">
			<h1>예약조회</h1>
			<h4>Reservation</h4>
			<div class="line"></div>
		</div>
	</section>

	<section class="board_list">
		<div class="inner container">
			<div id="board_tab">

				<form method="get" action="/board/press.php" name="frm" id="frm">
				</form>
			</div>
			<div id="board_list">
				<table class="table">
					<colgroup>
						<col class="num" width="10%">
						<col width="">
						<col width="100px">
						<col width="100px">
						<col class="view" width="10%">
                  
					</colgroup>
					<thead>
						<tr class="first">
							<th>지역</th>
							<th>지점</th>
							<th>예약날짜</th>
                            <th>예약시간</th>
							<th>테마명</th>
							<th>예약자명</th>
							<th>전화번호</th>
                            <th>예약인원</th>
                            <th>가격</th>
                            <th>결제방식</th>
							<th>예약취소</th>
						</tr>
					</thead>
					<tbody>

<?php    
    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }

    // 예약날짜가 3일 지난 데이터는 삭제
    $result = mysqli_query($connect, "delete from p_reservation where reservation_date < date_add(now(), INTERVAL -3 day)");
    $result = mysqli_query($connect, "delete from p_reservation_status where reservation_status_date < date_add(now(), INTERVAL -3 day);");

	$customer_name = $_POST['name'];
    $customer_phone_number = $_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
    
    $region_seq = null;

    $result = mysqli_query($connect, "SELECT * FROM p_reservation where customer_name='$customer_name' and customer_phone_number='$customer_phone_number'");
        while($data = mysqli_fetch_array($result)){
           $region_seq = $data['region_seq'];
           $branch_seq = $data['branch_seq'];
		   $theme_number = $data['theme_number'];
           $theme_name = $data['theme_name'];
           $reservation_date = $data['reservation_date'];
           $reservation_time = $data['reservation_time'];
           $booked_member = $data['booked_member'];
           $price = $data['price'];
           $purchase_way = $data['purchase_way'];
           $memo = $data['memo'];
           $register_date = $data['register_date'];

           $result2 = mysqli_query($connect, "SELECT region_name from p_region where region_seq=$region_seq");
           if($data2 = mysqli_fetch_array($result2)){
           $region_name = $data2['region_name'];
           }
           $result2 = mysqli_query($connect, "SELECT branch_name from p_branch where branch_seq=$branch_seq");
           if($data2 = mysqli_fetch_array($result2)){
           $branch_name = $data2['branch_name'];
           }
?>
						<tr>
							<td class="region"><?= $region_name ?></td>
							<td class="point"><?= $branch_name ?></td>
							<td class="date"><?= $reservation_date ?></td>
							<td class="time"><?= $reservation_time ?></td>
							<td class="theme"><?= $theme_name ?></td>
							<td class="name"><?= $customer_name ?></td>
							<td class="num"><?= $customer_phone_number ?></td>
							<td class="per"><?= $booked_member ?>명</td>
                            <td class="price"><?= $price ?></td>
                            <td class="pay"><?= $purchase_way ?></td>
							<td class="cancel"><a href="javascript:goPage(<?=$branch_seq?>,<?=$theme_number?>,'<?=$reservation_date?>','<?=$reservation_time?>');">취소</a></td>
						</tr>

<?php
        }
		if ($region_seq == null){
?>
					<tr>
						<td colspan="11">예약정보가 없습니다.</td>
					</tr>
<?php
		}
?>
					</tbody>
				</table>
			</div>
	
    </ul>				

		</div>
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

<form name="cancelRev">
            <input type="hidden" name="branch_seq">
            <input type="hidden" name="theme_number">
			<input type="hidden" name="reservation_date">
			<input type="hidden" name="reservation_time">
</form>

<script>
	function goPage(branch_seq,theme_number,reservation_date,reservation_time ) {
      var f = document.cancelRev;

      f.branch_seq.value = branch_seq;
	  f.theme_number.value = theme_number;
	  f.reservation_date.value = reservation_date;
	  f.reservation_time.value = reservation_time;

      f.action = "rev_cancel.php"
      f.method = "post"

      f.submit();
    };

</script>

<?php
    mysqli_close($connect);
?>


</body></html>
