<?php
    include './Database/Controler.php';
    include 'role.php';
?>

<h2>Profile</h2> 
<?php  
if( ! $_SESSION)
{
    session_start();
}   
?>   
<div class="row">
          <div class="col-md-12">   
          <div class="panel panel-default">
          <div class="panel-body"  style="background-color: #F8F8F8;">
          <div class="table-responsive">
          
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
         <?php  
         $where= array(
        
            "ufac_id"=>$_SESSION['ufac_id']
        );
        
         $image=$md->sel1($con,"faculty","fac_gen",$where);
         if(strcasecmp($image[0]->fac_gen,"male")==0)
         {
         ?>
            <center><br><img src="img/m.jpg" height="10%" width="20%" style="border-radius:50%;"></center><br>
         <?php }else { ?>
          <center><br><img src="img/f.jpg" height="10%" width="20%" style="border-radius:50%;"></center><br>
         <?php } ?>

<?php


          $mysqli = new mysqli("localhost", "root", "","sams");
    $query = "SELECT ufac_id,fac_name,email,contact  FROM faculty WHERE ufac_id='".$_SESSION["ufac_id"]."'";
    // var_dump($query);
    /*$query="SELECT * FROM student WHERE s_rn='2161173'";*/
          if($result = $mysqli->query($query))
          {
              while($row = $result->fetch_assoc())
              {?>
                <b><h3><center><?php echo "<b>Faculty Name:</b> ". $row['fac_name']; ?></center></h3></b>
                <h4><center> <?php echo "<b>Faculty Id:</b> ".$row['ufac_id']; ?></center>
                <h4><center> <?php echo "<b>Email:</b> ".$row['email']; ?></center>
                <h4><center> <?php echo "<b>Contact:</b> ".$row['contact']; ?></center>
                <?php
              }
              $result->free();
          }

       

 ?>
         
</table>
<?php
include 'footer.php';
?>
