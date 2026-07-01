#!/usr/bin/env python3
"""Generate Cara Pembuatan SIDUL.docx using python-docx."""

from docx import Document
from docx.shared import Inches, Pt, Cm, RGBColor, Emu
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.enum.table import WD_TABLE_ALIGNMENT
from docx.enum.style import WD_STYLE_TYPE
from docx.oxml.ns import qn, nsdecls
from docx.oxml import parse_xml
import re

doc = Document()

# ── Page Setup ──
for section in doc.sections:
    section.top_margin = Cm(2.5)
    section.bottom_margin = Cm(2.5)
    section.left_margin = Cm(2.5)
    section.right_margin = Cm(2.5)

# ── Style Definitions ──
style = doc.styles['Normal']
font = style.font
font.name = 'Calibri'
font.size = Pt(11)
style.paragraph_format.space_after = Pt(6)
style.paragraph_format.line_spacing = 1.15

# Title style
title_style = doc.styles['Title']
title_style.font.name = 'Calibri'
title_style.font.size = Pt(26)
title_style.font.bold = True
title_style.font.color.rgb = RGBColor(0x1a, 0x36, 0x5d)
title_style.paragraph_format.space_after = Pt(8)

# Heading styles
for level, (size, color) in {
    1: (18, '1a365d'), 2: (14, '2b6cb0'), 3: (12, '2d3748')
}.items():
    hs = doc.styles[f'Heading {level}']
    hs.font.name = 'Calibri'
    hs.font.size = Pt(size)
    hs.font.bold = True
    hs.font.color.rgb = RGBColor(*bytes.fromhex(color))
    hs.paragraph_format.space_before = Pt(18 if level == 1 else 14)
    hs.paragraph_format.space_after = Pt(8)

# Code style
code_style = doc.styles.add_style('CodeBlock', WD_STYLE_TYPE.PARAGRAPH)
code_style.font.name = 'Consolas'
code_style.font.size = Pt(8.5)
code_style.font.color.rgb = RGBColor(0x1a, 0x20, 0x2c)
code_style.paragraph_format.space_after = Pt(0)
code_style.paragraph_format.space_before = Pt(0)
code_style.paragraph_format.line_spacing = 1.0
code_style.paragraph_format.left_indent = Cm(1)

# Inline code character style
inline_code = doc.styles.add_style('InlineCode', WD_STYLE_TYPE.CHARACTER)
inline_code.font.name = 'Consolas'
inline_code.font.size = Pt(9.5)
inline_code.font.color.rgb = RGBColor(0xc7, 0x25, 0x4e)

# ── Helper Functions ──
def add_para(text, style_name='Normal', bold=False, italic=False, size=None, color=None, alignment=None, space_after=None):
    p = doc.add_paragraph(style=style_name)
    run = p.add_run(text)
    if bold:
        run.bold = True
    if italic:
        run.italic = True
    if size:
        run.font.size = Pt(size)
    if color:
        run.font.color.rgb = RGBColor(*bytes.fromhex(color))
    if alignment is not None:
        p.alignment = alignment
    if space_after is not None:
        p.paragraph_format.space_after = Pt(space_after)
    return p

def add_code(text):
    """Add code block (multi-line)."""
    lines = text.strip().split('\n')
    for line in lines:
        p = doc.add_paragraph(style='CodeBlock')
        # Escape < and > for display
        escaped = line.replace('&', '&amp;').replace('<', '&lt;').replace('>', '&gt;')
        run = p.add_run(escaped)
        run.font.name = 'Consolas'
        run.font.size = Pt(8.5)
        run.font.color.rgb = RGBColor(0x1a, 0x20, 0x2c)
    # spacer paragraph
    sp = doc.add_paragraph()
    sp.paragraph_format.space_after = Pt(2)
    sp.paragraph_format.space_before = Pt(0)

def add_bullet(text, level=0):
    p = doc.add_paragraph(style='List Bullet')
    p.clear()
    run = p.add_run(text)
    run.font.name = 'Calibri'
    run.font.size = Pt(11)
    if level > 0:
        p.paragraph_format.left_indent = Cm(1.5 * level)
    p.paragraph_format.space_after = Pt(2)

def add_numbered(text, num):
    p = doc.add_paragraph()
    p.paragraph_format.space_after = Pt(2)
    p.paragraph_format.left_indent = Cm(1)
    run = p.add_run(f'{num}. ')
    run.bold = True
    run.font.size = Pt(11)
    run = p.add_run(text)
    run.font.size = Pt(11)

def set_cell_shading(cell, color):
    shading_elm = parse_xml(f'<w:shd {nsdecls("w")} w:fill="{color}"/>')
    cell._tc.get_or_add_tcPr().append(shading_elm)

def add_table(headers, rows, col_widths=None):
    """Create a formatted table."""
    table = doc.add_table(rows=1, cols=len(headers))
    table.style = 'Table Grid'
    table.alignment = WD_TABLE_ALIGNMENT.CENTER

    # Header row
    hdr_cells = table.rows[0].cells
    for i, header in enumerate(headers):
        hdr_cells[i].text = ''
        p = hdr_cells[i].paragraphs[0]
        p.alignment = WD_ALIGN_PARAGRAPH.CENTER
        run = p.add_run(header)
        run.bold = True
        run.font.size = Pt(9.5)
        run.font.name = 'Calibri'
        run.font.color.rgb = RGBColor(0xFF, 0xFF, 0xFF)
        set_cell_shading(hdr_cells[i], '2b6cb0')

    # Data rows
    for row_idx, row_data in enumerate(rows):
        row = table.add_row()
        cells = row.cells
        for col_idx, cell_text in enumerate(row_data):
            cells[col_idx].text = ''
            p = cells[col_idx].paragraphs[0]
            run = p.add_run(str(cell_text))
            run.font.size = Pt(9)
            run.font.name = 'Calibri'
            if row_idx % 2 == 1:
                set_cell_shading(cells[col_idx], 'f7fafc')
        # set cell vertical alignment
        for cell in cells:
            tc = cell._tc
            tcPr = tc.get_or_add_tcPr()
            tcVAlign = parse_xml(f'<w:vAlign {nsdecls("w")} w:val="center"/>')
            tcPr.append(tcVAlign)

    # Set column widths
    if col_widths:
        for row in table.rows:
            for i, width in enumerate(col_widths):
                if i < len(row.cells):
                    row.cells[i].width = Cm(width)

    doc.add_paragraph()  # spacer
    return table

def add_mixed_para(parts, alignment=None, space_after=None):
    """Add paragraph with mixed formatting. parts = [(text, bold, italic, style), ...]"""
    p = doc.add_paragraph()
    if alignment is not None:
        p.alignment = alignment
    if space_after is not None:
        p.paragraph_format.space_after = Pt(space_after)
    for part in parts:
        text = part[0]
        bold = part[1] if len(part) > 1 else False
        italic = part[2] if len(part) > 2 else False
        style_name = part[3] if len(part) > 3 else None
        run = p.add_run(text)
        if bold:
            run.bold = True
        if italic:
            run.italic = True
        if style_name:
            run.font.name = style_name
        run.font.size = Pt(11)
    return p


# ════════════════════════════════════════════════════════════
#  COVER PAGE
# ════════════════════════════════════════════════════════════

doc.add_paragraph()
doc.add_paragraph()
doc.add_paragraph()

add_para('SIDUL', bold=True, size=28, color='1a365d', alignment=WD_ALIGN_PARAGRAPH.CENTER, space_after=0)
add_para('Sistem Informasi Dual Learning', size=16, color='2b6cb0', alignment=WD_ALIGN_PARAGRAPH.CENTER, space_after=24)
add_para('Dokumen Penjelasan Pembuatan Aplikasi', size=14, color='4a5568', alignment=WD_ALIGN_PARAGRAPH.CENTER, space_after=4)
add_para('Dari Setup Awal Hingga Pengkodean', size=12, color='718096', alignment=WD_ALIGN_PARAGRAPH.CENTER, space_after=36)

doc.add_paragraph()
add_para('Disusun untuk persiapan sidang / pertanyaan dosen penguji', italic=True, size=10, color='a0aec0', alignment=WD_ALIGN_PARAGRAPH.CENTER, space_after=2)
add_para('2026', size=11, color='a0aec0', alignment=WD_ALIGN_PARAGRAPH.CENTER)

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  TABLE OF CONTENTS
# ════════════════════════════════════════════════════════════

doc.add_heading('Daftar Isi', level=1)

toc_items = [
    (1, '1. Konsep & Latar Belakang'),
    (1, '2. Tech Stack'),
    (1, '3. Persiapan Lingkungan Development'),
    (1, '4. Setup Proyek Laravel'),
    (2, '   4.1 Buat Project Baru'),
    (2, '   4.2 Install Dependency Tambahan'),
    (2, '   4.3 Install Frontend Dependency'),
    (2, '   4.4 Konfigurasi Environment'),
    (2, '   4.5 Konfigurasi Tailwind CSS v4 + DaisyUI'),
    (1, '5. Database Design (Migration Pipeline)'),
    (2, '   5.1-5.9 Sembilan Tabel Migration'),
    (1, '6. Model (Eloquent ORM)'),
    (1, '7. Routing Architecture'),
    (1, '8. Middleware'),
    (1, '9. Controller & Service Layer'),
    (1, '10. View (Blade + Tailwind + DaisyUI)'),
    (1, '11. Seeder & Data Uji'),
    (1, '12. Alur Program Lengkap'),
    (1, '13. Fitur Cetak PDF'),
    (1, '14. Commands yang Sering Digunakan'),
    (1, '15. Fitur Keamanan'),
    (1, '16. Ringkasan Urutan Pembuatan'),
    (1, '17. Prediksi Pertanyaan Dosen Penguji'),
]
for level, text in toc_items:
    sz = 11 if level == 1 else 10.5
    add_para(text, size=sz, color='2d3748' if level == 1 else '4a5568', space_after=3)

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  1. KONSEP & LATAR BELAKANG
# ════════════════════════════════════════════════════════════

doc.add_heading('1. Konsep & Latar Belakang', level=1)

doc.add_paragraph(
    'SIDUL (Sistem Informasi Dual Learning) adalah platform manajemen magang modern yang '
    'mengintegrasikan ekosistem kerja sama antara Mahasiswa, Dosen Pembimbing, dan Operator '
    'Akademik. Aplikasi ini dibangun dengan fokus pada efisiensi administrasi, monitoring progres '
    'secara real-time, dan unifikasi dokumen dalam satu pintu.')

doc.add_paragraph('Terdapat 4 role pengguna dalam sistem ini:')

add_table(
    ['Role', 'Tugas Utama'],
    [
        ['Mahasiswa', 'Daftar magang, isi logbook harian, upload laporan, ajukan edit data'],
        ['Dosen', 'Monitoring mahasiswa bimbingan, review & approve laporan, rekomendasi'],
        ['Operator', 'Atur periode magang, plotting dosen pembimbing, approve/reject edit request'],
        ['Admin', 'CRUD user (kelola seluruh akun sistem)'],
    ],
    col_widths=[3, 12]
)

doc.add_paragraph(
    'Tujuan utama: menggantikan sistem manual berbasis kertas menjadi sistem digital yang '
    'terpusat, real-time, dan mudah diakses oleh seluruh pemangku kepentingan.')

# ════════════════════════════════════════════════════════════
#  2. TECH STACK
# ════════════════════════════════════════════════════════════

doc.add_heading('2. Tech Stack', level=1)

doc.add_paragraph(
    'Pemilihan teknologi pada SIDUL didasarkan pada kebutuhan pengembangan cepat, kemudahan '
    'maintenance, dan ekosistem yang matang.')

add_table(
    ['Komponen', 'Teknologi', 'Alasan Pemilihan'],
    [
        ['Core Framework', 'Laravel 12 (PHP 8.3+)', 'Fitur lengkap (ORM, migration, auth, blade), komunitas besar'],
        ['Frontend', 'Blade + Tailwind CSS 4 + DaisyUI 5', 'Komponen UI siap pakai, responsif, kustomisasi mudah'],
        ['Database (Dev)', 'SQLite', 'Ringan, tanpa instalasi server, cocok development lokal'],
        ['Database (Prod)', 'MySQL', 'Stabil, performa tinggi untuk production'],
        ['PDF Engine', 'Barryvdh DomPDF', 'Generate PDF dari HTML Blade, mudah dikustomisasi'],
        ['Word Engine', 'PhpOffice/PHPWord', 'Generate dokumen Word (surat pengantar)'],
        ['Build Tool', 'Vite + Laravel Vite Plugin', 'HMR cepat, bundling modern, konfigurasi minimal'],
    ],
    col_widths=[3.5, 4.5, 7]
)

# ════════════════════════════════════════════════════════════
#  3. PERSIAPAN LINGKUNGAN
# ════════════════════════════════════════════════════════════

doc.add_heading('3. Persiapan Lingkungan Development', level=1)

doc.add_paragraph('Tools yang harus diinstall sebelum memulai pengembangan:')

tools = [
    'PHP 8.3+ \u2014 dengan ekstensi: openssl, pdo, mbstring, xml, curl, fileinfo, gd',
    'Composer \u2014 dependency manager PHP',
    'Node.js + npm \u2014 untuk frontend build tools dan package management',
    'Git \u2014 version control system',
    'Text Editor (VS Code direkomendasikan) \u2014 dengan ekstensi Laravel, PHP Intelephense',
]
for t in tools:
    add_bullet(t)

doc.add_paragraph('Perintah untuk mengecek instalasi:')
add_code('php -v\ncomposer --version\nnode -v\nnpm -v\ngit --version')

# ════════════════════════════════════════════════════════════
#  4. SETUP PROYEK LARAVEL
# ════════════════════════════════════════════════════════════

doc.add_heading('4. Setup Proyek Laravel', level=1)

doc.add_heading('4.1 Buat Project Baru', level=2)
doc.add_paragraph('Gunakan Composer untuk membuat proyek Laravel baru dengan nama SIDUL:')
add_code('composer create-project laravel/laravel SIDUL\ncd SIDUL')

doc.add_heading('4.2 Install Dependency Tambahan', level=2)
add_code('# DomPDF - generate PDF\ncomposer require barryvdh/laravel-dompdf\n\n# PHPWord - generate DOCX\ncomposer require phpoffice/phpword')

doc.add_heading('4.3 Install Frontend Dependency', level=2)
add_code('npm install\n\n# Tailwind CSS v4 + DaisyUI v5\nnpm install tailwindcss @tailwindcss/vite daisyui\n\n# Vite plugin untuk Laravel\nnpm install laravel-vite-plugin vite\n\n# Axios - HTTP client\nnpm install axios\n\n# Concurrently - multi-process runner\nnpm install concurrently')

doc.add_heading('4.4 Konfigurasi Environment', level=2)
add_code('cp .env.example .env\nphp artisan key:generate')
doc.add_paragraph('Edit file .env untuk konfigurasi database. Untuk development lokal dengan SQLite:')
add_code('DB_CONNECTION=sqlite')
doc.add_paragraph('Untuk production dengan MySQL:')
add_code('DB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=sidul\nDB_USERNAME=root\nDB_PASSWORD=...')

doc.add_heading('4.5 Konfigurasi Tailwind CSS v4 + DaisyUI', level=2)

add_para('File vite.config.js:', bold=True, size=10.5)
add_code("import { defineConfig } from 'vite';\nimport laravel from 'laravel-vite-plugin';\nimport tailwindcss from '@tailwindcss/vite';\n\nexport default defineConfig({\n    plugins: [\n        laravel({ input: ['resources/css/app.css'], refresh: true }),\n        tailwindcss(),\n    ],\n});")

add_para('File resources/css/app.css:', bold=True, size=10.5)
add_code('@import "tailwindcss";\n@plugin "daisyui";')

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  5. DATABASE DESIGN
# ════════════════════════════════════════════════════════════

doc.add_heading('5. Database Design (Migration Pipeline)', level=1)

doc.add_paragraph(
    'Pendekatan pembuatan database: migration dibuat satu per satu secara berurutan karena adanya '
    'foreign key constraints. Total terdapat 9 tabel aktif dalam sistem.')

# 5.1
doc.add_heading('5.1 Migration 1 \u2014 Users Table', level=2)
doc.add_paragraph(
    'Tabel users menggunakan konsep Single-Table Inheritance, di mana seluruh role (admin, operator, '
    'dosen, mahasiswa) disimpan dalam satu tabel dengan kolom role sebagai discriminator.')
add_code("Schema::create('users', function (Blueprint \$table) {\n    \$table->id();\n    \$table->string('username')->unique();\n    \$table->string('password');\n    \$table->enum('role', ['admin', 'operator', 'dosen', 'mahasiswa']);\n    \$table->rememberToken();\n    \$table->timestamps();\n});")
add_para(
    'Keputusan desain: Single-table inheritance \u2014 lebih sederhana daripada polymorphic relationship. '
    'Data spesifik role disimpan di tabel terpisah (mahasiswas, dosens).',
    italic=True, size=10, color='718096', space_after=6)

# 5.2
doc.add_heading('5.2 Migration 2 \u2014 Dosens Table', level=2)
add_code("Schema::create('dosens', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('user_id')->constrained()->onDelete('cascade');\n    \$table->string('nik')->unique();\n    \$table->string('nama');\n    \$table->timestamps();\n});")

# 5.3
doc.add_heading('5.3 Migration 3 \u2014 Mahasiswas Table', level=2)
add_code("Schema::create('mahasiswas', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('user_id')->constrained()->onDelete('cascade');\n    \$table->string('nim')->unique();\n    \$table->string('nama');\n    \$table->string('konsentrasi')->nullable();\n    \$table->string('no_hp')->nullable();\n    \$table->enum('status_magang', ['Pending', 'Approve', 'Ditolak'])->default('Pending');\n    \$table->foreignId('dosen_wali_id')->nullable()->constrained('dosens')->nullOnDelete();\n    \$table->timestamps();\n});")

# 5.4
doc.add_heading('5.4 Migration 4 \u2014 Magangs Table', level=2)
add_code("Schema::create('magangs', function (Blueprint \$table) {\n    \$table->id();\n    \$table->string('kode_magang')->unique();\n    \$table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosens')->nullOnDelete();\n    \$table->enum('status_magang', ['Pending', 'Aktif', 'Selesai'])->default('Pending');\n    \$table->string('perusahaan');\n    \$table->string('alamat');\n    \$table->string('tipe_magang');\n    \$table->string('konsentrasi');\n    \$table->date('tanggal_mulai');\n    \$table->date('tanggal_selesai');\n    \$table->timestamps();\n});")

# 5.5
doc.add_heading('5.5 Migration 5 \u2014 Peserta Magangs (Pivot)', level=2)
doc.add_paragraph(
    'Tabel pivot untuk relasi many-to-many antara mahasiswa dan magang. Satu mahasiswa bisa '
    'mengikuti satu magang, satu magang bisa diikuti banyak mahasiswa (mendukung magang kelompok).')
add_code("Schema::create('peserta_magangs', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('magang_id')->constrained()->onDelete('cascade');\n    \$table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');\n    \$table->boolean('is_ketua')->default(false);\n    \$table->timestamps();\n});")

# 5.6
doc.add_heading('5.6 Migration 6 \u2014 Logbooks Table', level=2)
add_code("Schema::create('logbooks', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('magang_id')->constrained()->onDelete('cascade');\n    \$table->date('tanggal');\n    \$table->text('kegiatan');\n    \$table->string('dokumentasi')->nullable();\n    \$table->timestamps();\n});")

# 5.7
doc.add_heading('5.7 Migration 7 \u2014 Laporans Table', level=2)
add_code("Schema::create('laporans', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('magang_id')->constrained()->onDelete('cascade');\n    \$table->string('judul');\n    \$table->text('abstrak')->nullable();\n    \$table->string('file_laporan')->nullable();\n    \$table->enum('status', ['draft', 'review', 'revisi', 'approved'])->default('draft');\n    \$table->text('catatan_dosen')->nullable();\n    \$table->timestamps();\n});")

# 5.8
doc.add_heading('5.8 Migration 8 \u2014 Settings Table', level=2)
doc.add_paragraph('Key-value store untuk konfigurasi sistem, seperti buka/tutup periode pendaftaran magang.')
add_code("Schema::create('settings', function (Blueprint \$table) {\n    \$table->id();\n    \$table->string('key')->unique();\n    \$table->text('value')->nullable();\n    \$table->timestamps();\n});")

# 5.9
doc.add_heading('5.9 Migration 9 \u2014 Edit Requests Table', level=2)
doc.add_paragraph(
    'Menyediakan audit trail untuk perubahan data mahasiswa. Setiap perubahan harus melalui '
    'approval operator terlebih dahulu.')
add_code("Schema::create('edit_requests', function (Blueprint \$table) {\n    \$table->id();\n    \$table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');\n    \$table->string('field');\n    \$table->longText('old_value')->nullable();\n    \$table->longText('new_value')->nullable();\n    \$table->string('target_type')->nullable();\n    \$table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');\n    \$table->timestamps();\n});")

# 5.10
doc.add_heading('5.10 Menjalankan Migration', level=2)
add_code('php artisan migrate\n# atau untuk reset + seed:\nphp artisan migrate:fresh --seed')

# Ringkasan tabel
doc.add_heading('Ringkasan Seluruh Tabel', level=2)
add_table(
    ['No', 'Tabel', 'Fungsi'],
    [
        ['1', 'users', 'Auth & role (single-table inheritance)'],
        ['2', 'dosens', 'Data spesifik dosen (nik, nama)'],
        ['3', 'mahasiswas', 'Data spesifik mahasiswa (nim, nama, status_magang)'],
        ['4', 'magangs', 'Data magang (perusahaan, dosen pembimbing, periode)'],
        ['5', 'peserta_magangs', 'Pivot many-to-many mahasiswa-magang'],
        ['6', 'logbooks', 'Kegiatan harian mahasiswa'],
        ['7', 'laporans', 'Laporan akhir magang'],
        ['8', 'settings', 'Key-value konfigurasi sistem'],
        ['9', 'edit_requests', 'Audit trail perubahan data mahasiswa'],
    ],
    col_widths=[1, 3, 8]
)

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  6. MODEL
# ════════════════════════════════════════════════════════════

doc.add_heading('6. Model (Eloquent ORM)', level=1)

doc.add_paragraph('Model dibuat menggunakan perintah Artisan:')
add_code('php artisan make:model User\nphp artisan make:model Mahasiswa\nphp artisan make:model Dosen\nphp artisan make:model Magang\nphp artisan make:model PesertaMagang\nphp artisan make:model Logbook\nphp artisan make:model Laporan\nphp artisan make:model Setting\nphp artisan make:model EditRequest')

doc.add_heading('6.1 Relasi Antar Model', level=2)

add_para('User (single-table inheritance):', bold=True, size=10.5)
add_code("class User extends Authenticatable {\n    public function mahasiswa() { return \$this->hasOne(Mahasiswa::class); }\n    public function dosen()     { return \$this->hasOne(Dosen::class); }\n    public function isMahasiswa() { return \$this->role === 'mahasiswa'; }\n    public function isDosen()     { return \$this->role === 'dosen'; }\n    public function isOperator()  { return \$this->role === 'operator'; }\n    public function isAdmin()     { return \$this->role === 'admin'; }\n}")

add_para('Mahasiswa:', bold=True, size=10.5)
add_code("class Mahasiswa extends Model {\n    public function user()          { return \$this->belongsTo(User::class); }\n    public function dosenWali()     { return \$this->belongsTo(Dosen::class, 'dosen_wali_id'); }\n    public function pesertaMagang() { return \$this->hasOne(PesertaMagang::class); }\n}")

add_para('Magang:', bold=True, size=10.5)
add_code("class Magang extends Model {\n    public function dosenPembimbing() { return \$this->belongsTo(Dosen::class, 'dosen_pembimbing_id'); }\n    public function pesertaMagang()   { return \$this->hasMany(PesertaMagang::class); }\n    public function mahasiswas()  { return \$this->belongsToMany(Mahasiswa::class, 'peserta_magangs'); }\n    public function logbooks()    { return \$this->hasMany(Logbook::class); }\n    public function laporans()    { return \$this->hasMany(Laporan::class); }\n}")

# ════════════════════════════════════════════════════════════
#  7. ROUTING
# ════════════════════════════════════════════════════════════

doc.add_heading('7. Routing Architecture', level=1)

doc.add_paragraph(
    'Route dikelompokkan berdasarkan middleware untuk menjaga keamanan dan memudahkan maintenance. '
    'File routes/web.php berisi seluruh definisi route aplikasi.')

add_table(
    ['Group', 'Middleware', 'Controller', 'Endpoint Utama'],
    [
        ['Guest (Public)', 'guest', 'AuthController', 'GET /login, POST /login'],
        ['Auth (Logged In)', 'auth', 'AuthController', 'POST /logout, GET /dashboard'],
        ['Mahasiswa', 'auth + role:mahasiswa', 'MahasiswaController', 'dashboard, pendaftaran, logbook, laporan, edit-data'],
        ['Dosen', 'auth + role:dosen', 'DosenController', 'dashboard, monitoring, logbook, laporan, rekomendasi'],
        ['Operator', 'auth + role:operator', 'OperatorController', 'dashboard, periode, dosen-pembimbing, monitoring, edit-requests'],
        ['Admin', 'auth + role:admin', 'AdminController', 'dashboard, users CRUD'],
    ],
    col_widths=[2.5, 2.5, 3, 5.5]
)

add_para(
    'Design pattern: Route grouping dengan middleware per group memastikan setiap route hanya '
    'bisa diakses oleh role yang berwenang.',
    italic=True, size=10, color='718096', space_after=6)

# ════════════════════════════════════════════════════════════
#  8. MIDDLEWARE
# ════════════════════════════════════════════════════════════

doc.add_heading('8. Middleware', level=1)

doc.add_heading('8.1 RoleMiddleware', level=2)
doc.add_paragraph(
    'Filter akses berdasarkan role user. Jika role tidak cocok, user di-redirect ke dashboard '
    'masing-masing (bukan menampilkan 403).')
add_code("class RoleMiddleware {\n    public function handle(Request \$request, Closure \$next, string \$role) {\n        if (!Auth::check()) return redirect()->route('login');\n        if (Auth::user()->role !== \$role) {\n            return redirect()->route(Auth::user()->role . '.dashboard');\n        }\n        return \$next(\$request);\n    }\n}")

doc.add_heading('8.2 MockAuthMiddleware (Development)', level=2)
doc.add_paragraph(
    'Middleware khusus development yang me-bypass proses login untuk mempercepat testing. '
    'User auto-login sebagai role tertentu.')

doc.add_paragraph('Pendaftaran middleware di bootstrap/app.php:')
add_code("->withMiddleware(function (Middleware \$middleware) {\n    \$middleware->alias([\n        'role' => \\App\\Http\\Middleware\\RoleMiddleware::class,\n    ]);\n})")

# ════════════════════════════════════════════════════════════
#  9. CONTROLLER & SERVICE
# ════════════════════════════════════════════════════════════

doc.add_heading('9. Controller & Service Layer', level=1)

doc.add_heading('9.1 Arsitektur Controller', level=2)
doc.add_paragraph(
    'Setiap controller menangani satu role spesifik. Controller hanya bertugas sebagai entry '
    'point dan delegasi ke Service Layer.')

add_table(
    ['Controller', 'Method Utama'],
    [
        ['AuthController', 'showLogin(), login(), logout()'],
        ['MahasiswaController', 'dashboard(), pendaftaran(), storePendaftaran(), suratPengantar(), logbook(), storeLogbook(), cetakLogbook(), laporan(), storeLaporan(), cetakLaporan(), editData(), storeEditData()'],
        ['DosenController', 'dashboard(), monitoring(), logbook(), laporan(), approveLaporan(), rekomendasi(), rekomendasikan(), tolakRekomendasi()'],
        ['OperatorController', 'dashboard(), togglePeriode(), dosenPembimbing(), assignDosen(), destroy(), monitoring(), laporan(), editRequests(), approveEdit(), rejectEdit()'],
        ['AdminController', 'dashboard(), users(), storeUser(), destroyUser()'],
    ],
    col_widths=[4, 10]
)

doc.add_heading('9.2 Service Layer Pattern', level=2)
doc.add_paragraph(
    'Logika bisnis dipisahkan ke Service Layer untuk menjaga controller tetap ramping dan '
    'memudahkan unit testing.')

add_table(
    ['Service', 'Fungsi'],
    [
        ['MahasiswaService', 'Validasi pendaftaran, CRUD logbook, simpan/submit laporan'],
        ['DosenService', 'Review & approve laporan, feedback catatan dosen'],
        ['OperatorService', 'Manajemen periode, plotting dosen pembimbing'],
        ['EditRequestService', 'Ajukan, approve, reject edit data mahasiswa'],
        ['PeriodeService', 'Cek status periode magang (open/closed)'],
        ['ServiceResult', 'Value object untuk standardisasi response success/error'],
    ],
    col_widths=[4, 10]
)

add_para('Contoh alur \u2014 Mahasiswa daftar magang:', bold=True, size=10.5)
add_code("Route -> MahasiswaController@storePendaftaran\n  -> MahasiswaService@daftar()\n    -> Validasi periode (PeriodeService)\n    -> Validasi NIM / duplikasi\n    -> Create Magang + PesertaMagang\n    -> Update status_magang = 'Pending'\n  -> Return redirect dengan session success/error")

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  10. VIEW
# ════════════════════════════════════════════════════════════

doc.add_heading('10. View (Blade + Tailwind + DaisyUI)', level=1)

doc.add_paragraph('Struktur direktori view:')

dirs = [
    'layouts/ \u2014 main.blade.php (layout utama dengan navbar, sidebar, konten), guest.blade.php (halaman login)',
    'components/ \u2014 navbar.blade.php, sidebar.blade.php, card.blade.php (komponen reusable)',
    'auth/ \u2014 login.blade.php',
    'mahasiswa/ \u2014 dashboard, pendaftaran, surat-pengantar, logbook, laporan, edit-data',
    'dosen/ \u2014 dashboard, monitoring, logbook, laporan, rekomendasi',
    'operator/ \u2014 dashboard, periode, dosen-pembimbing, monitoring, laporan, edit-requests',
    'admin/ \u2014 dashboard, users',
    'pdf/ \u2014 template untuk cetak PDF (logbook, laporan)',
]
for d in dirs:
    add_bullet(d)

doc.add_paragraph('Layout utama menggunakan sistem komponen Blade dengan DaisyUI:')
add_code("<!DOCTYPE html>\n<html>\n<head>\n    @vite('resources/css/app.css')\n</head>\n<body class=\"min-h-screen bg-base-200\">\n    <x-navbar />\n    <div class=\"flex\">\n        <x-sidebar />\n        <main class=\"flex-1 p-6\">\n            {{ \$slot }}\n        </main>\n    </div>\n</body>\n</html>")

# ════════════════════════════════════════════════════════════
#  11. SEEDER
# ════════════════════════════════════════════════════════════

doc.add_heading('11. Seeder & Data Uji', level=1)

doc.add_paragraph('Database seeder digunakan untuk mengisi data awal pengembangan:')
add_code('php artisan make:seeder DatabaseSeeder\nphp artisan make:seeder UserSeeder\nphp artisan make:seeder MahasiswaSeeder\nphp artisan make:seeder DosenSeeder')
doc.add_paragraph('Jalankan seeder:')
add_code('php artisan migrate:fresh --seed')
doc.add_paragraph('Akun uji coba yang tersedia (semua password: password123):')

add_table(
    ['Role', 'Username', 'Deskripsi'],
    [
        ['Admin', 'admin', 'Manajemen user & staf'],
        ['Operator', 'operator', 'Plotting dosen & kontrol sistem'],
        ['Dosen', '19876001', 'Monitoring & approval bimbingan'],
        ['Mahasiswa', '23.01.5029', 'Pendaftaran & update progres'],
        ['Mahasiswa', '23.01.5017', 'Pendaftaran & update progres'],
        ['Mahasiswa', '23.01.5010', 'Pendaftaran & update progres'],
    ],
    col_widths=[2.5, 3, 7]
)

# ════════════════════════════════════════════════════════════
#  12. ALUR PROGRAM
# ════════════════════════════════════════════════════════════

doc.add_heading('12. Alur Program Lengkap', level=1)

doc.add_heading('A. Alur Mahasiswa', level=2)
for item in [
    'Login \u2014 autentikasi menggunakan username dan password, redirect ke dashboard sesuai role',
    'Dashboard \u2014 melihat ringkasan status magang, jumlah logbook, status laporan',
    'Pendaftaran \u2014 mengisi form (perusahaan, alamat, tipe magang, konsentrasi, tanggal) \u2192 submit \u2192 status = "Pending"',
    'Surat Pengantar \u2014 cetak dokumen surat pengantar magang setelah pendaftaran disetujui',
    'Logbook \u2014 mengisi kegiatan harian (tanggal, deskripsi kegiatan, upload dokumentasi) \u2192 simpan',
    'Laporan \u2014 upload file laporan + judul + abstrak \u2192 bisa disimpan sebagai draft atau langsung submit ke review',
    'Edit Data \u2014 mengajukan perubahan data diri \u2192 menunggu approval operator',
]:
    add_bullet(item)

doc.add_heading('B. Alur Dosen', level=2)
for item in [
    'Login \u2014 autentikasi dan redirect ke dashboard dosen',
    'Dashboard \u2014 melihat daftar mahasiswa bimbingan dan status progres',
    'Monitoring \u2014 melihat progres mahasiswa per-perusahaan secara detail',
    'Logbook \u2014 me-review logbook harian mahasiswa bimbingan',
    'Laporan \u2014 melihat laporan yang masuk \u2192 approve atau minta revisi dengan catatan',
    'Rekomendasi \u2014 memberikan rekomendasi atau non-rekomendasi untuk mahasiswa bimbingan',
]:
    add_bullet(item)

doc.add_heading('C. Alur Operator', level=2)
for item in [
    'Login \u2014 autentikasi dan redirect ke dashboard operator',
    'Dashboard \u2014 melihat statistik sistem (jumlah mahasiswa, dosen, magang aktif)',
    'Periode \u2014 membuka atau menutup periode pendaftaran magang (toggle on/off)',
    'Dosen Pembimbing \u2014 plotting/menugaskan dosen pembimbing ke magang yang belum memiliki pembimbing',
    'Monitoring \u2014 melihat seluruh aktivitas magang di sistem',
    'Edit Requests \u2014 menyetujui atau menolak permintaan edit data dari mahasiswa',
]:
    add_bullet(item)

doc.add_heading('D. Alur Admin', level=2)
for item in [
    'Login \u2014 autentikasi dan redirect ke dashboard admin',
    'Dashboard \u2014 melihat statistik user sistem',
    'Users \u2014 CRUD (Create, Read, Update, Delete) untuk seluruh akun: admin, operator, dosen, mahasiswa',
]:
    add_bullet(item)

# ════════════════════════════════════════════════════════════
#  13. CETAK PDF
# ════════════════════════════════════════════════════════════

doc.add_heading('13. Fitur Cetak PDF', level=1)

doc.add_paragraph('Menggunakan library Barryvdh DomPDF untuk generate PDF dari view Blade:')
add_code("use Barryvdh\\DomPDF\\Facade\\Pdf;\n\npublic function cetakLogbook(Magang \$magang) {\n    \$logbooks = \$magang->logbooks()->orderBy('tanggal')->get();\n    \$pdf = Pdf::loadView('pdf.logbook', compact('magang', 'logbooks'));\n    return \$pdf->download('logbook-' . \$magang->kode_magang . '.pdf');\n}")

doc.add_paragraph(
    'Template PDF disimpan di resources/views/pdf/ menggunakan layout khusus dengan CSS styling '
    'untuk ukuran kertas dan margin yang sesuai.')

# ════════════════════════════════════════════════════════════
#  14. COMMANDS
# ════════════════════════════════════════════════════════════

doc.add_heading('14. Commands yang Sering Digunakan', level=1)

add_table(
    ['Perintah', 'Fungsi'],
    [
        ['php artisan serve', 'Menjalankan development server (http://localhost:8000)'],
        ['npm run dev', 'Menjalankan Vite dev server (HMR untuk frontend)'],
        ['php artisan migrate', 'Menjalankan seluruh migration'],
        ['php artisan migrate:fresh --seed', 'Reset database + menjalankan seeder'],
        ['php artisan db:seed', 'Menjalankan database seeder'],
        ['php artisan config:clear', 'Membersihkan cache konfigurasi'],
        ['php artisan view:clear', 'Membersihkan cache view'],
        ['php artisan optimize:clear', 'Membersihkan seluruh cache'],
        ['php artisan test', 'Menjalankan PHPUnit test'],
        ['php artisan storage:link', 'Membuat symlink storage publik'],
        ['php artisan down', 'Mengaktifkan maintenance mode'],
        ['php artisan up', 'Menonaktifkan maintenance mode'],
    ],
    col_widths=[5, 8]
)

# ════════════════════════════════════════════════════════════
#  15. KEAMANAN
# ════════════════════════════════════════════════════════════

doc.add_heading('15. Fitur Keamanan', level=1)

add_table(
    ['Aspek', 'Implementasi'],
    [
        ['Authentication', 'Session-based (Laravel default), login via AuthController'],
        ['Authorization / Role Check', 'RoleMiddleware \u2014 memeriksa role user sebelum akses route group'],
        ['CSRF Protection', '@csrf di setiap form POST (Laravel built-in)'],
        ['SQL Injection Prevention', 'Eloquent ORM \u2014 parameter binding otomatis, bukan raw query'],
        ['XSS Prevention', 'Blade {{ }} auto-escape. {!! !!} hanya digunakan pada konten trusted'],
        ['File Upload Validation', 'Validasi tipe file (mimes) dan ukuran (max) sebelum penyimpanan'],
    ],
    col_widths=[4, 10]
)

# ════════════════════════════════════════════════════════════
#  16. RINGKASAN URUTAN
# ════════════════════════════════════════════════════════════

doc.add_heading('16. Ringkasan Urutan Pembuatan', level=1)

doc.add_paragraph('Berikut adalah urutan langkah pembuatan SIDUL dari awal hingga akhir:')

steps = [
    'Instalasi Laravel via Composer (composer create-project)',
    'Setup konfigurasi database di file .env',
    'Konfigurasi Tailwind CSS v4 + DaisyUI di Vite',
    'Buat migration tabel: users \u2192 dosens \u2192 mahasiswas \u2192 magangs \u2192 peserta_magangs \u2192 logbooks \u2192 laporans \u2192 settings \u2192 edit_requests',
    'Jalankan migration (php artisan migrate)',
    'Buat Model Eloquent beserta relasi antar tabel',
    'Buat Middleware: RoleMiddleware untuk filter akses berdasarkan role',
    'Daftarkan middleware di bootstrap/app.php',
    'Buat route groups di routes/web.php',
    'Buat AuthController + halaman login',
    'Buat Controller per role (Mahasiswa, Dosen, Operator, Admin)',
    'Buat Service Layer per domain bisnis',
    'Buat View Blade untuk setiap fitur menggunakan DaisyUI',
    'Buat template PDF dengan DomPDF',
    'Buat Seeder untuk data uji',
    'Testing dan debugging',
]
for i, s in enumerate(steps, 1):
    add_numbered(s, i)

doc.add_page_break()

# ════════════════════════════════════════════════════════════
#  17. PREDIKSI PERTANYAAN
# ════════════════════════════════════════════════════════════

doc.add_heading('17. Prediksi Pertanyaan Dosen Penguji', level=1)

qa_list = [
    (
        'Q: Kenapa memilih Laravel sebagai framework?',
        'A: Laravel memiliki fitur lengkap (Eloquent ORM untuk database, Blade templating untuk '
        'frontend, built-in authentication, migration system untuk version control database). '
        'Komunitasnya besar, dokumentasi sangat baik, dan cocok untuk pengembangan aplikasi web '
        'dalam waktu singkat. Selain itu, Laravel menerapkan konsep MVC yang memisahkan logic, '
        'tampilan, dan routing sehingga kode lebih terstruktur.'
    ),
    (
        'Q: Kenapa pakai SQLite bukan MySQL?',
        'A: SQLite digunakan untuk development lokal karena ringan dan tidak perlu instalasi '
        'database server terpisah. Cukup satu file, aplikasi bisa langsung jalan. Untuk production, '
        'konfigurasi tinggal diubah ke MySQL tanpa mengubah kode sama sekali (cukup edit .env).'
    ),
    (
        'Q: Kenapa menggunakan single-table inheritance untuk User?',
        'A: Lebih sederhana daripada polymorphic relationship. Semua pengguna (admin, operator, '
        'dosen, mahasiswa) punya kesamaan dasar \u2014 username dan password untuk login. Cukup satu '
        'tabel users dengan kolom role sebagai pembeda. Data spesifik per role (seperti NIM untuk '
        'mahasiswa, NIK untuk dosen) disimpan di tabel relasi masing-masing. Pendekatan ini membuat '
        'query lebih sederhana dan mudah dimaintenance.'
    ),
    (
        'Q: Apa fungsi Service Layer? Kenapa tidak langsung di Controller saja?',
        'A: Service Layer menerapkan Separation of Concerns \u2014 controller hanya bertugas menerima '
        'request dan mengembalikan response (delegasi). Logika bisnis seperti validasi, perhitungan, '
        'dan manipulasi data ditempatkan di Service Layer. Keuntungannya: (1) Controller menjadi '
        'ramping dan mudah dibaca, (2) Logika bisnis bisa di-reuse dari berbagai controller, '
        '(3) Unit testing lebih mudah karena Service bisa dites terpisah tanpa HTTP request.'
    ),
    (
        'Q: Bagaimana mekanisme file upload dan penyimpanannya?',
        'A: Laravel menggunakan Storage facade. File disimpan di storage/app/public, kemudian '
        'dibuat symlink dengan php artisan storage:link agar bisa diakses dari web (public/storage). '
        'Validasi file dilakukan di Controller menggunakan aturan validation seperti mimes:pdf,docx '
        'dan max:10240 (10MB). Nama file di-unique-kan menggunakan timestamp + random string untuk '
        'menghindari konflik.'
    ),
    (
        'Q: Bagaimana sistem keamanan aplikasi ini?',
        'A: Beberapa lapis keamanan diterapkan: (1) CSRF Token \u2014 setiap form POST wajib menyertakan '
        '@csrf untuk mencegah cross-site request forgery. (2) Eloquent ORM menggunakan parameter '
        'binding, mencegah SQL injection. (3) Blade {{ }} secara otomatis meng-escape output HTML, '
        'mencegah XSS attacks. (4) Role Middleware memastikan user hanya bisa mengakses halaman '
        'sesuai role-nya. (5) Session-based authentication dengan regenerasi session ID setelah login.'
    ),
    (
        'Q: Fitur apa yang paling kompleks dalam sistem ini?',
        'A: Edit Request System. Mahasiswa tidak bisa langsung mengubah data mereka \u2014 harus melalui '
        'mekanisme approval. Alurnya: Mahasiswa mengajukan perubahan (menyertakan field, old_value, '
        'new_value) \u2192 status = pending \u2192 Operator melihat daftar request \u2192 Operator approve atau '
        'reject. Jika approve, sistem mengupdate data target dan mencatat audit trail. Ini memastikan '
        'setiap perubahan data terekam dan tidak disalahgunakan.'
    ),
    (
        'Q: Bagaimana cara handle banyak role di satu aplikasi?',
        'A: Menggunakan RoleMiddleware. Di routes/web.php, setiap group route diberi middleware '
        'auth + role:xxx. Middleware akan memeriksa session user dan mencocokkan role. Jika tidak '
        'cocok, user di-redirect ke dashboard masing-masing. Di sisi view, kita bisa mengecek role '
        'user dengan helper seperti auth()->user()->isMahasiswa() untuk menyesuaikan tampilan.'
    ),
    (
        'Q: Apakah ada testing? Bagaimana cara memastikan aplikasi berfungsi dengan benar?',
        'A: Ya, menggunakan PHPUnit (Laravel default). Tests mencakup fitur-fitur utama seperti '
        'login, pendaftaran, logbook, dan approval. Selain itu, ada rute dev helper '
        '(/dev/reset-to-pending, /dev/reset-to-approved) yang mempermudah reset data untuk testing '
        'berulang. Untuk E2E, bisa menggunakan Selenium atau Laravel Dusk.'
    ),
    (
        'Q: Bagaimana cara deploy aplikasi?',
        'A: Untuk production, gunakan MySQL sebagai database. Build frontend dengan npm run build. '
        'Atur environment variables di server untuk production. Gunakan web server seperti Nginx '
        'yang diarahkan ke folder public/. Pastikan storage/ dan bootstrap/cache/ writable. Untuk '
        'hosting sederhana, bisa gunakan Laravel Forge atau shared hosting yang support PHP 8.3+.'
    ),
]

for q, a in qa_list:
    add_para(q, bold=True, size=11, color='2b6cb0', space_after=2)
    add_para(a, size=10.5, space_after=10)

# ════════════════════════════════════════════════════════════
#  CLOSING
# ════════════════════════════════════════════════════════════

doc.add_paragraph()
add_para(
    '\u2014  Dokumen ini disusun untuk persiapan sidang. Pahami alurnya, jangan hanya dihafal.  \u2014',
    italic=True, size=10, color='a0aec0', alignment=WD_ALIGN_PARAGRAPH.CENTER
)

# ════════════════════════════════════════════════════════════
#  SAVE
# ════════════════════════════════════════════════════════════

output_path = r'D:\berkas magang\SIDUL\Cara_Pembuatan_SIDUL.docx'
doc.save(output_path)
print(f'Dokumen berhasil dibuat: {output_path}')
