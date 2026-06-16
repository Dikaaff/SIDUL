from docx import Document
doc = Document(r'D:\berkas magang\SIDUL\BAB IV - Lengkap (Rapi).docx')

# Check table 0 for database structure  
table = doc.tables[0]
print('=== DATABASE TABLE SCHEMA ===')
for r, row in enumerate(table.rows):
    cells = [cell.text.strip()[:80] for cell in row.cells]
    print(f'Row {r}: {" | ".join(cells)}')
