<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <?php include "public/import.php" ?>
    <style>
        /* ===== Hero Banner ===== */
        .search-hero {
            background: linear-gradient(135deg, #418679 0%, #2d6b5f 40%, #1a4a4a 100%);
            padding: 3rem 0 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .search-hero::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -10%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }
        .search-hero::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -5%;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .search-hero .container {
            position: relative;
            z-index: 1;
        }
        .search-hero h2 {
            color: #fff;
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 0.4rem;
        }
        .search-hero .breadcrumb-bg {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        .search-hero .breadcrumb-bg a {
            color: rgba(255,255,255,0.85);
        }
        .search-hero .breadcrumb-bg a:hover {
            color: #fff;
        }
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 1.5rem;
        }
        .hero-stat {
            color: #fff;
        }
        .hero-stat .stat-num {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .hero-stat .stat-label {
            font-size: 0.85rem;
            opacity: 0.75;
        }

        /* ===== Main Layout ===== */
        .search-main {
            padding-bottom: 3rem;
        }

        /* ===== Sidebar Nav ===== */
        .search-sidebar {
            position: sticky;
            top: 1rem;
        }
        .search-sidebar .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 18px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .search-sidebar .card-header {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: none;
        }
        .search-sidebar .nav {
            padding: 0.5rem 0;
        }
        .search-sidebar .nav-link {
            color: #525f7f;
            font-weight: 500;
            padding: 0.85rem 1.25rem;
            border-left: 3px solid transparent;
            border-radius: 0;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .search-sidebar .nav-link i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            color: #8898aa;
            transition: color 0.2s;
        }
        .search-sidebar .nav-link:hover {
            color: #418679;
            background: #f4f9f7;
            border-left-color: #418679;
        }
        .search-sidebar .nav-link:hover i {
            color: #418679;
        }
        .search-sidebar .nav-link.active {
            color: #418679;
            background: #eef7f4;
            border-left-color: #418679;
            font-weight: 600;
        }
        .search-sidebar .nav-link.active i {
            color: #418679;
        }

        /* ===== Content Card ===== */
        .search-content-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 18px rgba(0,0,0,0.06);
            min-height: 480px;
        }
        .search-content-card .card-body {
            padding: 2rem;
        }

        /* ===== Tab Content ===== */
        .tab-pane-header {
            font-weight: 600;
            font-size: 1.2rem;
            color: #32325d;
            margin-bottom: 1.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f0f3f5;
        }
        .tab-pane-header i {
            color: #418679;
            margin-right: 0.5rem;
        }

        /* ===== Form Styling ===== */
        .form-section-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #525f7f;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .form-section-label i {
            color: #418679;
            font-size: 1rem;
        }
        .search-content-card .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #fafbfc;
        }
        .search-content-card .form-control:focus {
            border-color: #418679;
            box-shadow: 0 0 0 3px rgba(65,134,121,0.1);
            background: #fff;
        }
        .search-content-card select.form-control {
            cursor: pointer;
            appearance: auto;
        }
        .search-content-card textarea.form-control {
            resize: vertical;
        }

        /* ===== Buttons ===== */
        .btn-search {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.25s;
            box-shadow: 0 4px 12px rgba(65,134,121,0.25);
        }
        .btn-search:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a4a4a);
            box-shadow: 0 6px 18px rgba(65,134,121,0.35);
            transform: translateY(-1px);
            color: #fff;
        }
        .btn-example {
            background: #fff;
            border: 1.5px solid #418679;
            color: #418679;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.25s;
        }
        .btn-example:hover {
            background: #eef7f4;
            color: #2d6b5f;
        }
        .btn-reset {
            background: #fff;
            border: 1.5px solid #e2e8f0;
            color: #8898aa;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.25s;
        }
        .btn-reset:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            color: #525f7f;
        }
        .btn-action-group {
            display: flex;
            gap: 0.6rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        /* ===== Upload Area ===== */
        .upload-zone {
            border: 2px dashed #d2dce7;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            background: #fafbfc;
            transition: all 0.3s;
            cursor: pointer;
        }
        .upload-zone:hover {
            border-color: #418679;
            background: #f4f9f7;
        }
        .upload-zone i {
            font-size: 2.2rem;
            color: #418679;
            margin-bottom: 0.5rem;
        }
        .upload-zone .upload-text {
            font-weight: 500;
            color: #525f7f;
            font-size: 0.9rem;
        }
        .upload-zone .upload-hint {
            color: #8898aa;
            font-size: 0.8rem;
        }
        .upload-zone input[type="file"] {
            display: block;
            margin: 0.5rem auto 0;
            font-size: 0.85rem;
        }

        /* ===== Explanation Box ===== */
        .explanation-box {
            background: #f8fbf9;
            border: 1px solid #e0eeea;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            height: 100%;
        }
        .explanation-box .explanation-title {
            color: #418679;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .explanation-box .explanation-item {
            color: #525f7f;
            font-size: 0.88rem;
            margin-bottom: 0.45rem;
            line-height: 1.5;
            display: flex;
            gap: 0.5rem;
        }
        .explanation-box .explanation-item strong {
            color: #418679;
            min-width: fit-content;
        }

        /* ===== Divider ===== */
        .form-divider {
            border-top: 1px solid #f0f3f5;
            margin: 1.5rem 0;
        }

        /* ===== Result Organization Note ===== */
        .search-note {
            display: flex;
            gap: 0.6rem;
            background: #f4f9f7;
            border: 1px solid #e0eeea;
            border-left: 3px solid #418679;
            border-radius: 8px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            color: #525f7f;
            font-size: 0.86rem;
            line-height: 1.6;
        }
        .search-note i {
            color: #418679;
            margin-top: 0.15rem;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .search-sidebar {
                position: static;
                margin-bottom: 1.5rem;
            }
            .search-hero {
                padding: 2rem 0 1.5rem;
            }
            .search-hero h2 {
                font-size: 1.5rem;
            }
            .hero-stats {
                gap: 1.5rem;
            }
            .hero-stat .stat-num {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

    <?php include "public/header.php" ?>

    <!-- ===== Hero Banner ===== -->
    <div class="search-hero">
        <div class="container">
            <div class="breadcrumb-bg">
                <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Search</span>
            </div>
            <h2><i class="fa fa-search mr-2"></i>Search Enhancer Database</h2>
            <p style="color: rgba(255,255,255,0.7); margin-bottom: 0;">Explore enhancer annotations by multiple search dimensions</p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="stat-num">7</div>
                    <div class="stat-label">Search Methods</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-num">5</div>
                    <div class="stat-label">Species</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-num">4,831</div>
                    <div class="stat-label">Enhancers</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Main Content ===== -->
    <div class="container search-main">
        <!-- ===== Result Organization Note ===== -->
        <div class="search-note">
            <i class="fa fa-list-ol"></i>
            <span><strong>How multiple matching records are organized:</strong> every search returns all matching enhancer records in a single interactive table, without relevance-based prioritization. By default, records are listed in ascending Enhancer ID order (E_00001, E_00002, …); click any column header to re-sort the list (ascending / descending). The table also provides an in-results search box, an adjustable number of entries per page, and CSV export; the total number of matching records is displayed above the table.</span>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="search-sidebar">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-compass mr-2"></i>Search By
                        </div>
                        <ul class="nav nav-pills flex-column" id="search-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-tissue" data-toggle="tab" href="#pane-tissue" role="tab" aria-selected="true">
                                    <i class="fa fa-leaf"></i> Tissue
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-disease" data-toggle="tab" href="#pane-disease" role="tab" aria-selected="false">
                                    <i class="fa fa-heartbeat"></i> Disease
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-cell_type" data-toggle="tab" href="#pane-cell_type" role="tab" aria-selected="false">
                                    <i class="fa fa-eyedropper"></i> Cell Type
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-cell_line" data-toggle="tab" href="#pane-cell_line" role="tab" aria-selected="false">
                                    <i class="fa fa-flask"></i> Cell Line
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-tf" data-toggle="tab" href="#pane-tf" role="tab" aria-selected="false">
                                    <i class="fa fa-cogs"></i> TF
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-gene" data-toggle="tab" href="#pane-gene" role="tab" aria-selected="false">
                                    <i class="fa fa-dot-circle-o"></i> Target Gene
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-chromosome" data-toggle="tab" href="#pane-chromosome" role="tab" aria-selected="false">
                                    <i class="fa fa-bullseye"></i> Chromosome
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <div class="card search-content-card">
                    <div class="card-body">
                        <div class="tab-content" id="searchTabContent">
                            <!-- ========== TAB 1: Tissue-Specific ========== -->
                            <div class="tab-pane fade show active" id="pane-tissue" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-leaf"></i>Tissue-Specific Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_tissue_name_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="tissue_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-tag"></i>Tissue Name</div>
                                                <input type="text" class="form-control" id="tissue_name" name="tissue_name" placeholder="e.g. blood, lung, brain">
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#tissue_species').val('human');$('#tissue_name').val('blood');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) Tissue Name:</strong> Enter a tissue name (e.g., lung, liver, brain) to find enhancers active in that tissue.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 2: Disease-Specific ========== -->
                            <div class="tab-pane fade" id="pane-disease" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-heartbeat"></i>Disease-Specific Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_disease_name_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="disease_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-tag"></i>Disease Name</div>
                                                <input type="text" class="form-control" id="disease_name" name="disease_name" placeholder="e.g. leukemia, cancer, diabetes">
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#disease_species').val('human');$('#disease_name').val('leukemia');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) Disease Name:</strong> Enter a disease name to find enhancers associated with that disease condition.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 3: Cell Type-Specific ========== -->
                            <div class="tab-pane fade" id="pane-cell_type" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-eyedropper"></i>Cell Type-Specific Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_cell_type_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="celltype_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-tag"></i>Cell Type</div>
                                                <input type="text" class="form-control" id="cell_type_name" name="cell_type" placeholder="e.g. Human mesenchymal precursor cell, B cell">
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#celltype_species').val('human');$('#cell_type_name').val('Human mesenchymal precursor cell');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) Cell Type:</strong> Enter a cell type (e.g., B cell, T cell) to find enhancers specific to that cell type.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 4: Cell Line-Specific ========== -->
                            <div class="tab-pane fade" id="pane-cell_line" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-flask"></i>Cell Line-Specific Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_cell_line_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="cellline_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-tag"></i>Cell Line Name</div>
                                                <input type="text" class="form-control" id="cell_line_name" name="cell_line" placeholder="e.g. K562, HEK293T, HeLa">
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#cellline_species').val('human');$('#cell_line_name').val('K562');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) Cell Line:</strong> Enter a cell line name (e.g., HEK293T, HeLa) to find enhancers active in that cell line.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 5: TF-Associated ========== -->
                            <div class="tab-pane fade" id="pane-tf" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-cogs"></i>Transcription Factor–Associated Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_TF_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="tf_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-font"></i>Transcription Factor(s)</div>
                                                <textarea class="form-control" rows="4" id="tf_name" name="TF_name" placeholder="Enter TF names, one per line&#10;e.g.&#10;PAX8&#10;CTCF&#10;STAT3"></textarea>
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#tf_species').val('human');$('#tf_name').val('PAX8');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) TF Name(s):</strong> Enter one or more transcription factors (one per line) to find enhancers associated with those TFs.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 6: Target Gene–Associated ========== -->
                            <div class="tab-pane fade" id="pane-gene" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-dot-circle-o"></i>Target Gene–Associated Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_gene_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" id="gene_species" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-font"></i>Gene Symbol(s)</div>
                                                <textarea class="form-control" rows="4" id="target_gene" name="Target_gene" placeholder="Enter gene symbols, one per line&#10;e.g.&#10;MYC&#10;TP53&#10;EGFR"></textarea>
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="$('#gene_species').val('human');$('#target_gene').val('MYC');" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="explanation-box">
                                            <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                            <div class="explanation-item"><strong>1) Species:</strong> Select from 5 species: human, mouse, rat, zebrafish, drosophila.</div>
                                            <div class="explanation-item"><strong>2) Gene Symbol(s):</strong> Enter one or more gene symbols (one per line) to find enhancers targeting those genes.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========== TAB 7: Chromosome-Based ========== -->
                            <div class="tab-pane fade" id="pane-chromosome" role="tabpanel">
                                <div class="tab-pane-header"><i class="fa fa-bullseye"></i>Chromosome-Based Enhancer Search</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_enhancer_result.php">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-circle"></i>Chromosome</div>
                                                <select class="form-control" name="Chromosome">
                                                    <?php
                                                    $chroms = array_merge(
                                                        array_map(fn($i) => "chr$i", range(1, 22)),
                                                        ['chrX', 'chrY', 'chrMT']
                                                    );
                                                    foreach ($chroms as $c) {
                                                        echo "<option>$c</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-section-label"><i class="fa fa-arrow-right"></i>Start Position</div>
                                                        <input type="text" class="form-control" name="Start_position" placeholder="e.g. 1000000">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-section-label"><i class="fa fa-arrow-left"></i>End Position</div>
                                                        <input type="text" class="form-control" name="End_position" placeholder="e.g. 2000000">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a onclick="search_chromosome_select();" class="btn btn-example"><i class="fa fa-lightbulb-o mr-1"></i>Example</a>
                                                <button type="reset" class="btn btn-reset"><i class="fa fa-refresh mr-1"></i>Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <form method="post" action="search/Search_enhancer_result_file.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-paw"></i>Species</div>
                                                <select class="form-control" name="Species">
                                                    <option value="human">Human (hg38)</option>
                                                    <option value="mouse">Mouse (mm39)</option>
                                                    <option value="rat">Rat (rn7)</option>
                                                    <option value="zebrafish">Zebrafish (danRer11)</option>
                                                    <option value="drosophila">Drosophila (dm6)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-section-label"><i class="fa fa-upload"></i>Upload BED File</div>
                                                <div class="upload-zone">
                                                    <i class="fa fa-cloud-upload"></i>
                                                    <div class="upload-text">Drop your BED file or click to browse</div>
                                                    <div class="upload-hint">Format: chromosome, start, end</div>
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                                                    <input type="file" name="userfile" id="bedfile" accept=".bed">
                                                </div>
                                            </div>
                                            <div class="btn-action-group">
                                                <button type="submit" class="btn btn-search" name="submit"><i class="fa fa-search mr-1"></i>Search</button>
                                                <a href="/ENdbv1/file/test.bed" download="test.bed" class="btn btn-example"><i class="fa fa-download mr-1"></i>Sample File</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="form-divider"></div>
                                <div class="explanation-box">
                                    <div class="explanation-title"><i class="fa fa-info-circle"></i>Option Explanation</div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="explanation-item"><strong>Left Panel:</strong> Search enhancers by genomic coordinates (chromosome + start/end position).</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="explanation-item"><strong>Right Panel:</strong> Upload a BED-format file containing multiple enhancer regions for batch search.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /tab-content -->
                    </div><!-- /card-body -->
                </div><!-- /card -->
            </div><!-- /col-lg-9 -->
        </div><!-- /row -->
    </div><!-- /container -->

    <?php include "public/footer.php" ?>

    <script>
        // Manual tab switching (bypass Bootstrap data-toggle conflict between v3 and v4)
        $(document).on('click', '#search-tabs .nav-link', function(e) {
            e.preventDefault();
            var targetId = $(this).attr('href');
            
            // Update nav link active states
            $('#search-tabs .nav-link').removeClass('active');
            $(this).addClass('active');
            
            // Update tab pane visibility
            $('.tab-pane').removeClass('show active');
            $(targetId).addClass('show active');
        });

        function search_chromosome_select() {
            $('#pane-chromosome select[name="Species"]').val('human');
            $('#pane-chromosome select[name="Chromosome"]').val('chr1');
            $('#pane-chromosome input[name="Start_position"]').val('1000000');
            $('#pane-chromosome input[name="End_position"]').val('2000000');
        }
    </script>

</body>
</html>