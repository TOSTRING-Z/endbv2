#!/usr/bin/env python3
"""
ENdb 2.0 数据导入脚本 v6.0
读取 update_2026_endb_main.csv (25列)，全量导入 enhancer_main 表 (26列含Enhancer_id)
"""
import csv
import os
import sys
import pymysql

CSV_FILE = os.environ.get("ENDB_CSV_FILE")
DB_HOST = os.environ.get("ENDB_DB_HOST")
DB_PORT = int(os.environ.get("ENDB_DB_PORT", "3306"))
DB_USER = os.environ.get("ENDB_DB_USER")
DB_PASS = os.environ.get("ENDB_DB_PASSWORD")
DB_NAME = os.environ.get("ENDB_DB_NAME")

# CSV 列索引(0-based) → DB 列名（全部 25 列，含 DOID）
CSV_TO_DB = [
    (0,  "Year"),
    (1,  "PMID"),
    (2,  "Title"),
    (3,  "Species"),
    (4,  "Genome_Build"),
    (5,  "Chromosome"),
    (6,  "Start_position"),
    (7,  "End_position"),
    (8,  "TF"),
    (9,  "Target_Gene"),
    (10, "Enhancer_type"),
    (11, "Regulatory_State"),
    (12, "`Condition`"),
    (13, "Disease_Name"),
    (14, "MONDO"),
    (15, "DOID"),
    (16, "Tissue"),
    (17, "Tissue_Ontology_ID"),
    (18, "Cell_Source"),
    (19, "CVCL_ID"),
    (20, "Cell_Type"),
    (21, "Cell_Ontology_ID"),
    (22, "Experiment_Type"),
    (23, "High_Throughput_Method"),
    (24, "Low_Throughput_Method"),
]

INSERT_SQL = "INSERT INTO enhancer_main (Enhancer_id, {cols}) VALUES ({vals})".format(
    cols=", ".join(c[1] for c in CSV_TO_DB),
    vals=", ".join(["%s"] * (len(CSV_TO_DB) + 1))
)


def normalize_enhancer_type(raw):
    """统一 Enhancer / Super-enhancer 分类"""
    if not raw:
        return "Enhancer"
    r = raw.strip().lower()
    if r in ("super-enhancer", "se", "super_enhancer", "super enhancer"):
        return "Super-enhancer"
    if r == "enhancer":
        return "Enhancer"
    return raw.strip()


def read_csv(csv_file):
    """读取 CSV，不去重，保留所有行"""
    rows = []
    with open(csv_file, encoding="ISO-8859-1") as f:
        reader = csv.reader(f)
        headers = next(reader)
        print(f"  CSV 头部: {len(headers)} 列")
        for row in reader:
            if len(row) < 25:
                continue
            rows.append(row)
    print(f"  读取 {len(rows)} 条")
    return rows


def next_id(cur):
    """生成下一个 Enhancer_id (E_00001 格式)"""
    cur.execute("SELECT MAX(Enhancer_id) FROM enhancer_main")
    row = cur.fetchone()
    if row and row[0]:
        try:
            # 兼容 E_01_0019 和 E_00001 两种格式
            return int(row[0].split("_")[-1]) + 1
        except (ValueError, IndexError):
            pass
    return 1


def build_row(csv_row, nid):
    """构建一行 INSERT 数据"""
    eid = f"E_{nid:05d}"
    vals = [eid]
    for idx, _ in CSV_TO_DB:
        val = csv_row[idx].strip() if idx < len(csv_row) else ""
        if idx == 10:
            val = normalize_enhancer_type(val)
        vals.append(val)
    return vals


def main():
    required = {
        "ENDB_CSV_FILE": CSV_FILE,
        "ENDB_DB_HOST": DB_HOST,
        "ENDB_DB_USER": DB_USER,
        "ENDB_DB_PASSWORD": DB_PASS,
        "ENDB_DB_NAME": DB_NAME,
    }
    missing = [name for name, value in required.items() if not value]
    if missing:
        raise RuntimeError("Missing required environment variables: " + ", ".join(missing))

    print("=" * 50)
    print("ENdb 2.0 数据导入 v6.0")
    print(f"CSV: {CSV_FILE}")

    rows = read_csv(CSV_FILE)

    conn = pymysql.connect(host=DB_HOST, port=DB_PORT, user=DB_USER, password=DB_PASS,
                           database=DB_NAME, charset="utf8mb4")
    cur = conn.cursor()

    # 清空旧数据
    cur.execute("TRUNCATE TABLE enhancer_main")
    print("  已清空 enhancer_main 表")

    nid = 1
    batch = []
    total = 0
    for r in rows:
        vals = build_row(r, nid)
        batch.append(vals)
        nid += 1
        total += 1

    cur.executemany(INSERT_SQL, batch)
    conn.commit()
    print(f"  成功导入 {total} 条记录")
    print(f"  Enhancer_id 范围: E_00001 ~ E_{nid-1:05d}")

    cur.close()
    conn.close()
    print("=" * 50)


if __name__ == "__main__":
    main()
