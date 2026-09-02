<?php
$species = $_POST['species'] ?? '';
$tissue_name = $_POST['tissue_name'] ?? '';
$cell_name = $_POST['cell_name'] ?? '';
$enhancer_id = $_POST['enhancer_id'] ?? '';
$input_sel = $_GET['input_sel'] ?? '';
$selects = array();
if(!empty($species))
    $selects[] = "Species='$species'";
if(!empty($tissue_name))
    $selects[] = "Tissue='$tissue_name'";
if(!empty($cell_name))
    $selects[] = "Cell_Source='$cell_name'";
if(!empty($enhancer_id))
    $selects[] = "Enhancer_id='$enhancer_id'";
if(count($selects)>0)
    $select = " where ".join(" and ",$selects);
else
    $select = "";
include '../public/conn.php';
$search="SELECT distinct $input_sel
FROM enhancer_main $select";
$search_result=mysqli_query($conn,$search);
while($row = mysqli_fetch_assoc($search_result)){
    $data[] = array(
        "label" => $row[$input_sel]
    );
}
echo json_encode($data);
?>
