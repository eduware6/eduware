<?php
        include './Database/Controler.php';
		include 'role.php';  
		include 'includes/common.php';
		include_once $config ['SiteClassPath'] . "class.Marks.php";
		//$_SESSION["sess_crs"]==1;
		
		$where = array(
		//	"c_id" => $_SESSION["sess_crs"]
		);
		$sub_res = $md->sel_where($con, "subject", $where);
?> 
<script src="https://code.jquery.com/jquery-1.12.4.js">  </script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script language="javascript" type="text/javascript">
/**
		 *	Javascript function for form validations 
		 */

		  function getSections(class_name)
        {
                  
                   //var sem=document.getElementById("semester").value;
                   if(class_name)
                   {
                                    $.ajax({
                                                    type: "GET",
                                                    url:"dropdown.php",
                                                    data:"class_name="+class_name,
                                                    success:function(result)
                                                    {
                                                        $("#section").html(result);
                                                    }
                                              });
                   }
                   
         }
		function onSubmitMarksForm(){
			//	tinyMCE.triggerSave();
			
			var exam=trim(document.getElementById("exam").value);
			alert("exam");
				var class_id=trim(document.getElementById("class_id").value);	
				var section=trim(document.getElementById("section").value);			  
				var url=document.banner_form.excel1.value;

				document.getElementById("excelErrormsg").style.visibility="visible";
				document.getElementById("banner_errorMsg").innerHTML="";

				var bool=true;
				if(exam==""){
				document.getElementById("exam").style.border="1px #ff0000 solid";
				bool=false;
				}
				if(class_id=="")
				{
					document.getElementById("class_id").style.border="1px #ff0000 solid";
					bool=false;
				} 
				if(section=="")
				{
					document.getElementById("section").style.border="1px #ff0000 solid";
					bool=false;
				} 
				if(url=="")
				{
					document.getElementById("banner_errorMsg").innerHTML="Please select Excel sheet";
					document.getElementById("excelErrormsg").style.visibility="hidden";
					bool=false;
				} 
				else
				{
					var index=url.lastIndexOf(".");
					var imageType=url.substring(index);
					if(imageType==".xls"||imageType==".xlsx"||imageType==".XLS"||imageType==".XLSX"){
						
					}else{
						document.getElementById("banner_errorMsg").innerHTML="Please upload Excel formats(.xls,.xlsx) <br/>";			
						document.getElementById("excelErrormsg").style.visibility="hidden";
						return false;
					}
				}
				if(!bool){
					return false;
				}
				return true;
		}

</script>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
    <h2>Upload Marks</h2>
		<form enctype="multipart/form-data" method="post" action="marks_upload.php" onsubmit="return onSubmitMarksForm();" name="banner_form">
		<p class="textfield"><label>Select Exam: </label>
			<select class="form-control" id="exam" name="exam" style="width: 200px;">
			<option value="">Select Exam</option>
			<?php
			$marks_obj=new Marks();
			$exams_list=$marks_obj->getExamsList();
				foreach($exams_list as $exam)
                {
			?>
					<option value="<?php echo $exam["exam_id"];?>"><?php echo $exam["exam_name"];?></option>
				<?php } ?>
			</select>
			<p class="textfield"><label>Select Class: </label>
			<select class="form-control" id="class_id" name="class_id" style="width: 200px;" onChange="return getSections(this.value)">
			<option value="">Select Class</option>
			<?php
			//var_dump("hello");exit;
			$class_list=$marks_obj->getClassesList();
			//var_dump($class_list);exit;
				foreach($class_list as $class)
                {
			?>
					<option value="<?php echo $class["class_name"];?>"><?php echo $class["class_name"];?></option>
				<?php } ?>
			</select>
			<p class="textfield"><label>Select Section: </label>
			<select class="form-control" id="section" name="section" style="width: 200px;">
			</select>
			
			<p class="textfield"><label>Upload Marks File: </label>
			<input type="file" name="excel1" id="excel1"  class="file"  size="15"/>
			<div id="banner_errorMsg" style="color:#ff0000;float:left"></div>
			<div id="excelErrormsg" style="float:left;color:#ff0000;"> <?php if(isset($_SESSION['excel_error'] )) {$ermsg=$_SESSION['excel_error'] ;echo $ermsg; $_SESSION['excel_error'] ="";}  ?></div>
			Click <a href="./repository/Eduware/student_marks_sample.xls" target="_blank" style="text-decoration: underline; color: blue;">here</a> for sample events excel sheet
			<br><input type="submit" value="Submit" class="editsubmit"  onsubmit="return onSubmitMarksForm();" />	
		</form>
</div>
</div>
</div>
</div>