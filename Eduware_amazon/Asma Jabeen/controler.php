<?php
//Logout
if (isset($_REQUEST["logout"])) {
    session_destroy();
    header("location:index.php");
}
//Attendance Submit
if (isset($_REQUEST["att_submit"])) {
    $total = $_SESSION["atotal"];
    $date = $_SESSION["att"]["dt"];
    $sub = $_SESSION["att"]["sub"];
    $period = $_SESSION["att"]["period"];
    $cl = array();

        for ($i = 1; $i <= $total; $i++) {
            $where = array(
                "date" => $date,
                "period" => $period,
                "s_enrl" => $_REQUEST["r$i"]
            );
            $students_attendance = $md->sel_where($con, "attendance", $where);
            
            if (isset($students_attendance)) {
                $cl[$i] = $_REQUEST["r$i"];
                $where = array(
                    "date" => $date,
                    "s_enrl" => $_REQUEST["r$i"],
                    "period" => $period
                );
                $data=array(
                    "present" => $_REQUEST["ch$cl[$i]"]
                );
                $table = "attendance";
               $md->updt_at($con, $data, $table, $where);
                
            }
    header("location:at.php");
   }
   ?>
