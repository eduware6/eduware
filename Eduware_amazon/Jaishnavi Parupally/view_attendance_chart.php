<?php
    include './Database/Controler.php';
    include 'role.php';
?>
 

<?php
$connect = mysqli_connect("localhost", "root", "", "sams");
$query = "SELECT count(*) as present_absent_count, present,
     case
         when present = 1 then 'Present'
         when present = 0 then 'Absent'
       end as present FROM attendance GROUP BY present ;";
$result = mysqli_query($connect, $query);
$i=0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["present"];
    $count[$i] = $row["present_absent_count"];
    $i++;
}
?>
<script type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawPieChart);  

function drawPieChart()  
{  
    var pie = google.visualization.arrayToDataTable([  
              ['attendancede', 'Numbder'],
              ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
              ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
                    
         ]);  
    var header = {  
          title: 'Percentage of Student OverAll Attendance',
          slices: {0: {color: '#F2522E'}, 1:{color: '#06C31A'}}
         };  
    var piechart = new google.visualization.PieChart(document.getElementById('piechart'));  
    piechart.draw(pie, header);  
} 

</script>
<h2>Overall Attendance</h2> 
<div class="row">
          <div class="col-md-12">
          <div class="panel panel-default">
          <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <div id="piechart" style="width: 900px; height: 500px;"></div> 
    </div>
</table>
 <?php
include 'footer.php';
?> 