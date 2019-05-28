<?php
        include './Database/Controler.php'; 
//Year Dropdown      
if(isset($_REQUEST["crs"]))
{
    ?>
    <option value="">Select Year</option>
<?php
    foreach($year_data as $y)
    {
    ?>
        <option value="<?php echo $y->year; ?>"><?php echo $y->year?></option>
    <?php
    }
}
//Division dropdown
if(isset($_REQUEST["year"]))
 {
        ?>	
         <!<option value="">Select Division</option>
         <?php
         if($_SESSION["sess_crs"]==0)
         {
                if($_REQUEST["year"]=='First' || $_REQUEST["year"]=='Second' || $_REQUEST["year"]=='Third')
                {
                    $arr=array("A","B","C");
                }
                else
                {
                    $arr=array("A","B");
                }
                for($i=0;$i<count($arr);$i++)
                {
        ?>
                    <option value="<?php echo $arr[$i] ;?>"><?php echo $arr[$i];?></option>
                <?php
                }
         }
         else
         {
              $arr=array("A","B","C");
              for($i=0;$i<count($arr);$i++)
              {
        ?>
                    <option value="<?php echo $arr[$i] ;?>"><?php echo $arr[$i];?></option>
                <?php
              }
         }
}
//Hour dropdown
if(isset($_REQUEST["section"]))
 {
        ?>	
         <option value="">Select Hour</option>
         <?php
         if($_SESSION["sess_crs"]==0)
         {
                
                $arr=array("1","2","3","4","5","6","7");
               
                for($i=0;$i<count($arr);$i++)
                {
        ?>
                    <option value="<?php echo $arr[$i] ;?>"><?php echo $arr[$i];?></option>
                <?php
                }
         }
         else
         {
            $arr=array("1","2","3","4","5","6","7");
              for($i=0;$i<count($arr);$i++)
              {
        ?>
                    <option value="<?php echo $arr[$i] ;?>"><?php echo $arr[$i];?></option>
                <?php
              }
         }
}
//Subject dropdown
if(isset($_REQUEST["hour"]))
{
	?>
	
         <option value="">Select Subject</option>
         <?php
                foreach($sub_res as $c)
                {
                    ?>
                    <option value="<?php echo $c->usub_id;?>"><?php echo $c->sub_name; ?></option>
                    <?php
                }
      
}
//subject faculty list
if(isset($_REQUEST["crs_fac"]))
{?>
    <option value="">Select Faculty</option>
         <?php
	foreach($sub_fac as $sf)
	{
	?>
 <option value="<?php echo $sf->ufac_id;?>"><?php echo $sf->fac_name;?></option>
                <?php
                    }
}
?>
