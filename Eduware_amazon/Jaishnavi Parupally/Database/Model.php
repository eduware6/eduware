 function sel1($con,$table,$colm,$where)
        {
            $q="select distinct $colm from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
            //echo $q;exit;
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r;
        }
		
       


	   function sel_where_order($con,$table,$where,$col,$order)
        {
            $q="select * from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
            $q.="order by $col $order";
           //echo $q;exit;
            //alert($q);
            $all1=$con->query($q);
            
            while($row=$all1->fetch_object())
            {
                $r[]=$row;
            }
            if(isset($r))
                return $r; 
				
				
				
				
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