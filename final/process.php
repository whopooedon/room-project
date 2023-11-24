<?php
    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }
?>

<?php
// 가져오는 값들 branch_seq, theme_number, selectedDate, theme_start, bank_name, bank_num, bank_man, name, phone1, phone2, phone3, people, pay_type, memo
	$branch_seq = $_GET['branch_seq'];
    $theme_number = $_GET['theme_number'];
    $selectedDate = $_GET['selectedDate'];  //예약한 방탈출 시작 날짜
	$reservationDate = date("Y-m-d"); //예약한 날짜
    $theme_start = $_GET['theme_start'];

	$theme_name = "";
	$customer_name = $_GET['name'];
	$customer_phone_number = $_GET['phone1']."-".$_GET['phone2']."-".$_GET['phone3'];
	$booked_member = $_GET['people'];
	$purchase_way = $_GET['pay_type'];
    if($purchase_way == 1){
        $purchase_way = "현장결제";
    }else if($purchase_way == 2){
        $purchase_way = "무통장결제(".$_GET['bank_name']." ".$_GET['bank_num']." ".$_GET['bank_man'].")";
    }
    $memo = $_GET['memo'];


    $result = mysqli_query($connect, "SELECT region_seq from p_branch where branch_seq = $branch_seq ");
        if($data = mysqli_fetch_array($result)){
           $region_seq = $data['region_seq'];
        }
    $result = mysqli_query($connect, "SELECT theme_name,theme_price from p_theme where theme_number = $theme_number ");
        if($data = mysqli_fetch_array($result)){
           $theme_name = $data['theme_name'];
           $theme_price = $data['theme_price'];  
        }
    $total_price = $theme_price*$booked_member;
    $st = $_GET['st'];





    // 위는 예약 정보 DB에 담기
    // 아래는 예약현황 바꾸기

    $sql2 = "SELECT * from p_reservation_status where branch_seq=$branch_seq and theme_number=$theme_number and reservation_status_date='$selectedDate'";
    $result = mysqli_query($connect,$sql2);

    if($data = mysqli_fetch_array($result)){ //데이터 값이 있으면
        $r[0] = $data['booking_possibility_1'];
        $r[1] = $data['booking_possibility_2'];
        $r[2] = $data['booking_possibility_3'];
        $r[3] = $data['booking_possibility_4'];
        $r[4] = $data['booking_possibility_5'];
        $r[5] = $data['booking_possibility_6'];
        $r[6] = $data['booking_possibility_7'];
        $r[7] = $data['booking_possibility_8'];

        
        if($r[$st] == "N"){     // 이미 예약이 되어있으면
?>

        <script>
            alert("이미 예약이 있어 예약이 불가능합니다.");
            location.href="reservation.php";
        </script>

<?php
        }else if ($r[$st] !== "N"){  // 이미 예약이 없으면
        $r[$st]='N'; //예약한 시간 N값 주기

        $sql = "UPDATE p_reservation_status set booking_possibility_".($st+1)." = 'N' where branch_seq=$branch_seq and theme_number=$theme_number and reservation_status_date='$selectedDate'" ;
        echo $sql."<br>";
        $result = mysqli_query($connect,$sql);

        //값 받아와서 p_reservation 테이블에 생성
    	$sql = "insert into p_reservation(region_seq,branch_seq,theme_number,theme_name,reservation_date,reservation_time,customer_name,customer_phone_number,booked_member,price,purchase_way,memo,register_date) values($region_seq,$branch_seq,$theme_number,'$theme_name','$selectedDate','$theme_start','$customer_name','$customer_phone_number',$booked_member,$total_price,'$purchase_way','$memo','$reservationDate')";	
        $result = mysqli_query($connect,$sql);

        }
    }else{ //데이터 값이 없으면

        //값 받아와서 p_reservation 테이블에 생성
    	$sql = "insert into p_reservation(region_seq,branch_seq,theme_number,theme_name,reservation_date,reservation_time,customer_name,customer_phone_number,booked_member,price,purchase_way,memo,register_date) values($region_seq,$branch_seq,$theme_number,'$theme_name','$selectedDate','$theme_start','$customer_name','$customer_phone_number',$booked_member,$total_price,'$purchase_way','$memo','$reservationDate')";	
        $result = mysqli_query($connect,$sql);
        
        $sql2 = "INSERT into p_reservation_status(reservation_status_date,region_seq,branch_seq,theme_number,booking_possibility_1,booking_possibility_2,booking_possibility_3,booking_possibility_4,booking_possibility_5,booking_possibility_6,booking_possibility_7,booking_possibility_8) values ('$selectedDate',$region_seq,$branch_seq,$theme_number,'Y','Y','Y','Y','Y','Y','Y','Y')";
        $result = mysqli_query($connect,$sql2);

        $r[0] = $data['booking_possibility_1'];
        $r[1] = $data['booking_possibility_2'];
        $r[2] = $data['booking_possibility_3'];
        $r[3] = $data['booking_possibility_4'];
        $r[4] = $data['booking_possibility_5'];
        $r[5] = $data['booking_possibility_6'];
        $r[6] = $data['booking_possibility_7'];
        $r[7] = $data['booking_possibility_8'];

        $r[$st]='N'; //예약한 시간 N값 주기

        $sql = "UPDATE p_reservation_status set booking_possibility_".($st+1)." = 'N' where branch_seq=$branch_seq and theme_number=$theme_number and reservation_status_date='$selectedDate'" ;
        echo $sql."<br>";
        $result = mysqli_query($connect,$sql);

    }
    
?>


<script>
    alert("예약이 완료되었습니다.");
    location.href="reservation.php";
</script>

<?php

    mysqli_close($connect);

?>
