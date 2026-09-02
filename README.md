# ENdb 2.0

ENdb 2.0 is a manually curated knowledge base of experimentally validated enhancers. It catalogs enhancer evidence across diseases, tissues, cell types, cell lines, species, transcription factors, target genes, and validation experiments.

According to the ENdb 2.0 homepage, the database contains:

- **3,523** experimentally validated enhancers
- **1,192** cell lines
- **66** tissues
- **112** diseases
- **148** cell types
- Five species: *Homo sapiens*, *Mus musculus*, *Danio rerio*, *Drosophila melanogaster*, and *Gallus gallus*

Every genomic coordinate in the database is intended to be backed by manually reviewed functional evidence from the original literature.

## Main functions

- Browse and search enhancer records
- Query by disease, tissue, cell type, cell line, transcription factor, or target gene
- View enhancer details and supporting experimental evidence
- Display top-ranked diseases, tissues, cell types, transcription factors, and target genes
- Perform pathway enrichment and identifier conversion analyses
- Use an optional natural-language enhancer query interface

## Repository scope

This repository is a **code-only release** of the ENdb 2.0 PHP application. It intentionally excludes:

- Database contents, SQL dumps, CSV/TSV/BED files, and downloadable datasets
- Database credentials and `public/conn.php`
- API keys, tokens, private keys, and environment files
- Uploaded files, caches, logs, backups, and temporary files
- Images, fonts, third-party front-end libraries, generated assets, and `node_modules`

The repository is therefore not a complete production deployment or a copy of the ENdb data resource.

## Project structure

```text
Analysis/    Analysis endpoints, enrichment tools, and AI-query code
css/         Project-specific site styles
js/          Project-specific site JavaScript
public/      Shared layout, configuration example, and import logic
search/      Search result and enhancer detail endpoints
submit/      Submission endpoint
*.php        Main pages for browsing, searching, help, download, and contact
```

## Database configuration

Copy the safe example locally and keep the real connection file untracked:

```bash
cp public/conn.example.php public/conn.php
```

Configure these environment variables in the web-server runtime:

```text
ENDB_DB_HOST
ENDB_DB_PORT
ENDB_DB_USER
ENDB_DB_PASSWORD
ENDB_DB_NAME
```

`public/conn.php` is ignored by Git and must never be committed.

## Optional AI query configuration

The natural-language query endpoint reads its key from:

```text
DEEPSEEK_API_KEY
```

If this variable is not configured, the endpoint returns a configuration error without exposing a secret.

## Optional data import script

`public/import_enhancer.py` reads its CSV path and database settings from environment variables:

```text
ENDB_CSV_FILE
ENDB_DB_HOST
ENDB_DB_PORT
ENDB_DB_USER
ENDB_DB_PASSWORD
ENDB_DB_NAME
```

> **Warning:** the current importer clears the `enhancer_main` table before importing. Review it and back up the target database before use. No input data is included in this repository.

## Requirements

- PHP with the MySQLi extension
- MySQL-compatible database
- A web server configured to serve the application directory
- The third-party front-end packages referenced by the templates, supplied separately for deployment
- Python 3 and `PyMySQL` only when using the optional import script

## Website

The homepage references the ENdb website at:

<http://www.licpathway.net/ENdb/index.php>
