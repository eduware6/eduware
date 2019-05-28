<?php
$con=mysqli_connect('localhost','root','','qrcode');
if(mysqli_connect_errno($con)){
	echo 'Failed:'.mysqli_connect_error();
}
$r=$_POST['qr'];
$result="";
$ret="SELECT * FROM scan WHERE Roll='$r'";
	$res=Mysqli_query($con,$ret);
	if(mysqli_num_rows($res)>0){
		while($row=mysqli_fetch_assoc($res)){
			$result=$row["Email"];
		}
	}
	else{
		echo "F";
	}
	require 'phpmailer/PHPMailerAutoload.php';
	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->Port='587';
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='tls';
	$mail->Username='eduwaresample7@gmail.com';
	$mail->Password='7elpmas$';
	$mail->setFrom('eduwaresample7@gmail.com','Rock');
	$mail->AddAddress($result);
	$mail->isHTML(true);
	$mail->Subject='school';
	$mail->Body='your ward is present to school';
	if(!$mail->Send()){
		echo "Message could not be send";
	}
	else{
		echo "Message has been send";
	}
?>