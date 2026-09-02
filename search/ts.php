<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
include '../../sqlconfig/ENdb/conn.php';
$sql="SELECT *
FROM enhancer_main
";
$enhancer_res=mysqli_query($conn,$sql);
while($row= mysqli_fetch_assoc($enhancer_res)){
    $arr = explode(',', $row["TF"]);
    foreach ($arr as $value){
        // enhancer_TF table merged into enhancer_main; INSERT no longer needed
    }
}
