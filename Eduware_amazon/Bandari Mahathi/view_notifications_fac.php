
<?php
        include './Database/Controler.php';
        include 'role.php'; 
?>  
<script src="https://code.jquery.com/jquery-1.12.4.js">  </script>
<script language="javascript" type="text/javascript">


function getNotifications(user_type)
{
          var user_type=user_type;
          var from_type=document.getElementById("from_type").value;
          if(user_type)
          {
                    $.ajax({
                                      type:"GET",
                                      url:"dropdown.php",
                                      data:"to_type="+user_type+"&from_type="+from_type,
                                      success:function(result)
                                      {
                                                $("#dataTables-example").html(result);
                                      }
                             });
         }
}
</script>
 <?php
    if($_SESSION["role"]=="staff")
    {
  ?>
          <h2>Notifications</h2>   
          </div>
          </div>
          <div class="row">
          <div class="col-md-12">
          <div class="panel panel-default">
          <div class="panel-body">
          <div class="table-responsive">
          
          <form method="post">
          <input type="hidden" id="from_type" name="from_type" value="<?php echo $_SESSION["role"]?>" />
         <!-- <select class="form-control" value="to_student" id="user_type" name="user_type" onchange="return getNotifications(this.value)">
            <option value="">Select Type</option>
            <option value="to_staff">To Staff</option>
            <option value="to_student">To Student</option>
            <option value="to_parent">To Parent</option>
        </select>-->
        <?php
        $where=array(
            "to_type" => "to_staff",
            "from_type"=>"admin"
            );
        $student_notifications=$md->sel_where($con,"notifications", $where);
        //var_dump($student_notification);exit;
        ?>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

        <thead style="color:white;background:#202020;">
                       <th align="center" width="6%" >S.No. </th>
                       <th align="center">Message :</th>
                       <th align="center" width="10%">Sent On :</th>
                       </font>
         </thead>
    <?php
    $cnt=0;
     foreach($student_notifications as $s_noti)
     {
         if($s_noti->to_type){
            $createdDate = $s_noti->created_on;
            $newcreatedDate = date("d-m-Y", strtotime($createdDate));
            
                $cnt++;
                ?>
                <tr align="center">
                   <td><?php echo $cnt; ?></td>
                   <td align="left"><?php echo $s_noti->message; ?></td>
                   <td><?php echo $newcreatedDate;?></td>
                 </tr> 
                 <?php
                   }}
                   ?>
          
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
         
         <tbody id="vnotific" name="vnotific">
                                    
         </tbody>
         </table>
         </form>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
<?php
}
 else {
     ?>
    <div class="row">
    <div class="col-md-12"></div>
    <img src="img/ad.jpg">
    <?php
    
 }?>
<?php
    include_once 'footer.php';
?>