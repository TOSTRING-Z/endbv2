<style>
/* ===== Global Image Fix ===== */
img.img-fluid { width: 100%; }

/* ===== Navbar Enhancements ===== */
.navbar-ends {
    background: linear-gradient(135deg, #0f2c26 0%, #1a4a3e 50%, #1d5346 100%);
    box-shadow: 0 2px 24px rgba(0,0,0,0.18);
    padding: 0.45rem 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.navbar-ends .container { max-width: 1260px; }

.navbar-ends .navbar-brand {
    font-family: 'Segoe UI', system-ui, sans-serif;
    padding: 0;
    margin-right: 2.2rem;
}
.navbar-ends .brand-en {
    color: #e8e8e8;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}
.navbar-ends .brand-db {
    background: linear-gradient(135deg, #5ee7b8 0%, #3ddc97 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.65rem;
    font-weight: 700;
}
.navbar-ends .brand-ver {
    color: #ffc65e;
    font-size: 0.75rem;
    font-weight: 700;
    vertical-align: super;
    margin-left: 1px;
}

.navbar-ends .nav-link {
    color: rgba(255,255,255,0.78) !important;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.55rem 0.9rem !important;
    border-radius: 8px;
    transition: all 0.22s ease;
    letter-spacing: 0.15px;
    position: relative;
}
.navbar-ends .nav-link:hover {
    color: #fff !important;
    background: rgba(255,255,255,0.08);
}
.navbar-ends .nav-link.nav-active {
    color: #ffc65e !important;
    background: rgba(255,198,94,0.1);
}

.navbar-ends .nav-link i {
    font-size: 0.95rem;
    margin-right: 5px;
    opacity: 0.8;
}

.navbar-ends .dropdown-toggle::after {
    font-size: 0.65rem;
    margin-left: 4px;
    vertical-align: 0.1em;
}

.navbar-ends .dropdown-menu {
    background: #fff;
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.14);
    padding: 0.5rem 0;
    margin-top: 0.65rem;
    min-width: 320px;
    animation: fadeDown 0.2s ease;
}
@keyframes fadeDown {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}
.navbar-ends .dropdown-item {
    font-size: 0.875rem;
    padding: 0.6rem 1.25rem;
    color: #32325d;
    font-weight: 500;
    transition: all 0.15s;
}
.navbar-ends .dropdown-item:hover {
    background: #f5f9f7;
    color: #1a4a3e;
    padding-left: 1.5rem;
}
.navbar-ends .dropdown-item i {
    margin-right: 7px;
    color: #418679;
    width: 18px;
    text-align: center;
}

.navbar-ends .navbar-toggler {
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 0.4rem 0.65rem;
}
.navbar-ends .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255,255,255,0.8)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

@media (max-width: 991px) {
    .navbar-ends .navbar-collapse {
        background: #1a3c34;
        border-radius: 8px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
    }
    .navbar-ends .nav-link {
        padding: 0.65rem 1rem !important;
        border-radius: 6px;
    }
    .navbar-ends .dropdown-menu {
        border-radius: 8px;
        box-shadow: none;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
    }
    .navbar-ends .dropdown-item {
        color: rgba(255,255,255,0.8);
    }
    .navbar-ends .dropdown-item:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
    }
    .navbar-ends .dropdown-item i {
        color: #5ee7b8;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-ends">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/ENdb/index.php">
            <span class="brand-en">EN</span><span class="brand-db">db</span><span class="brand-ver">2.0</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-ends-main"
                aria-controls="navbar-ends-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ends-main">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link nav-active" href="/ENdb/index.php">
                        <i class="ri-home-4-line"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Browse.php">
                        <i class="ri-database-2-line"></i> Browse
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Genome_Browser.php">
                        <i class="ri-global-line"></i> Genome Browser
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-bar-chart-2-line"></i> Analysis
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/ENdb/Analysis/Pathway_enrichment_analysis_of_enhancer_TF_targets.php">
                            <i class="ri-dna-line"></i> Pathway enrichment analysis of enhancer-TF targets
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/ENdb/Analysis/Enhancer_AI_Query.php">
                            <i class="ri-chat-3-line"></i> Enhancer AI query (AI-powered)
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Search.php">
                        <i class="ri-search-line"></i> Search
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Download.php">
                        <i class="ri-download-2-line"></i> Download
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Submit.php">
                        <i class="ri-upload-2-line"></i> Submit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Contact.php">
                        <i class="ri-mail-line"></i> Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ENdb/Help.php">
                        <i class="ri-question-line"></i> Help
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var current = window.location.pathname;
    var links = document.querySelectorAll('.navbar-ends .nav-link:not(.dropdown-toggle)');
    links.forEach(function(link) {
        link.classList.remove('nav-active');
        if (link.getAttribute('href') && current.indexOf(link.getAttribute('href').replace('/ENdb','')) > -1
            && link.getAttribute('href') !== '/ENdb/index.php') {
            link.classList.add('nav-active');
        }
    });
    if (current === '/ENdb/index.php' || current === '/ENdb/' || current === '/ENdb') {
        links[0].classList.add('nav-active');
    }
});
</script>
