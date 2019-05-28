
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
$(document).ready(function(){
//   var show_btn=$('.show-modal');
//   var show_btn=$('.show-modal');
//   //$("#testmodal").modal('show');
//  var id=$(".show-modal").attr('id'); 
//     show_btn.click(function(){
//         var query_id=document.getElementById("query_id").value;
//         $("#").val(id);
//         $("#testmodal").modal('show');


//   })

  $('.show-modal').on('click',function(){
         var id = $(this).attr('id');
    
     
        $("#query_id").val(id);
        $("#testmodal").modal('show');
  });
});

$(function() {
        $('#myModal').on('click', function( e ) {
            Custombox.open({
                target: '#testmodal-1',
                effect: 'fadein'
            });
            e.preventDefault();
        });
    });
</script>
 <?php
    if( $_SESSION["role"]=="admin")
    {
  ?>
          <h2>Queries</h2>   
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
            "to_type" => "to_admin",
            "from_type"=>"parent",
            );
        $student_notifications=$md->sel_where($con,"queries", $where);
        //var_dump($student_notification);exit;
        ?>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">

        <thead style="color:white;background:#202020;">
                       <th align="center" width="6%" >S.No. </th>
                       <th align="center">Message :</th>
                       <th align="center" width="10%">Sent On :</th>
                       <th align="center" width="15%"> Response </th>
                       </font>
         </thead>
    <?php
    $cnt=0;
     foreach($student_notifications as $s_noti)
     {
         //var_dump($s_noti);
         if($s_noti->to_type && $s_noti->respond_message==NULL){
            $createdDate = $s_noti->created_on;
            $newcreatedDate = date("d-m-Y", strtotime($createdDate));
            
                $cnt++;
               
                ?>
                <tr align="center">
                   <td><?php echo $cnt; ?></td>
                   <td align="left"><?php echo $s_noti->query_message; ?></td>
                   <td><?php echo $newcreatedDate;?></td>
                   <td>
                   <div id="testmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                style="color:#fff;background:#428bca;border-color:#357ebd;" >&times;</button>
                <h4 class="modal-title ">RESPONSE</h4>
            </div>
            <form >
            <div class="modal-body">
            
              
             <input type="hidden" name="query_id" id="query_id" value="<?php echo $s_noti->query_id; ?>" >
                <TEXTAREA ID="respond_msg" NAME="respond_msg" ROWS="5" COLS="75"></TEXTAREA>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="query_submit_respond" name="query_submit_respond" class="btn btn-primary">SUBMIT</button>
            </div>
            </form>
        </div>
    </div>
</div>
<a href="#myModal" id="<?php echo $s_noti->query_id; ?>" name="<?php echo $s_noti->query_id; ?>" class="btn btn-primary show-modal">RESPOND</a>

                   </td>
       </button>
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