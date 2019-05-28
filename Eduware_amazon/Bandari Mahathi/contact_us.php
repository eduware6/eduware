<?php
    include './Database/Controler.php';
    include 'role.php';
?>

<h2>Contact Details</h2> 
<?php 
if( ! $_SESSION)
{
    session_start();
}   
?>   
<div class="row">
          <div class="col-md-12">
          <div class="panel panel-default">
          <div class="panel-body">
          <div class="table-responsive">
          
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                   <td><center><br><img src="img/m.jpg" height="20%" width="30%" style="border-radius:50%;"></center><br>
                        <b><h3><center>RAM POLINENI</center></h3></b>
                        <h4><center><b>Email:</b>ram.polineni@eduware.com</center>
                        <h4><center><b>Contact Number:</b>8155800682</center>
                   </td>
                   <td> <center><br><img src="img/f.jpg" height="20%" width="28%" style="border-radius:50%;"></center>  
                         <br>
						 <b><h3><center>SITA GUNDIPURI</center></h3></b>
                                <h4><center><b>Email:</b>sita.gundipuri@eduware.com</center>
                                <h4><center><b>Contact Number:</b>7405383742</center>
                   </td>
          </table>
<?php
include 'footer.php';
?>
