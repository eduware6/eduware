<?php
class model
    {
function updt_at($con,$data,$table,$where)
        {
            $q="update $table set ";
            foreach($data as $k=>$v)
            {
                $q.="$k='$v',";
            }
            $q=rtrim($q,",");
            $q.=" where 1=1 ";
            foreach($where as $m=>$n)
            {
                $q.=" and $m='$n'";
            }
            $con->query($q);
            
        }
function sel1($con,$table,$colm,$where)
        {
            $q="select distinct $colm from $table where 1=1";
            foreach($where as $k=>$v)
            {
                $q.=" and $k='$v'";
            }
}
        }
?>
