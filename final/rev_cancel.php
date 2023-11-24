<?php
    $connect = mysqli_connect('localhost','root','','project3');
    if(mysqli_connect_error()) {
        echo "데이터베이스 연결에 실패하였습니다.";
    }


    $branch_seq =  $_POST['branch_seq'];
    $theme_number =  $_POST['theme_number'];
    $reservation_date =  $_POST['reservation_date'];
    $reservation_time =  $_POST['reservation_time'];


    $result = mysqli_query($connect, "delete from p_reservation where branch_seq=$branch_seq and theme_number=$theme_number and reservation_date='$reservation_date' and reservation_time='$reservation_time'");

    $st=0;

    $result2 = mysqli_query($connect, "SELECT DATE_FORMAT(theme_start,'%H:%i') as theme_start FROM p_theme where branch_seq = $branch_seq and theme_number = $theme_number order by theme_start");
        while($data = mysqli_fetch_array($result2)){  
            $st++;
            if($data['theme_start'] == "$reservation_time"){
                $result = mysqli_query($connect, "UPDATE p_reservation_status set booking_possibility_".$st."='Y'");
            }
        }

    mysqli_close($connect);
?>

<script>
    alert("예약이 취소되었습니다.");
    location.href="reservation.php";
</script>