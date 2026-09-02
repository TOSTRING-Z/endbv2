<!DOCTYPE html>
<html lang="en">
<head>
    <title>ENdb - Search Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php include "../public/import.php" ?>
    <style>
        .page-hero { background: linear-gradient(135deg, #1a3c34 0%, #2d6b5f 40%, #418679 100%); padding: 2.2rem 0 1.8rem; margin-bottom: 2rem; position: relative; overflow: hidden; }
        .page-hero::before { content: ''; position: absolute; top: -40%; right: -10%; width: 400px; height: 400px; border-radius: 50%; background: rgba(255,255,255,0.03); }
        .page-hero .container { position: relative; z-index: 1; }
        .page-hero .breadcrumb-bg { color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 0.5rem; }
        .page-hero .breadcrumb-bg a { color: rgba(255,255,255,0.85); }
        .page-hero .breadcrumb-bg a:hover { color: #fff; }
        .page-hero .hero-title { color: #fff; font-weight: 700; font-size: 1.9rem; margin-bottom: 0.3rem; }
        .page-hero .hero-title .highlight { color: #ffc65e; }
        .page-hero .hero-subtitle { color: rgba(255,255,255,0.75); font-size: 0.95rem; }
        .result-card { background: #fff; border: none; border-radius: 14px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); margin-bottom: 2rem; overflow: hidden; }
        .result-card .card-header { background: linear-gradient(135deg, #f0f7f5, #e8f2ef); padding: 1rem 1.5rem; font-weight: 700; font-size: 1.05rem; color: #32325d; border-bottom: 1px solid #dde8e4; }
        .result-card .card-body { padding: 1.5rem; }
        .result-card table { margin-bottom: 0; }
        .badge-count { background: #418679; color: #fff; font-size: 0.8rem; padding: 0.2rem 0.6rem; border-radius: 12px; margin-left: 0.5rem; }
    </style>
</head>
<body>
<?php include "../public/header.php" ?>
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg"><a href="/ENdb/">Home</a> &nbsp;/&nbsp; <a href="/ENdb/Search.php">Search</a> &nbsp;/&nbsp; <span>Results</span></div>
        <h1 class="hero-title"><span class="highlight">Search</span> Results</h1>
        <p class="hero-subtitle">Browse and export your search results below</p>
    </div>
</div>
<div class="container">
    <?php
    include '../public/conn.php';
    $allowedExts = array("bed");
    $temp = explode(".", $_FILES["userfile"]["name"]);
    $extension = end($temp);
    if (($_FILES["userfile"]["type"] == "application/octet-stream") && ($_FILES["userfile"]["size"] < 102400) && in_array($extension, $allowedExts)) {
        if ($_FILES["userfile"]["error"] > 0) {
            echo "error：: " . $_FILES["userfile"]["error"] . "<br>";
        } else {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "upload/" . $_FILES["userfile"]["name"]);
        }
    }
    ?>
    <div class="result-card">
        <div class="card-header"><i class="fa fa-upload"></i> Upload Results</div>
        <div class="card-body">
<table id="example" class="table table-striped table-bordered table-hover table-condensed" cellspacing="0"
                   width="100%">
                <thead>
                <th>Enhancer ID</th>
                <th>Species</th>
                <th>Genomic location</th>
                <th>Tissue</th>
                <th>Cell Source</th>
                <th>Disease</th>
                <th>Target Gene</th>
                <th>TF</th>
                <th>PMID</th>
                <th>Details</th>
                </thead>

                <tbody>
                <?php
                $Species = empty($_POST['Species']) ? null : trim($_POST['Species']);
                $species_map = ['human'=>'Homo sapiens','mouse'=>'Mus musculus'];
                if (isset($species_map[$Species])) { $Species = $species_map[$Species]; }
                $data = file_get_contents("upload/" . $_FILES["userfile"]["name"]);
                $data = preg_split("/\n/i",$data);
                foreach ($data as $row) {
                    $row = preg_split("/\s+/i",$row);
                    $Chromosome = trim($row[0]);
                    $Start_position = trim($row[1]);
                    $End_position = trim($row[2]);
                    $tim_tissue_sql = 'Chromosome="' . $Chromosome . '" and Species="' . $Species . '" ';
                    $enhancer_type_sql = "SELECT *
											FROM (SELECT *
											      from enhancer_main
												  where (Start_position between $Start_position and $End_position or End_position between $Start_position and $End_position) or (Start_position <=$Start_position and  End_position >= $End_position)) as tmpenhancer1
											where $tim_tissue_sql
                                        ";
                    $enhancer_type_res = mysqli_query($conn, $enhancer_type_sql);
                    while ($row = mysqli_fetch_assoc($enhancer_type_res)) {
                        $Enhancer_id = $row["Enhancer_id"];

                        $Chromosome = $row["Chromosome"];
                        $Species = $row["Species"];
                        $Start_position = $row["Start_position"];
                        $End_position = $row["End_position"];
                        $Tissue = $row["Tissue"];
                        $Cell_Source = $row["Cell_Source"];
                        $Disease_Name = $row["Disease_Name"];
                        $Target_Gene = $row["Target_Gene"];
                        $TF = $row["TF"];
                        $PMID = $row["PMID"];
                        ?>
                        <tr>

                            <td><?php echo $Enhancer_id; ?></td>
                            <td><?php echo $Species; ?></td>
                            <td><?php echo $Chromosome; ?>:<?php echo $Start_position; ?>~<?php echo $End_position; ?></td>

                            <td><?php echo $Tissue; ?></td>
                            <td><?php echo $Cell_Source; ?></td>
                            <td><?php echo $Disease_Name; ?></td>
                            <td><?php echo $Target_Gene; ?></td>
                            <td><?php echo $TF; ?></td>
                            <td>
                                <a href="https://www.ncbi.nlm.nih.gov/pubmed/<?php echo $PMID; ?>"><?php echo $PMID; ?></a>
                            </td>
                            <td><?php echo '<a href="Detail.php?Enhancer_id=' . $Enhancer_id . '">'; ?>Details</a></td>
                        </tr>
                    <?php }
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include "../public/footer.php" ?>
</body>
<script>
$(document).ready(function() {
    $('#example').on('draw.dt', function() { $('#resultCount').text($('#example').DataTable().rows().count()); });
    $('#example').dataTable({
        dom: '<"row"<"col-lg-12 d-flex justify-content-between align-items-baseline"<iB>f><"col-lg-12 mb-2"rt><"col-lg-12 d-flex justify-content-between align-items-end"lp>>',
        buttons: [{ extend: 'csvHtml5', text: '<i class="fa fa-download mr-1"></i> Export CSV' }],
        "autoWidth": false, "scrollX": true,
        "language": { "paginate": { "first": "<<", "previous": "<", "next": ">", "last": ">>" } }
    });
});
</script>
</html>
