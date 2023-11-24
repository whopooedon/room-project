<?php
$bno = $_POST['bno'];
$page = $_POST['page'];
$fname = $_POST['fname'];
$ftitle = $_POST['ftitle'];
$fwrite = $_POST['fwrite'];
$id = $_POST['id'];
$pw = $_POST['pw'];


$connect = mysqli_connect('localhost','root','','project3');
if(mysqli_connect_error()) {
    echo "데이터베이스 연결에 실패하였습니다.";
}

//update_form.php에서 전송된 내용 변수 할당
$fname = stripslashes($fname);
$ftitle = stripslashes($ftitle); 
$fwrite =  stripslashes($fwrite); 

$sql = "select count(bno) from freeboard_tbl where bno='$bno'";

$res = mysqli_query($connect,$sql);

while($row = mysqli_fetch_row($res)){
	$bno_count = $row[0];
}

if($bno_count > 0){  //비밀번호 확인해서 업데이트
	$sql2 = "update freeboard_tbl set name='$fname', title_board='$ftitle', 
			   write_board='$fwrite' where bno='$bno' ";
	mysqli_query($connect,$sql2);
	$msg = "수정 되었습니다.";
	echo "<br><font size=4><b><center> 
			글 수정하기 성공 </center></b></font><hr>";
	echo "<script>
			if('$msg' != '') {
				alert('$msg');
		    }
		    location.href='board.php?page=$page&id=$id&pw=$pw';
		  </script>";
}else{
	$msg = "오류.";
	echo "<script>
			if('$msg' != '') {
				alert('$msg');
		    }
		    history.go(-1);
		  </script>";
}
mysqli_close($connect);
?>