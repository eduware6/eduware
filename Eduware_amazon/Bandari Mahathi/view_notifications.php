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
    if($_SESSION["role"]=="admin")
    {
  ?>
          <h2>Faculty List</h2>   
          </div>
          </div>
          <div class="row" cellpadding="2%">
          <div class="col-md-12">
          <div class="panel panel-default">
          <div class="panel-body">
          <div class="table-responsive">
          
          <form method="post">
          <input type="hidden" id="from_type" name="from_type" value="<?php echo $_SESSION["role"]?>" />
          <select class="form-control" id="user_type" name="user_type" onchange="return getNotifications(this.value)">
            <option value="">Select Type</option>
            <option value="to_staff">To Staff</option>
            <option value="to_student">To Student</option>
            <option value="to_parent">To Parent</option>
        </select>
          
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