<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="css/style.scss" type="text/css">
            <link rel="stylesheet" href="css/privacy.css" type="text/css">
            <!-- <link rel="stylesheet" href="css/main.css" type="text/css"> -->
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
                
            </div>
        </header>

<script>
		function change(){
			var obj = document.getElementById("sort");
			for (i=0;i<obj.length;i++ ){
				if(obj[i].selected){
					document.test.sort.value = obj[i].value;
			    }
		    }
			document.test.submit();
		}
</script>

    <div id="theme" class="body">
        <section id="title_area">
            <div class="container">
                <h1>테마</h1>
                <h4>THEME</h4>
                <div class="line"></div>
            </div>
        </section>
<?php
    $_POST["sort"] = isset($_POST["sort"]) ? $_POST["sort"] : "basic";
?>
        <section class="feature03 black_body" id="theme_list">
            <div class="inner container">
        <form action="theme.php" method="post" name="test">
            <select class="sort" id="sort" name="sort" onchange="change()">
                    <option>정렬</option>
                    <option value="basic" 
					<?php if($_POST["sort"]=='basic'){ ?>
						selected
					<?php } ?>>최신순</option>
                    <option value="level"
					<?php if($_POST["sort"]=='level'){ ?>
						selected
					<?php } ?>>난이도</option>
                    <option value="scare"
					<?php if($_POST["sort"]=='scare'){ ?>
						selected
					<?php } ?>>공포도</option>
            </select>
        </form>

            <div class="row">
<!-- 첫 번째 꺼 -->
<?php
    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }

    
    if($_POST["sort"] == "basic"){
    $result = mysqli_query($connect,"SELECT * FROM p_theme GROUP by theme_number order by theme_number desc;");
    }else if($_POST["sort"] == "level"){
    $result = mysqli_query($connect,"SELECT * FROM p_theme group by theme_number order by theme_level desc;");
    }else if($_POST["sort"] == "scare"){
    $result = mysqli_query($connect,"SELECT * FROM p_theme group by theme_number order by theme_scare desc;");
    }else{
	$result = mysqli_query($connect,"SELECT * FROM p_theme GROUP by theme_number order by theme_number desc;");
	}
    while($data = mysqli_fetch_array($result)){
        $branch_seq = $data['branch_seq'];
        $result2 = mysqli_query($connect,"SELECT branch_name FROM p_branch where branch_seq = $branch_seq");
        if($data2 = mysqli_fetch_array($result2)){
?>          
                    <div class="col s3">
                        <div class="img">
                                <ul class="medal"></ul>
                                    <img src="<?=$data['theme_picture']?>">
                	                    <div class="over">
                                            <div class="backgroundBlack"></div>
                                            <a href="" class="close">x</a>
                                                <div class="inner">
                                                    <div class="tit"><?=$data['theme_name']?></div> 
                                                    <div class="desc" style="height: 55%;"><?=$data['theme_description']?></div>
                                                    <div class="level" style="width:230px;">
                                                        <table class="level_inner">
                                                            
                                                <tbody>
                                                    <tr>
                                                        <td><?=$data['theme_jenre']?></td>
                                                        <td>난이도 
                                                            <div class="star_box">
                                                        <?php
                                                                for($i=0; $i<$data['theme_level'];$i++){
                                                        ?>
                                                                <i class="ico star"></i>
                                                        <?php
                                                            }
                                                        ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>공포도 
                                                            <div class="star_box">
                                                            <?php
                                                                for($i=0; $i<$data['theme_scare'];$i++){
                                                            ?>
                                                                <i class="ico star"></i>
                                                            <?php
                                                                }
                                                            ?>
                                                            </div>
                                                        </td> 
                                                        <td style="padding:5px 0 0; line-height:150%;"><?=$data2['branch_name']?></td>
                                                    </tr>                          
                                                </tbody>
                                                        </table>
                                                </div>   
                                                    <div class="level">
                                                    </div>                          
                                        </div> 
                        </div>
                    </div>
                </div>
 
<?php
        }
    }
?>
                

<!--  첫 번째 끝-->



                    
                    


            </div>
            </div>
        </section>
        

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

<?php
    mysqli_close($connect); 
?>
    </body></html>