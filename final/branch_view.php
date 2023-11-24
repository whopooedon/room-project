<?php
$branch_seq=$_GET['branch_seq'];


$connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }
    $result = mysqli_query($connect, "SELECT region_seq,branch_seq,branch_name,branch_address,branch_phone_number,branch_map, branch_picture FROM p_branch where branch_seq=$branch_seq");
	
	    while($data = mysqli_fetch_array($result)){
			if($data['branch_seq'] == $branch_seq){
				$region_seq=$data['region_seq'];
				$branch_name=$data['branch_name'];
				$branch_address=$data['branch_address'];
				$branch_phone_number=$data['branch_phone_number'];
				$branch_map=$data['branch_map'];
				$branch_picture=$data['branch_picture'];
			}
		}
?>

<script>
	    function goPage(selectedRegion, selectedBranch) {
      var f = document.goRev;

      f.selectedRegion.value = selectedRegion;
      f.selectedBranch.value = selectedBranch;
      f.action = "reservation.php"
      f.method = "post"

      f.submit();
    };

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
    <link rel="stylesheet" href="css/point1.scss" type="text/css">
    <link rel="stylesheet" href="css/point2.scss" type="text/css">

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

<div id="branch" class="body">
	<section id="title_area">
		<div class="container">
			<h1>지점소개</h1>
			<h4>Branch Office</h4>
			<div class="line"></div>
		</div>
	</section>

	<section class="branch_view black_body">
		<div class="inner container">
			<h2><?= $branch_name ?></h2>
			<div class="row">
				<div class="col s7 map_area">
				
					<div id="map">
				      <iframe src="<?= $branch_map ?>" style="width:100%; height:360px">
                      </iframe>
					</div>
					
					<ul class="contact">
						<li class="location">  <?= $branch_address ?> </li>
						<li class="call"> <?= $branch_phone_number ?></li> 
					</ul>
				</div>
				<div class="col s5 img_area">
					<div class="slider-for slick-initialized slick-slider">
						<div aria-live="polite" class="slick-list draggable">
                             <div class="slick-track" role="listbox" style="opacity: 1; width: 350px;">
                                 <div class="item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00" style="width: 350px; position: relative; left: 0px; top: 0px;  opacity: 1;">
                                      <img src="<?=$branch_picture;?>">
                                 </div>
                               </div>
                        </div>
			        </div>

					
				</div>
			</div>
			<div class="desc">
			</div>
			<div class="btn_group right">
				<a href="javascript:goPage(<?=$region_seq?>,<?=$branch_seq?>);" class="btn black"><i class="ico left cal"></i>예약하기</a>
				<a href="branch.php" class="btn black"><i class="ico left list"></i>목록</a>
			</div>
		</div>
	</section>
	
</div>

<form name="goRev">
            <input type="hidden" name="selectedRegion">
            <input type="hidden" name="selectedBranch">
</form>


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


</body>