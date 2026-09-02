<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - AI Query</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <?php include "../public/import.php"; ?>
    <style>
        /* ===== Hero Banner (unified with index.php) ===== */
        .home-hero {
            background: linear-gradient(135deg, #1a3c34 0%, #2d6b5f 40%, #418679 100%);
            padding: 3.5rem 0 3rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .home-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -15%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .home-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -8%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.025);
        }
        .home-hero .container {
            position: relative;
            z-index: 1;
        }
        .home-hero .breadcrumb-bg {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        .home-hero .breadcrumb-bg a {
            color: rgba(255,255,255,0.85);
        }
        .home-hero .breadcrumb-bg a:hover {
            color: #fff;
        }
        .hero-title {
            color: #fff;
            font-weight: 700;
            font-size: 2.6rem;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }
        .hero-title .highlight {
            color: #ffc65e;
        }
        .hero-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 1.15rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 650px;
        }
        .btn-hero-primary {
            background: #ffc65e;
            color: #1a3c34;
            font-weight: 700;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            border: none;
            font-size: 0.95rem;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(255,198,94,0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-hero-primary:hover {
            background: #ffd98a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,198,94,0.4);
            color: #1a3c34;
            text-decoration: none;
        }
        .btn-hero-outline {
            background: transparent;
            color: #fff;
            font-weight: 600;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.4);
            font-size: 0.95rem;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.7);
            color: #fff;
            text-decoration: none;
        }

        /* ===== Content Card (unified with index.php card system) ===== */
        .about-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .about-card .card-body {
            padding: 2.5rem;
        }
        .about-card h3 {
            color: #32325d;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        /* ===== Form Styling ===== */
        textarea.form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fafbfc;
            min-height: 130px;
            resize: vertical;
        }
        textarea.form-control:focus {
            border-color: #418679;
            box-shadow: 0 0 0 3px rgba(65,134,121,0.1);
            background: #fff;
        }

        select.form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.5rem 0.9rem;
            font-size: 0.9rem;
            background: #fafbfc;
        }

        .btn-search {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 0.65rem 2rem;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.25s;
            box-shadow: 0 4px 12px rgba(65,134,121,0.25);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-search:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a4a4a);
            box-shadow: 0 6px 18px rgba(65,134,121,0.35);
            transform: translateY(-1px);
            color: #fff;
        }

        .section-header {
            margin-bottom: 2rem;
        }
        .section-header h2 {
            font-weight: 700;
            color: #32325d;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        .section-header .section-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #418679, #ffc65e);
            border-radius: 3px;
        }

        /* ===== Example Box ===== */
        .explanation-box {
            background: #f8fbf9;
            border: 1px solid #e0eeea;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 0.5rem;
        }
        .explanation-box .explanation-title {
            color: #418679;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .example-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .example-btn-small {
            padding: 7px 14px;
            background: #fff;
            color: #418679;
            border: 1.5px solid #c8e0cc;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.82rem;
            transition: all 0.2s;
        }
        .example-btn-small:hover {
            background: #eef7f4;
            border-color: #418679;
        }

        .loader {
            display: none;
            border: 4px solid rgba(65,134,121,0.1);
            border-top: 4px solid #418679;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 40px auto;
        }
        .progress-container {
            width: 100%;
            background-color: #EDEDED;
            border-radius: 8px;
            margin: 20px 0;
            display: none;
            overflow: hidden;
        }
        .progress-bar {
            height: 8px;
            background: linear-gradient(90deg, #418679, #2d6b5f);
            width: 0%;
            transition: width 0.3s ease;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .home-hero { padding: 2rem 0 1.5rem; }
            .hero-title { font-size: 1.8rem; }
            .hero-subtitle { font-size: 0.95rem; }
            .about-card .card-body { padding: 1.5rem; }
        }
    </style>
</head>

<body>

<?php include "../public/header.php"; ?>

<!-- ===== Hero Banner ===== -->
<div class="home-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp;
            <a href="/ENdb/Analysis/">Analysis</a> &nbsp;/&nbsp;
            <span>AI Query</span>
        </div>
        <h1 class="hero-title"><span class="highlight">AI</span>-Powered Enhancer Query</h1>
        <p class="hero-subtitle">Use natural language to search experimentally validated enhancers — powered by DeepSeek AI. Simply describe what you're looking for.</p>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container" style="padding-bottom:2rem;">
    <div class="row">
        <div class="col-lg-12">
            <div class="card about-card">
                <div class="card-body">
                    <h3><i class="fa fa-magic mr-2" style="color:#418679;"></i>Ask AI About Enhancers</h3>
                    <p style="color:#8898aa; font-size:0.9rem; margin-bottom:1.5rem;">
                        <i class="fa fa-lightbulb-o" style="color:#ffc65e;"></i>
                        Describe what you're looking for in plain English — the AI will search the enhancer database for you.
                    </p>

                    <form id="queryForm">
                        <div class="form-group">
                            <label style="font-weight:600;color:#525f7f;font-size:0.9rem;margin-bottom:0.5rem;">
                                <i class="fa fa-commenting mr-1" style="color:#418679;"></i>Your Question
                            </label>
                            <textarea class="form-control" name="query" id="query"
                                placeholder="e.g. Find super enhancers in liver tissue related to cancer..."></textarea>
                        </div>
                        <div style="margin: 15px 0;">
                            <label for="rowLimit" style="font-weight:600;color:#525f7f;font-size:0.9rem;">
                                <i class="fa fa-list-ol mr-1" style="color:#418679;"></i>Max Results:
                            </label>
                            <select name="rowLimit" id="rowLimit" class="form-control" style="width:120px;display:inline-block;margin-left:8px;">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <button type="submit" id="submit" class="btn-search">
                            <i class="fa fa-paper-plane"></i> Submit Query
                        </button>
                    </form>

                    <!-- Example Queries -->
                    <div style="margin-top:1.5rem;">
                        <div class="explanation-box">
                            <div class="explanation-title">
                                <i class="fa fa-lightbulb-o"></i> Example Queries (click to fill)
                            </div>
                            <div class="example-btns">
                                <button class="example-btn-small" data-query="Enhancers associated with leukemia">🩸 Leukemia enhancers</button>
                                <button class="example-btn-small" data-query="Enhancers in liver tissue">🔬 liver enhancers</button>
                                <button class="example-btn-small" data-query="Super enhancers related to prostate cancer">⭐ super enhancers + prostate cancer</button>
                                <button class="example-btn-small" data-query="Enhancers in B cells with TF CTCF">🧬 B cell enhancers with CTCF</button>
                                <button class="example-btn-small" data-query="Human enhancers associated with cervical cancer">🩺 human cervical cancer enhancers</button>
                                <button class="example-btn-small" data-query="Enhancers in brain tissue related to disease">🧠 brain tissue disease enhancers</button>
                            </div>
                        </div>
                    </div>

                    <!-- Results -->
                    <div style="margin-top:2rem;">
                        <div id="loader" class="loader"></div>
                        <div id="progress-container" class="progress-container">
                            <div id="progress-bar" class="progress-bar"></div>
                        </div>
                        <div id="results"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../public/footer.php"; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var queryForm = document.getElementById('queryForm');
    var loader = document.getElementById('loader');
    var progressContainer = document.getElementById('progress-container');
    var progressBar = document.getElementById('progress-bar');
    var results = document.getElementById('results');

    function query_content(e) {
        e.preventDefault();
        var formData = new FormData(e.target);
        loader.style.display = 'block';
        progressContainer.style.display = 'block';
        results.innerHTML = '';
        var progress = 0;
        var progressInterval = setInterval(function() {
            progress += Math.random() * 10;
            if (progress > 85) clearInterval(progressInterval);
            progressBar.style.width = progress + '%';
        }, 400);

        fetch('Enhancer_AI_Query_API.php', {
            method: 'POST',
            body: formData,
            headers: { 'X-Row-Limit': document.getElementById('rowLimit').value }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            clearInterval(progressInterval);
            loader.style.display = 'none';
            progressContainer.style.display = 'none';
            progressBar.style.width = '0%';

            if (data.error) {
                results.innerHTML = '<div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> <b>Error:</b> ' + data.error + '</div>';
                return;
            }
            var rows = data.data || [];
            if (rows.length === 0) {
                results.innerHTML = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-info-circle"></i> No results found. Try a different query.</div>';
                return;
            }
            results.innerHTML = '<div class="table-card" style="background:#fff;border:none;border-radius:12px;box-shadow:0 2px 15px rgba(0,0,0,0.05);padding:1.5rem;"><h5 style="font-weight:700;color:#32325d;margin-bottom:1rem;"><i class="fa fa-table mr-2" style="color:#418679;"></i>Query Results</h5><table class="table table-striped table-hover" cellspacing="0" id="resultsTable" style="width:100%"></table></div>';
            $('#resultsTable').DataTable({
                data: rows,
                columns: [
                    { title: 'Enhancer ID', data: null, render: function(d) {
                        return '<a href="../search/Detail.php?Species=' + encodeURIComponent(d._Species) + '&Enhancer_id=' + encodeURIComponent(d._Enhancer_id) + '" target="_blank">' + (d['Enhancer ID'] || '') + '</a>';
                    }},
                    { title: 'Genome Location', data: 'Genome Location' },
                    { title: 'Tissue', data: 'Tissue' },
                    { title: 'Cell Source', data: 'Cell Source' },
                    { title: 'Disease', data: 'Disease' },
                    { title: 'Experiment Type', data: 'Experiment Type' }
                ],
                searching: true, paging: true, pageLength: 10, lengthMenu: [10,25,50,100], scrollX: true,
                language: { paginate: { first:'<<', previous:'<', next:'>', last:'>>' } }
            });
        })
        .catch(function(error) {
            clearInterval(progressInterval);
            loader.style.display = 'none';
            progressContainer.style.display = 'none';
            progressBar.style.width = '0%';
            results.innerHTML = '<div class="alert alert-danger" style="border-radius:10px;">Network error. Please try again.</div>';
        });
    }

    queryForm.addEventListener('submit', query_content);

    document.querySelectorAll('.example-btn-small').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('textarea[name="query"]').value = e.target.dataset.query;
        });
    });

    <?php if (isset($_GET['query'])) { ?>
        $("#query").val("<?php echo htmlspecialchars($_GET['query'], ENT_QUOTES); ?>");
        $("#submit").click();
    <?php } ?>
});
</script>

</body>
</html>
