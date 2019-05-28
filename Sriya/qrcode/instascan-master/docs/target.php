<?php
$connect=mysqli_connect('localhost','root','','qrcode');
if(mysqli_connect_errno($connect)){
    echo 'Falied to connect to database: '.mysqli_connect_error();
}
else{ echo 'Connected successfully!!';}

$qrval=$_POST['qr'];
$query="SELECT id FROM student WHERE id=$qrval";
$res=mysqli_query($connect,$query);
$m="SELECT emailid FROM student WHERE id=$qrval";
$mail=mysqli_query($connect,$m);
$row = mysqli_fetch_array($mail);

echo"<form action='MAILTO:$row[0]' method='post' enctype='text/plain'";
  
echo "Mail:<br>";
echo "<input type='text' name='The notification '  font size='20'>";
echo "<br>";
echo "<input type='submit' value='Send'>";
echo "<input type='reset' value='reset'>";

echo "</form>";

   

?>