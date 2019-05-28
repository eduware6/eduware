<?php
        include './Database/Controler.php';
        include 'header_student.php';
        $where=array(
            "s_enrl" => $_SESSION["ufac_id"]
            );
        $hl=$md->sel1($con,"attendance","date", $where);
        //var_dump($hl);exit;
?> 
<h2>View Attendance</h2>   
                        
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
         <th>Date</th>
         <th>Hour1</th>
         <th>Hour2</th>
         <th>Hour3</th>
         <th>Hour4</th>
         <th>Hour5</th>
         <th>Hour6</th>
         <th>Hour7</th>
</thead>
<tbody>
<?php

          //foreach ($hl as $h)
          //{
              ?>
           <tr>
           <td><?php echo date("Y-m-d"); ?></td>
           <?php
            for($i=1;$i<=7;$i++){
                $where2=array(
                    "date" =>date("Y-m-d"),
                    "s_enrl" => $_SESSION["ufac_id"],
                    "period" => $i
                );
                $h2=$md->sel_where_order($con,"attendance",$where2,"date","ASC");
                
                /* if($i==3){
                    var_dump($h2);exit;
                } */
                
                if($h2){  
                    $where_sub=array(
                        "usub_id" =>$h2[0]->usub_id
                    );  
                    $subject=$md->sel_where($con,"subject",$where_sub);

                        if($h2[0]->period==1){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white";color:white"><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php } 
                        }else if($h2[0]->period==2){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php } 
                        }else if($h2[0]->period==3){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php } 
                        }else if($h2[0]->period==4){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php } 
                        }else if($h2[0]->period==5){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php } 
                        }else if($h2[0]->period==6){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }
                        }else if($h2[0]->period==7){
                            if($h2[0]->present==1){ ?>
                                <td style="background:green;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }else if(($h2[0]->present==0)){ ?>
                                <td style="background:red;color:white""><?php echo $subject[0]->sub_id ?></td>
                            <?php }  
                        }else{ ?>
                            <td></td>
                        <?php }
                }else{ 
                    ?>
                    
                    <td></td>
                <?php } 
                
            } 
            ?>
      </tr>
<?php  //} 
?>
</tbody>
                                    
 </table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    
    
         <?php
    include 'footer.php';
?>
</body>
</html>           