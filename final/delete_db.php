<?php
session_start();

$_SESSION['userid'] = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';

$bno = $_GET['bno'];
$page = $_GET['page'];
$id = $_GET['id'];
$pw = $_GET['pw'];

$connect = mysqli_connect('localhost','root','','project3');
if(mysqli_connect_error()) {
    echo "데이터베이스 연결에 실패하였습니다.";
}

$sql = "select count(bno) from freeboard_tbl where bno='$bno'";

$res = mysqli_query($connect,$sql);

while($row = mysqli_fetch_row($res)){
	$bno_count = $row[0];
}

if($bno_count > 0){
	$sql2 = " delete from freeboard_tbl where bno='$bno'";
	mysqli_query($connect,$sql2);

	$msg = "등록한 글이 삭제되었습니다.";
	echo "<script>
			if('$msg' != '') {
				alert('$msg');
		    }
		    location.href='board.php?page=$page';
		  </script>";
}else{
	$msg="오류";
	echo " <script>
		     if('$msg' != '') {
			   alert('$msg');
		     }
		     history.go(-1);
		  </script>";
}
mysqli_close($connect);
?>