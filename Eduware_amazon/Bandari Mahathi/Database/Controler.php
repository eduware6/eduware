<?php
session_start();
include 'Model.php';
$md = new model();

date_default_timezone_set('asia/kolkata');

$a_y = $md->display($con, "academic_year");
$fd = date("Y");
$a_yf = $md->sel_pattern($con, "academic_year", "ac_year", $fd . "%");
$crs = $md->display($con, "course");

//Login
if (isset($_REQUEST["login"])) {
    
    if($_REQUEST["usertype"]=="student"){
        $where = array(
            "s_rn" => $_REQUEST["unm"],
            "student_password" => $_REQUEST["pwd"],
        );
        $d = $md->login($con, "student", $where);
        $fac_data = $d->fetch_object();
        //var_dump($fac_data);exit;
        //Fatch faculty data
        $where = array(
            "fac_id" => $fac_data->s_rn
        );
        $_SESSION["ufac_id"] = $fac_data->s_enrl;
        $_SESSION["fac_name"] = $fac_data->fnm;
        $_SESSION["role"] = "student";

        //Fatch course data
        $where = array(
            "c_id" => $fac_data->s_rn
        );
        $main_data = array(
            "fac_data" => $fac_data,
        );
        $_SESSION["d"]=null;
        $_SESSION["d"] = $main_data;
        
    }else if($_REQUEST["usertype"]=="parent"){
        $where = array(
            "s_rn" => $_REQUEST["unm"],
            "parent_password" => $_REQUEST["pwd"],
        );
        $d = $md->login($con, "student", $where);
        $d = $md->login($con, "student", $where);
        $fac_data = $d->fetch_object();
        //var_dump($fac_data);exit;
        //Fatch faculty data
        $where = array(
            "fac_id" => $fac_data->s_rn
        );
        $_SESSION["ufac_id"] = $fac_data->s_enrl;
        $_SESSION["fac_name"] = $fac_data->fnm;
        $_SESSION["role"] = "parent";

        //Fatch course data
        $where = array(
            "c_id" => $fac_data->s_rn
        );
        $main_data = array(
            "fac_data" => $fac_data,
        );
        $_SESSION["d"]=null;
        $_SESSION["d"] = $main_data;
    }else{
        $where = array(
            "email" => $_REQUEST["unm"],
            "password" => $_REQUEST["pwd"],
        );
        $d = $md->login($con, "faculty", $where);
        $fac_data = $d->fetch_object();
        //var_dump($fac_data);exit;
        //Fatch faculty data
        $where = array(
            "fac_id" => $fac_data->fac_id
        );
        $_SESSION["ufac_id"] = $fac_data->ufac_id;
        $_SESSION["fac_name"] = $fac_data->fac_name;
        if($fac_data->role=="1"){
            $_SESSION["role"] = "admin";
        }else{
            $_SESSION["role"] = "staff";
        }
        //Fatch course data
        $where = array(
            "c_id" => $fac_data->c_id
        );
        $main_data = array(
            "fac_data" => $fac_data,
        );
        $_SESSION["d"]=null;

        $_SESSION["d"] = $main_data;
    }
    header("location:dashboard.php");
}
//Logout Admin
if (isset($_REQUEST["logoutAdmin"])) {
    session_destroy();
    header("location:adminIndex.php");
}
//Logout
if (isset($_REQUEST["logout"])) {
    session_destroy();
    header("location:index.php");
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


//View Notifications
if((isset($_REQUEST["to_type"])) && (isset($_REQUEST["from_type"]))){
        $to_type=$_REQUEST["to_type"];
        $from=$_REQUEST["from_type"];
        $where_not = array(
                "to_type" =>$to_type,
                "from_type" =>$from
        );
        $notificationslist = $md->sel_where($con,"notifications", $where_not);
        //var_dump($notificationslist);exit;
}

//Add Notification
if (isset($_REQUEST["notification_submit"])) {
    $user_type = $_REQUEST["user_type"];
    $message = $_REQUEST["message"];
    
    $role = $_SESSION["role"];

    $notification = array("from_type" => $role, "to_type" => $user_type, "message" => $message,"created_on" =>date("Y-m-d H:i:s"));

    $md->insert($con, $notification, "notifications");
}

//Add class Notifications
if (isset($_REQUEST["notification_submit_class"])) {
    $class = $_REQUEST["class_id"];
    $section = $_REQUEST["section"];
    $message = $_REQUEST["message"];
    
    $role = $_SESSION["role"];

    $class_notification = array("from_type" => $role, "to_type" => "student","class"=>$class,"section"=>$section,
     "message" => $message,"created_on" =>date("Y-m-d H:i:s"));

    $md->insert($con, $class_notification, "class_notifications");
}
//Add Query
if (isset($_REQUEST["query_submit"])) {
    $query_message = $_REQUEST["query_message"];
    
    $role = $_SESSION["role"];

    $query = array("from_type" => $role, "to_type" => "to_admin", "query_message" => $query_message,
    "student_id"=>$_SESSION["ufac_id"],"created_on" =>date("Y-m-d H:i:s"));

    $md->insert($con, $query, "queries");

}

//Respond Query
if (isset($_REQUEST["respond"])) {
    $query_message = $_REQUEST["respond_message"];
    
    $role = $_SESSION["role"];

    $query = array("from_type" => $role, "to_type" => "to_admin", "respond_message" => $query_message,
    "student_id"=>$_SESSION["ufac_id"],"created_on" =>date("Y-m-d H:i:s"));

    $md->insert($con, $query, "queries");

}

//Respond Query admin
if (isset($_REQUEST["query_submit_respond"])) {
    $res=$_REQUEST["respond_msg"];
    $id=$_REQUEST["query_id"];
    
    var_dump($res);
    //$user_type = $_REQUEST["user_type"];
   // $message = $_REQUEST["message"];
    
    $role = $_SESSION["role"];
    
    $respond_where = array(
        
        "query_id"=>$id
    );
    
    $query = array("respond_from" => "admin", "respond_to" => "parent", "respond_message" => $res,"responded_on" =>date("Y-m-d H:i:s"));
    $md->updt($con,$query,"queries",$respond_where);
    var_dump($md->updt($con,$query,"queries",$respond_where));
    //$md->update($con, $query, "queries");
}

?>