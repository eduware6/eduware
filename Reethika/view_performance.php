<?php
        include './Database/Controler.php';
        include 'role.php'; 
        include 'includes/common.php';
        include_once $config ['SiteClassPath'] . "class.Marks.php";
?>  
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<style type="text/css">

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script language="javascript" type="text/javascript">


function showGraph(exam_id)
        {
            var student_id=document.getElementById("student_id").value;
            {
                
                $.post("marks_student.php?exam_id="+exam_id+"&student_id="+student_id,
                function (data)
                {
                    
                     var subjects = [];
                     var marks_array = [];
                    var parsed_json_data=JSON.parse(data);
                    console.log(parsed_json_data);
                    for (var i in parsed_json_data) {
                        
                        subjects.push(parsed_json_data[i].subject_code);
                        marks_array.push(parsed_json_data[i].marks);
                    }
                    
                    var chartdata = {
                        labels: subjects,
                        datasets: [
                            {
                                label: 'Student Marks',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks_array
                            }
                        ],
                        
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    yAxes: [{
                            display: true,
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 5,
                                max: 100
                            }
                        }]
                },
                
            }
                        
                    });
                });
            }
        }
</script>
 <?php
    if($_SESSION["role"]=="student" || $_SESSION["role"]=="parent" )
    {
  ?>
          <h2>Select Exam Type</h2>   
          </div>
          </div>
          <div class="row" cellpadding="2%">
          <div class="col-md-12">
          <div class="panel panel-default">
          <div class="panel-body">
          <div class="table-responsive">
          
          <form method="post">
          <input type="hidden" id="student_id" name="student_id" value="<?php echo $_SESSION["s_rn"];?>" />

          <select class="form-control" id="exam" name="exam" style="width: 200px;" onChange="return showGraph(this.value)">
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
          
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
         
         <tbody id="vnotific" name="vnotific">
                                    
         </tbody>
         </table>
         </form>

         <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
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