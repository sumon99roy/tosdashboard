<?php
include("dbOracleConnection.php");
$sql="select * from inv_unit fetch first 5 rows only";
$stm=oci_parse($con_sparcsn4_oracle,$sql) ;
oci_execute($stm);
while(($row=oci_fetch_object($stm)) !=false){
    echo "  ".$row->GKEY;
}
?>