<?php
session_start();
include 'Model.php';
$md = new model();

date_default_timezone_set('asia/kolkata');

$a_y = $md->display($con, "academic_year");
$fd = date("Y");
$a_yf = $md->sel_pattern($con, "academic_year", "ac_year", $fd . "%");
$crs = $md->display($con, "course");


//Year dropdown
if (isset($_REQUEST["crs"])) {
    //Fatch semester data
    $_SESSION["sess_crs"] = $_REQUEST["crs"];
    if ($_SESSION["role"] == '1') {
        $year_data = $md->sel($con, "sem_year", "year");
    } else {
        $where = array(
            "ufac_id" => $_SESSION["ufac_id"],
            "c_id" => $_REQUEST["crs"]
        );
        $where1 = array(
            "ufac_id" => $_SESSION["ufac_id"]
        );
        $semc_data = $md->sel_where($con, "subject", $where);
        $seme_data = $md->sel_where($con, "subject1", $where1);
        //Fatch year data
        $where = array($semc_data[0]->sem_no);
        $where1 = array($seme_data[0]->sem_no);
        for ($i = 1; $i < count($semc_data); $i++) {
            array_push($where, $semc_data[$i]->sem_no);
        }
        for ($i = count($semc_data); $i < count($seme_data); $i++) {
            array_push($where1, $seme_data[$i]->sem_no);
        }
        $sem_data = array_merge($where, $where1);
        $year_data = $md->sel_where_or_dist($con, "year", "sem_year", $sem_data, "sem_no");
    }
}
//Fetch faculty data
if (isset($_REQUEST["sub"])) {
    $ex = rtrim($_REQUEST["sub"], " ue");
    if ($ex == $_REQUEST["sub"]) {
        $where = array(
            "usub_id" => $_REQUEST["sub"]
        );

        $fac = $md->dis_join_con($con, "subject", "faculty", "subject.ufac_id=faculty.ufac_id", $where, "faculty.fac_name");
    } else {
        $where = array(
            "uesub_id" => $_REQUEST["sub"]
        );

        $fac = $md->dis_join_con($con, "subject1", "faculty", "subject1.ufac_id=faculty.ufac_id", $where, "faculty.fac_name");
    }
}
//batch dropdown
if(isset($_REQUEST["nbatch"]))
{
    $bt_res=$md->sel_all($con, "batches");
}

}
//View Student req
if (isset($_REQUEST["view_stu"])) {
    $year = $_REQUEST["c_id"];
    $sem = $_REQUEST["semester"];
    $div = strtolower($_REQUEST["division"]);
    $where = array(
        "c_id" => $year,
        "sem" => $sem,
        "division" => $div
    );
    $div_res = $md->sel_where($con, "student", $where);
    $_SESSION["sl"] = $div_res;
    header("location:stu_list.php");
}
//View more
if (isset($_REQUEST["s_enrlvm"])) {
    $s_enrl = $_REQUEST["s_enrlvm"];
    $where = array(
        "s_enrl" => $s_enrl
    );
    $data = $md->sel_where($con, "student", $where);
    $data1 = serialize($data);
    header("location:view_more.php?d1=$data1");
}
//Student update req
if (isset($_REQUEST["s_enrlup"])) {
    $s_enrl = $_GET["s_enrlup"];
    $where = array(
        "s_enrl" => $s_enrl
    );
    $data = $md->sel_where($con, "student", $where);
    $d1 = serialize($data);
    header("location:stu_update.php?d1=$d1");
}

}


}


//View Subject
if (isset($_REQUEST["vs"])) 
{
    $where = array(1 => '1');
    $subc_data = $md->dis_join_con1($con, "subject", "faculty", "subject.ufac_id=faculty.ufac_id", $where);
    $sube_data = $md->dis_join_con1($con, "subject1", "faculty", "subject1.ufac_id=faculty.ufac_id", $where);
    $sub_data = array_merge($subc_data, $sube_data);
    $_SESSION["subdata"] = $sub_data;

    header("location:view_sub.php");
}
//Assign Subjects
if (isset($_REQUEST["crs_fac"])) {
    $where = array($_REQUEST["crs_fac"], 2);
    $sub_fac = $md->sel_where_or($con, "faculty", $where, "c_id");
}
if (isset($_REQUEST["crs_sub"])) {
    $where = array(
        "c_id" => $_REQUEST["crs_sub"]
    );
    $sub_sub = $md->sel_where($con, "subject", $where);
    $sube_sub = $md->sel_all($con, "subject1");
}
//Fetch list of subject for disstribution
if (isset($_REQUEST["crs_sub2"])) {
    $where = array(
        "c_id" => $_REQUEST["crs_sub2"]
    );
    $sub_sub = $md->sel_pattern_not($con, "subject", $where, "sub_name", "%0%");
    $sube_sub = $md->sel_all($con, "subject1");
}
//Submit Assign Subject to faculty
if (isset($_REQUEST["subup_submit"])) {
    $ex = rtrim($_REQUEST["subject"], " ue");
    if ($ex == $_REQUEST["subject"]) {
        $data = array("ufac_id" => $_REQUEST["fac"]);
        $where = array(
            "usub_id" => $_REQUEST["subject"]
        );
        $md->updt($con, $data, "subject", $where);
        header("location:assign_sub.php");
    } else {
        $data = array("ufac_id" => $_REQUEST["fac"]);
        $where = array(
            "uesub_id" => $_REQUEST["subject"]
        );
        $md->updt($con, $data, "subject1", $where);
        header("location:assign_sub.php");
    }
}

}
//View Faculty
if (isset($_REQUEST["v_fac"])) {
    if ($_REQUEST["v_fac"] == 1 || $_REQUEST["v_fac"] == 0) {
        $where = array($_REQUEST["v_fac"], 2);
        $sub_fac1 = $md->sel_where_or($con, "faculty", $where, "c_id");
    } else {
        $sub_fac1 = $md->sel_all($con, "faculty");
    }
}



//Subject dropdown
if (isset($_REQUEST["hour"])) {
    if ($_SESSION["role"] == 1) {
        if ($_SESSION["sess_crs"] == 0) {
            $where = array(
                "c_id" => 0
            );
            $sub_res = $md->sel_where($con, "subject", $where);
        } elseif ($_SESSION["sess_crs"] == 1) {
            $where = array(
                "c_id" => 1
            );
            
            $subc_res = $md->sel_where($con, "subject", $where);
        } else {
            $where = array(
                "c_id" => $_SESSION["sess_crs"]
            );
            $sub_res = $md->sel_where($con, "subject", $where);
        }
    } else {
        if ($_SESSION["sess_crs"] == 1 ) {
            $where = array(
                "c_id" => 1,
                "ufac_id" => $_SESSION["ufac_id"]
            );
            $where1 = array(
                "ufac_id" => $_SESSION["ufac_id"]
            );
            $subc_res = $md->sel_where($con, "subject", $where);
            $sube_res = $md->sel_where($con, "subject1", $where1);
        } else {
            $where = array(
                "ufac_id" => $_SESSION["ufac_id"],
            );
            $sub_res = $md->sel_where($con, "subject", $where);
        }
    }
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
                
            }else{
                $cl[$i] = $_REQUEST["r$i"];
                $where = array(
                    "date" => $date,
                    "s_enrl" => $_REQUEST["r$i"],
                    "usub_id" => $sub,
                    "present" => $_REQUEST["ch$cl[$i]"],
                    "period" => $period
                );
                if ($_SESSION["att"]["stream"] == 0) {
                    $strm = "msc";
                } else {
                    $strm = "mba";
                }
                $table = "attendance";

                $md->insert($con, $where, $table);
                
            }
            
        }
        header("location:at.php");
   
}

