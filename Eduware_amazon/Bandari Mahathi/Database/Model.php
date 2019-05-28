<?php
    include 'Connection.php';
    $con1=new Connection();
    $con=$con1->mkConnection();
    
    class model
    {
        function insert($con,$stu,$table)
        {
            $k=array_keys($stu);
            $col=implode(",",$k);
            
            $v=array_values($stu);
            $val=implode("','",$v);
            
            $q="insert into $table($col) values('$val')";
           //echo $q;exit;
            return $con->query($q);
        }
                        
        function insert_con($con,$stu,$table,$where)
        {
            $k=array_keys($stu);
            $col=implode(",",$k);
            
            $v=array_values($stu);
            $val=implode("','",$v);
            
            $q="insert into $table($col) values('$val') where 1=1";
            
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
            
            //echo $q;exit;
            $con->query($q);
        }
        
        function display($con,$table)
        {
            $q="select * from $table";
            $all=$con->query($q);
            while($row=$all->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }
        
        function sel_count($con,$table)
        {
            $q="select * from $table";
            //echo $q;exit;
            
            $cnt=$con->query($q);
            $nm=$cnt->num_rows;
            
            return $nm;
        }
        function sel_count_wh($con,$table,$where)
        {
            $q="select * from $table where 1=1";
            //echo $q;exit;
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
            //echo $q;exit;
            $cnt=$con->query($q);
            $nm=$cnt->num_rows;
            
            return $nm;
        }
       
        function sel($con,$table,$colm)
        {
            $q="select distinct $colm from $table";
            
            //echo $q;exit;
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }
       
        
        function sel_where($con,$table,$where)
        {
            $q="select * from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
           //echo $q;exit;
            //alert($q);
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }

        
	function sel_where1($con,$table,$where)
        {
            $q="select * from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
	//		$q.="order by s_rn ASCE";
           //echo $q;exit;
            //alert($q);
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            //echo "<pre>";
            //print_r($r);exit;
            if(isset($r))
                return $r;
        }
        
        function sel_where_or_dist($con,$clmn,$table,$where,$c)
        {
            $q="select distinct $clmn from $table as s where 1<>1";
            foreach($where as $k=>$v)
            {
                $q.=" or s.$c='$v'";
            }
           // $q=$q." fac_id like ('%,$c') or fac_id like ('$c,%') or fac_id like ('$c')";
            //echo $q;exit;
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }
        function sel_where_or($con,$table,$where,$c)
        {
            $q="select * from $table where 1<>1";
            foreach($where as $k=>$v)
            {
                $q.=" or $table.$c='$v'";
            }
           // $q=$q." fac_id like ('%,$c') or fac_id like ('$c,%') or fac_id like ('$c')";
            //echo $q;exit;
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }
        function login($con,$table,$where)
        {
            $q="select * from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
            //$q=$q." and c_id IN ('$c')";
            //echo $q;exit;
            $all=$con->query($q);
            
            return $all;
        }
        
        
       
        
        
        
        
        
    }
?>