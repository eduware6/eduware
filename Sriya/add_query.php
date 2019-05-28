<?php
        include './Database/Controler.php';
        include 'header_parent.php';
?>
          
                 <!-- /. ROW  -->
<script language="javascript" src="./assets/js/validation.js"></script>
<script language="javascript">
function validate_form(f1)
  {
      if(isEmpty(f1.user_type.value,"Type.."))
      {
        alert(errMsg);
        f1.user_type.focus();
        return (false);
      }
      if(isEmpty(f1.message.value,"the Message.."))
      {
        alert(errMsg);
        f1.message.focus();
        return (false);
      }
      
  }

</script>                 
<?php
  if($_SESSION["role"]=="parent")
  {
  ?>               
  <h2>Add Query</h2>   
                        
                       
</div>
</div>
<!-- /. ROW  -->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
                        
<div class="panel-body">
<div class="row">
<div class="col-md-12">
<form method="post" role="form" enctype="multipart/form-data" onSubmit="return validate_form(this)">

   <!-- <div class="form-group">
        <label>Type:</label>
        <select class="form-control" id="user_type" name="user_type">
            <option value="">Select Type</option>
            <option value="to_staff">To Staff</option>
            <option value="to_student">To Student</option>
            <option value="to_parent">To Parent</option>
        </select>
    </div>-->
    <div class="form-group">
        <label>Message:</label>
        <textarea class="form-control" id="query_message" name="query_message"  rows="5" placeholder="Enter Message"></textarea>
   </div>
  <center>
         <button type="submit" id="query_submit" name="query_submit" value="Send" class="btn btn-primary" >Send</button>
  </center>
  </form>
  </center>
<?php
  }
 else
 {
     ?>
<div class="row">
<div class="col-md-12"></div>
<img src="img/ad.jpg">
<?php
 }
    include 'footer.php';
?>



