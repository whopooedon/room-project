<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <script language="javascript">
  document.title="SHERLOCK HOLMES - 셜록홈즈 방탈출 게임";
  </script>
  <link rel="stylesheet" href="css/point.css">
  <link rel="stylesheet" href="css/main.css">
  </head>

  <script>

function change1(){
  var obj = document.getElementById("selRegion");
  for (i=0;i<obj.length;i++ ){
    if(obj[i].selected){
      document.f3.selectedRegion.value = obj[i].value;
      }
    }
  document.f3.submit();
}

function change2(){
  var obj = document.getElementById("selRegion");
  for (i=0;i<obj.length;i++ ){
    if(obj[i].selected){
      document.f3.selectedRegion.value= obj[i].value;
      }
    }

  var obj2 = document.getElementById("selBranch");
  for (i=0;i<obj2.length;i++ ){
    if(obj2[i].selected){
      document.f3.selectedBranch.value= obj2[i].value;
      }
    }
  document.f3.submit();
}

    function goPage(selectedRegion, selectedBranch) {
      var f = document.goRev;

      f.selectedRegion.value = selectedRegion;
      f.selectedBranch.value = selectedBranch;
      f.action = "reservation.php"
      f.method = "post"

      f.submit();
    };



    </script>

  <body>
  <?php  
       $_POST['selectedRegion'] =  isset($_POST['selectedRegion']) ? $_POST['selectedRegion'] : '';
       $_POST['selectedBranch'] =  isset($_POST['selectedBranch']) ? $_POST['selectedBranch'] : '';
	?>

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
  
    <section class="branch_list">
      <div class="inner container">
        <div class="selectArea">
        <form method="POST" action="branch.php" name="f3">

<?php
	$region_seq = $_POST['selectedRegion'];
	if(strlen($region_seq) == 0){	
		$region_seq = 0;
	}else{
		$region_seq = $_POST['selectedRegion'];
	}
	
	$branch_seq = $_POST['selectedBranch'];
	if(strlen($branch_seq) == 0){	
		$branch_seq = 0;
	}else{
		$branch_seq = $_POST['selectedBranch'];
	}
?>




<?php
    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }
    $result2 = mysqli_query($connect, "SELECT region_seq,region_name FROM p_region");
?>	
    <select name="selRegion" id="selRegion" onchange="change1()">
        <option value=0>----지역선택----</option>
<?php
    while($data = mysqli_fetch_array($result2)){
		if($data['region_seq'] == $region_seq){
?>
		    <option value="<?= $data['region_seq'] ?>"selected><?= $data['region_name'] ?>
<?php
        }else{
?>
		    <option value="<?= $data['region_seq'] ?>"><?= $data['region_name'] ?>
<?php		
		}
	}
?>	
	</select>
  <?php	
	$result3 = mysqli_query($connect, "SELECT branch_seq, region_seq, branch_name FROM p_branch where region_seq=$region_seq");
?>	
    <select name="selBranch" id="selBranch" onchange="change2()">
        <option value=0>----지점선택----</option>
<?php
    while($data = mysqli_fetch_array($result3)){
		if($data['branch_seq'] == $branch_seq){
?>
		    <option value="<?php echo $data['branch_seq']; ?>" selected><?php echo $data['branch_name']; ?>
<?php
        }else{
?>
		    <option value="<?php echo $data['branch_seq']; ?>"><?php echo $data['branch_name']; ?>
<?php		
		}
	}
?>	
	  </select> 
		    <input type="hidden" name="selectedRegion" />
        <input type="hidden" name="selectedBranch" />
        </form>
        </div>

        <div class="row list">
        
<?php
        $result = mysqli_query($connect, "SELECT * FROM p_branch");
        while($data = mysqli_fetch_array($result)){
          if($region_seq == 0){
?>
            <div class="col s3">
               <div class="img">
                <img src="<?= $data['branch_picture'] ?>">             
              </div>
               <div class="tit"><?= $data['branch_name'] ?></div>
                 <div class="btns center">
                      <a href="branch_view.php?branch_seq=<?= $data['branch_seq'] ?>" class="btn"><i class="ico left zoom_black"></i>지점소개</a>          
                      <a href="javascript:goPage(<?=$data['region_seq']?>,<?=$data['branch_seq']?>);" class="btn"><i class="ico left cal_black"></i>예약하기</a>
                      
                  </div>
            </div>
<?php
          }
          else if($region_seq == $data['region_seq']){
            if($branch_seq == 0){
?>
            <div class="col s3">
               <div class="img">
                <img src="<?= $data['branch_picture'] ?>">             
              </div>
               <div class="tit"><?= $data['branch_name'] ?></div>
                 <div class="btns center">
                      <a href="branch_view.php?branch_seq=<?= $data['branch_seq'] ?>" class="btn"><i class="ico left zoom_black"></i>지점소개</a>          
                      <a href="javascript:goPage(<?=$data['region_seq']?>,<?=$data['branch_seq']?>);" class="btn"><i class="ico left cal_black"></i>예약하기</a>
                      
                  </div>
            </div>
<?php
					}
				else if($branch_seq == $data['branch_seq']){
?>
          <div class="col s3">
               <div class="img">
                <img src="<?= $data['branch_picture'] ?>">             
              </div>
               <div class="tit"><?= $data['branch_name'] ?></div>
                 <div class="btns center">
                      <a href="branch_view.php?branch_seq=<?= $data['branch_seq'] ?>" class="btn"><i class="ico left zoom_black"></i>지점소개</a>          
                      <a href="javascript:goPage(<?=$data['region_seq']?>,<?=$data['branch_seq']?>);" class="btn"><i class="ico left cal_black"></i>예약하기</a>
                      
                  </div>
            </div>

<?php
        }
      }
        }
?>
        <form name="goRev">
            <input type="hidden" name="selectedRegion">
            <input type="hidden" name="selectedBranch">
        </form>
       

      

            
             </div>
          </div>
        </div>
    </section>
  </div>

  <?php
        mysqli_close($connect); 
  ?>
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
  </html>