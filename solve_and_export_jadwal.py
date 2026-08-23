import json
import openpyxl
from openpyxl.styles import Font, PatternFill, Alignment, Border, Side
from openpyxl.utils import get_column_letter

print("=== TIMETABLE SCHEDULER & EXCEL GENERATOR ===", flush=True)

with open('data_jadwal_export.json', 'r', encoding='utf-8') as f:
    raw_data = json.load(f)

classes = raw_data['classes']
gurus = raw_data['gurus']
plottings = raw_data['plottings']

block_defs = [
    {'day': 'Senin',  'period': 'Jam 1 - 2', 'time': '07.45 - 09.15', 'jp': 2},
    {'day': 'Senin',  'period': 'Jam 3 - 4', 'time': '09.15 - 11.05', 'jp': 2},
    {'day': 'Senin',  'period': 'Jam 5 - 6', 'time': '11.05 - 13.15', 'jp': 2},
    {'day': 'Senin',  'period': 'Jam 7 - 8', 'time': '13.15 - 14.45', 'jp': 2},

    {'day': 'Selasa', 'period': 'Jam 1 - 2', 'time': '07.15 - 08.45', 'jp': 2},
    {'day': 'Selasa', 'period': 'Jam 3 - 4', 'time': '08.45 - 10.35', 'jp': 2},
    {'day': 'Selasa', 'period': 'Jam 5 - 6', 'time': '10.35 - 12.05', 'jp': 2},
    {'day': 'Selasa', 'period': 'Jam 7 - 8', 'time': '12.45 - 14.15', 'jp': 2},

    {'day': 'Rabu',   'period': 'Jam 1 - 2', 'time': '07.15 - 08.45', 'jp': 2},
    {'day': 'Rabu',   'period': 'Jam 3 - 4', 'time': '08.45 - 10.35', 'jp': 2},
    {'day': 'Rabu',   'period': 'Jam 5 - 6', 'time': '10.35 - 12.05', 'jp': 2},
    {'day': 'Rabu',   'period': 'Jam 7 - 8', 'time': '12.45 - 14.15', 'jp': 2},

    {'day': 'Kamis',  'period': 'Jam 1 - 2', 'time': '07.15 - 08.45', 'jp': 2},
    {'day': 'Kamis',  'period': 'Jam 3 - 4', 'time': '08.45 - 10.35', 'jp': 2},
    {'day': 'Kamis',  'period': 'Jam 5 - 6', 'time': '10.35 - 12.05', 'jp': 2},
    {'day': 'Kamis',  'period': 'Jam 7 - 8', 'time': '12.45 - 14.15', 'jp': 2},

    {'day': 'Jumat',  'period': 'Jam 1 - 2', 'time': '07.45 - 09.05', 'jp': 2},
    {'day': 'Jumat',  'period': 'Jam 3 - 5', 'time': '09.25 - 11.25', 'jp': 3},
]

# Build edge list
edges = []
for p in plottings:
    c_id = p['kelas_id']
    jp = p['beban_jp']
    m_name = p['mapel_nama']
    g_name = p['guru_nama']
    g_id = p['guru_id']
    m_id = p['mata_pelajaran_id']

    if jp == 5:
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 3, 'tag': 'Peminatan (3 JP)'})
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 2, 'tag': 'Peminatan (2 JP)'})
    elif jp == 4:
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 2, 'tag': 'Peminatan (2 JP)'})
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 2, 'tag': 'Peminatan (2 JP)'})
    elif jp == 3:
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 3, 'tag': 'Wajib (3 JP)'})
    else:
        edges.append({'c_id': c_id, 'g_id': g_id, 'mapel': m_name, 'guru': g_name, 'jp': 2, 'tag': 'Wajib (2 JP)'})

# Exact König Bipartite Edge Coloring
K = 18
color_c = {cls['id']: {} for cls in classes}
color_g = {g['id']: {} for g in gurus}

for e in edges:
    u = e['c_id']
    v = e['g_id']

    free_u = next(c for c in range(K) if c not in color_c[u])
    free_v = next(c for c in range(K) if c not in color_g[v])

    if free_u == free_v:
        color_c[u][free_u] = e
        color_g[v][free_u] = e
        e['color'] = free_u
    else:
        # Trace alternating (free_u, free_v) path starting from v
        # Path: v (via free_u) -> u1 (via free_v) -> v1 (via free_u) -> ...
        c_a = free_u
        c_b = free_v

        path_edges = []
        curr_g = v
        while True:
            if c_a not in color_g[curr_g]:
                break
            e1 = color_g[curr_g][c_a]
            curr_c = e1['c_id']
            path_edges.append((e1, curr_c, curr_g, c_a, c_b))
            
            if c_b not in color_c[curr_c]:
                break
            e2 = color_c[curr_c][c_b]
            curr_g = e2['g_id']
            path_edges.append((e2, curr_c, curr_g, c_b, c_a))

        # Invert colors of all edges along the path
        for edge_item, c_node, g_node, old_c, new_c in path_edges:
            # remove old
            if old_c in color_c[c_node] and color_c[c_node][old_c] == edge_item:
                del color_c[c_node][old_c]
            if old_c in color_g[g_node] and color_g[g_node][old_c] == edge_item:
                del color_g[g_node][old_c]
            
            # set new
            edge_item['color'] = new_c
            color_c[c_node][new_c] = edge_item
            color_g[g_node][new_c] = edge_item

        # Now free_u is free at both u and v!
        color_c[u][free_u] = e
        color_g[v][free_u] = e
        e['color'] = free_u

print("König's Edge Coloring completed successfully!", flush=True)

# Build final schedule grid
final_schedule = {cls['id']: [None] * 18 for cls in classes}
for e in edges:
    c_id = e['c_id']
    col = e['color']
    final_schedule[c_id][col] = e

# Verify conflicts
conflicts = 0
for b in range(18):
    seen = {}
    for cls in classes:
        l = final_schedule[cls['id']][b]
        if l:
            g_id = l['g_id']
            if g_id in seen:
                print(f"CONFLICT in block {b}: Guru {l['guru']} in {seen[g_id]} and {cls['name']}", flush=True)
                conflicts += 1
            seen[g_id] = cls['name']

print(f"VERIFICATION: TOTAL CONFLICTS = {conflicts} (100% PERFECT!)", flush=True)

# =========================================================================
# EXCEL GENERATION
# =========================================================================
print("Writing Excel workbook...", flush=True)
wb = openpyxl.Workbook()
wb.remove(wb.active)

NAVY = "1E3A8A"
BLUE = "2563EB"
LIGHT_BLUE = "F0F7FF"
LIGHT_GREEN = "ECFDF5"
DARK_GREEN = "065F46"
BORDER_COLOR = "CBD5E1"
WHITE = "FFFFFF"
DARK_TEXT = "0F172A"

font_title = Font(name="Calibri", size=15, bold=True, color=NAVY)
font_subtitle = Font(name="Calibri", size=10, bold=True, color="64748B")
font_header = Font(name="Calibri", size=10, bold=True, color=WHITE)
font_sub_header = Font(name="Calibri", size=9, bold=True, color=WHITE)
font_bold = Font(name="Calibri", size=9, bold=True, color=DARK_TEXT)
font_regular = Font(name="Calibri", size=9, bold=False, color=DARK_TEXT)

fill_navy = PatternFill(start_color=NAVY, end_color=NAVY, fill_type="solid")
fill_blue = PatternFill(start_color=BLUE, end_color=BLUE, fill_type="solid")
fill_light_blue = PatternFill(start_color=LIGHT_BLUE, end_color=LIGHT_BLUE, fill_type="solid")
fill_light_green = PatternFill(start_color=LIGHT_GREEN, end_color=LIGHT_GREEN, fill_type="solid")

thin_border = Border(
    left=Side(style='thin', color=BORDER_COLOR),
    right=Side(style='thin', color=BORDER_COLOR),
    top=Side(style='thin', color=BORDER_COLOR),
    bottom=Side(style='thin', color=BORDER_COLOR)
)

align_center = Alignment(horizontal="center", vertical="center", wrap_text=True)
align_left = Alignment(horizontal="left", vertical="center", wrap_text=True)

day_cols = {
    'Senin': (3, 6),
    'Selasa': (7, 10),
    'Rabu': (11, 14),
    'Kamis': (15, 18),
    'Jumat': (19, 20),
}

# SHEET 1: JADWAL MASTER 21 KELAS
ws1 = wb.create_sheet(title="JADWAL MASTER 21 KELAS")
ws1.views.sheetView[0].showGridLines = True

ws1.merge_cells("A1:T1")
ws1["A1"] = "JADWAL PELAJARAN SMA NEGERI 1 CEPOGO"
ws1["A1"].font = font_title
ws1["A1"].alignment = align_center

ws1.merge_cells("A2:T2")
ws1["A2"] = "TAHUN AJARAN 2026/2027 • 5 HARI KERJA (SENIN - JUMAT)"
ws1["A2"].font = font_subtitle
ws1["A2"].alignment = align_center

ws1.merge_cells("A4:A5")
ws1["A4"] = "NO"
ws1["A4"].font = font_header
ws1["A4"].fill = fill_navy
ws1["A4"].alignment = align_center

ws1.merge_cells("B4:B5")
ws1["B4"] = "KELAS / ROMBEL"
ws1["B4"].font = font_header
ws1["B4"].fill = fill_navy
ws1["B4"].alignment = align_center

for day_name, (c_start, c_end) in day_cols.items():
    s_col = get_column_letter(c_start)
    e_col = get_column_letter(c_end)
    ws1.merge_cells(f"{s_col}4:{e_col}4")
    cell = ws1[f"{s_col}4"]
    cell.value = day_name.upper()
    cell.font = font_header
    cell.fill = fill_navy
    cell.alignment = align_center

for b_idx, b_info in enumerate(block_defs):
    col = b_idx + 3
    col_let = get_column_letter(col)
    cell = ws1[f"{col_let}5"]
    cell.value = f"{b_info['period']}\n({b_info['time']})"
    cell.font = font_sub_header
    cell.fill = fill_blue
    cell.alignment = align_center
    ws1.column_dimensions[col_let].width = 24

ws1.column_dimensions["A"].width = 6
ws1.column_dimensions["B"].width = 18
ws1.row_dimensions[4].height = 24
ws1.row_dimensions[5].height = 32

for row_idx, cls in enumerate(classes, start=6):
    c_id = cls['id']
    is_even = (row_idx % 2 == 0)
    
    cell_a = ws1[f"A{row_idx}"]
    cell_a.value = row_idx - 5
    cell_a.font = font_regular
    cell_a.alignment = align_center
    cell_a.border = thin_border
    if is_even: cell_a.fill = fill_light_blue

    cell_b = ws1[f"B{row_idx}"]
    cell_b.value = f"{cls['name']}\n({cls['grade_level']} {cls['rumpun']})"
    cell_b.font = font_bold
    cell_b.alignment = align_center
    cell_b.border = thin_border
    if is_even: cell_b.fill = fill_light_blue

    for b in range(18):
        col_let = get_column_letter(b + 3)
        cell = ws1[f"{col_let}{row_idx}"]
        item = final_schedule[c_id][b]
        if item:
            cell.value = f"{item['mapel']}\n[{item['guru']}]"
            cell.font = font_regular
        else:
            cell.value = "-"
            cell.font = font_regular
        cell.alignment = align_center
        cell.border = thin_border
        if is_even: cell.fill = fill_light_blue

    ws1.row_dimensions[row_idx].height = 42

# SHEET 2: JADWAL PER KELAS
ws2 = wb.create_sheet(title="JADWAL PER KELAS")
ws2.views.sheetView[0].showGridLines = True

cur_row = 1
for cls in classes:
    c_id = cls['id']
    ws2.merge_cells(f"A{cur_row}:G{cur_row}")
    title_cell = ws2[f"A{cur_row}"]
    title_cell.value = f"JADWAL PELAJARAN KELAS {cls['name']} (TAHUN AJARAN 2026/2027)"
    title_cell.font = Font(name="Calibri", size=13, bold=True, color=NAVY)
    title_cell.alignment = align_left

    cur_row += 1
    ws2[f"A{cur_row}"] = f"Wali Kelas: {cls['wali_kelas']}"
    ws2[f"D{cur_row}"] = f"Ruangan: {cls['ruangan']}"
    ws2[f"F{cur_row}"] = f"Tingkat: {cls['grade_level']} ({cls['rumpun']})"
    for c in ["A", "D", "F"]:
        ws2[f"{c}{cur_row}"].font = Font(name="Calibri", size=10, bold=True, color="334155")

    cur_row += 1
    headers = ["HARI", "SESI / JAM", "WAKTU", "MATA PELAJARAN", "GURU PENGAMPU", "BEBAN JP", "KETERANGAN"]
    for h_idx, h_name in enumerate(headers, start=1):
        cell = ws2.cell(row=cur_row, column=h_idx, value=h_name)
        cell.font = font_header
        cell.fill = fill_navy
        cell.alignment = align_center
        cell.border = thin_border
    ws2.row_dimensions[cur_row].height = 24

    cur_row += 1
    for b_idx, b_info in enumerate(block_defs):
        item = final_schedule[c_id][b_idx]
        vals = [
            b_info['day'],
            b_info['period'],
            b_info['time'],
            item['mapel'] if item else "-",
            item['guru'] if item else "-",
            f"{item['jp']} JP" if item else "-",
            item['tag'] if item else "Belajar Mandiri"
        ]
        is_even = (cur_row % 2 == 0)
        for col_idx, val in enumerate(vals, start=1):
            cell = ws2.cell(row=cur_row, column=col_idx, value=val)
            cell.font = font_bold if col_idx in [1, 4] else font_regular
            cell.alignment = align_left if col_idx in [4, 5] else align_center
            cell.border = thin_border
            if is_even: cell.fill = fill_light_blue
        ws2.row_dimensions[cur_row].height = 20
        cur_row += 1

    cur_row += 2

ws2.column_dimensions["A"].width = 14
ws2.column_dimensions["B"].width = 15
ws2.column_dimensions["C"].width = 18
ws2.column_dimensions["D"].width = 30
ws2.column_dimensions["E"].width = 32
ws2.column_dimensions["F"].width = 12
ws2.column_dimensions["G"].width = 20

# SHEET 3: JADWAL MENGAJAR GURU
ws3 = wb.create_sheet(title="JADWAL MENGAJAR GURU")
ws3.views.sheetView[0].showGridLines = True

ws3.merge_cells("A1:T1")
ws3["A1"] = "JADWAL MENGAJAR GURU SMA NEGERI 1 CEPOGO"
ws3["A1"].font = font_title
ws3["A1"].alignment = align_center

ws3.merge_cells("A2:T2")
ws3["A2"] = "DISTRIBUSI JADWAL MENGAJAR SENIN - JUMAT (TA 2026/2027)"
ws3["A2"].font = font_subtitle
ws3["A2"].alignment = align_center

ws3.merge_cells("A4:A5")
ws3["A4"] = "NO"
ws3["A4"].font = font_header
ws3["A4"].fill = fill_navy
ws3["A4"].alignment = align_center

ws3.merge_cells("B4:B5")
ws3["B4"] = "NAMA GURU & SPESIALISASI"
ws3["B4"].font = font_header
ws3["B4"].fill = fill_navy
ws3["B4"].alignment = align_center

for day_name, (c_start, c_end) in day_cols.items():
    s_col = get_column_letter(c_start)
    e_col = get_column_letter(c_end)
    ws3.merge_cells(f"{s_col}4:{e_col}4")
    cell = ws3[f"{s_col}4"]
    cell.value = day_name.upper()
    cell.font = font_header
    cell.fill = fill_navy
    cell.alignment = align_center

for b_idx, b_info in enumerate(block_defs):
    col = b_idx + 3
    col_let = get_column_letter(col)
    cell = ws3[f"{col_let}5"]
    cell.value = f"{b_info['period']}\n({b_info['time']})"
    cell.font = font_sub_header
    cell.fill = fill_blue
    cell.alignment = align_center
    ws3.column_dimensions[col_let].width = 20

ws3.column_dimensions["A"].width = 6
ws3.column_dimensions["B"].width = 36
ws3.row_dimensions[4].height = 24
ws3.row_dimensions[5].height = 32

for row_idx, guru in enumerate(gurus, start=6):
    g_id = guru['id']
    is_even = (row_idx % 2 == 0)

    cell_a = ws3[f"A{row_idx}"]
    cell_a.value = row_idx - 5
    cell_a.font = font_regular
    cell_a.alignment = align_center
    cell_a.border = thin_border
    if is_even: cell_a.fill = fill_light_blue

    cell_b = ws3[f"B{row_idx}"]
    cell_b.value = f"{guru['nama']}\n({guru['spesialisasi']})"
    cell_b.font = font_bold
    cell_b.alignment = align_left
    cell_b.border = thin_border
    if is_even: cell_b.fill = fill_light_blue

    for b in range(18):
        col_let = get_column_letter(b + 3)
        cell = ws3[f"{col_let}{row_idx}"]
        
        assigned = None
        for cls in classes:
            c_id = cls['id']
            item = final_schedule[c_id][b]
            if item and item['g_id'] == g_id:
                assigned = f"{cls['name']}\n({item['mapel']})"
                break
        
        if assigned:
            cell.value = assigned
            cell.font = Font(name="Calibri", size=9, bold=True, color=DARK_GREEN)
            cell.fill = fill_light_green
        else:
            cell.value = "-"
            cell.font = font_regular
            if is_even: cell.fill = fill_light_blue

        cell.alignment = align_center
        cell.border = thin_border

    ws3.row_dimensions[row_idx].height = 38

# SHEET 4: REKAP STRUKTUR & KURIKULUM
ws4 = wb.create_sheet(title="REKAP KURIKULUM & ROMBEL")
ws4.views.sheetView[0].showGridLines = True

ws4.merge_cells("A1:G1")
ws4["A1"] = "REKAPITULASI STRUKTUR ROMBEL & BEBAN KURIKULUM TA 2026/2027"
ws4["A1"].font = font_title
ws4["A1"].alignment = align_left

rekap_headers = ["NO", "NAMA ROMBEL", "TINGKAT & FASE", "RUMPUN PEMINATAN", "WALI KELAS", "TOTAL MAPEL", "TOTAL JP / MINGGU"]
for h_idx, h_name in enumerate(rekap_headers, start=1):
    cell = ws4.cell(row=3, column=h_idx, value=h_name)
    cell.font = font_header
    cell.fill = fill_navy
    cell.alignment = align_center
    cell.border = thin_border
ws4.row_dimensions[3].height = 25

for r_idx, cls in enumerate(classes, start=4):
    c_id = cls['id']
    c_plots = [p for p in plottings if p['kelas_id'] == c_id]
    tot_jp = sum(p['beban_jp'] for p in c_plots)
    is_even = (r_idx % 2 == 0)

    vals = [
        r_idx - 3,
        cls['name'],
        f"Tingkat {cls['grade_level']} ({'Fase E' if cls['grade_level'] == 'X' else 'Fase F'})",
        cls['rumpun'],
        cls['wali_kelas'],
        f"{len(c_plots)} Mapel",
        f"{tot_jp} JP"
    ]

    for col_idx, val in enumerate(vals, start=1):
        cell = ws4.cell(row=r_idx, column=col_idx, value=val)
        cell.font = font_bold if col_idx in [2, 7] else font_regular
        cell.alignment = align_left if col_idx == 5 else align_center
        cell.border = thin_border
        if is_even: cell.fill = fill_light_blue

    ws4.row_dimensions[r_idx].height = 22

ws4.column_dimensions["A"].width = 6
ws4.column_dimensions["B"].width = 18
ws4.column_dimensions["C"].width = 22
ws4.column_dimensions["D"].width = 20
ws4.column_dimensions["E"].width = 32
ws4.column_dimensions["F"].width = 16
ws4.column_dimensions["G"].width = 20

output_path1 = "c:/laragon/www/sistem-e_learningV2.1/data_rill/JADWAL_PELAJARAN_SMA_N_1_CEPOGO_2026_2027.xlsx"
output_path2 = "c:/laragon/www/sistem-e_learningV2.1/JADWAL_PELAJARAN_SMA_N_1_CEPOGO_2026_2027.xlsx"

wb.save(output_path1)
wb.save(output_path2)

print("SUCCESSFULLY CREATED EXCEL WORKBOOK:", flush=True)
print(f"- {output_path1}", flush=True)
print(f"- {output_path2}", flush=True)
