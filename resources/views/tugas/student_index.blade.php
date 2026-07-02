@extends('layouts.app')

@section('title', 'Tugas & Evaluasi')

@section('content')
<div class="tugas-student-wrapper">

    {{-- ── Success Toast ─────────────────────────────────────────────── --}}
    @if(session('success'))
    <div class="tugas-alert tugas-alert--success">
        <div class="tugas-alert__icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <span class="tugas-alert__text">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="tugas-alert__close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- ── Page Header ─────────────────────────────────────────────── --}}
    <div class="tugas-page-header">
        <div class="tugas-page-header__left">
            <h1 class="tugas-page-header__title">Mata Pelajaran Saya</h1>
            <p class="tugas-page-header__subtitle">Pilih mata pelajaran untuk melihat daftar tugas.</p>
        </div>
        <div class="tugas-page-header__right">
            <div class="tugas-search-box">
                <i class="fas fa-search tugas-search-box__icon"></i>
                <input type="text" id="searchMapel" class="tugas-search-box__input" placeholder="Cari mata pelajaran...">
            </div>
        </div>
    </div>

    {{-- ── Tabel Mata Pelajaran ──────────────────────────────────────── --}}
    <div class="tugas-card">
        <div class="tugas-table-wrap">
            <table class="tugas-table" id="mapelTable">
                <thead>
                    <tr>
                        <th class="tugas-th" style="width: 60px;">NO</th>
                        <th class="tugas-th">MATA PELAJARAN</th>
                        <th class="tugas-th">GURU PENGAMPU</th>
                        <th class="tugas-th">KELAS</th>
                        <th class="tugas-th" style="text-align: center;">JUMLAH TUGAS</th>
                        <th class="tugas-th" style="text-align: center;">TUGAS TERKUMPUL</th>
                        <th class="tugas-th" style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody id="mapelTableBody">
                    @forelse($subjectData as $index => $item)
                    <tr class="tugas-tr" data-search="{{ strtolower($item['course_name']) }} {{ strtolower($item['teacher_name']) }} {{ strtolower($item['class_name']) }}">
                        <td class="tugas-td tugas-td--num">{{ $index + 1 }}</td>
                        <td class="tugas-td">
                            <div class="tugas-mapel-cell">
                                <div class="tugas-mapel-icon" style="background-color: {{ $item['color_bg'] }}; color: {{ $item['color_text'] }};">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                                <span class="tugas-mapel-name">{{ $item['course_name'] }}</span>
                            </div>
                        </td>
                        <td class="tugas-td tugas-td--secondary">{{ $item['teacher_name'] }}</td>
                        <td class="tugas-td tugas-td--secondary">{{ $item['class_name'] }}</td>
                        <td class="tugas-td tugas-td--center">{{ $item['total_assignments'] }}</td>
                        <td class="tugas-td tugas-td--center">
                            <span class="tugas-collected-badge">{{ $item['submitted_count'] }}</span>
                        </td>
                        <td class="tugas-td tugas-td--center">
                            <a href="{{ route('assignments.student.detail', $item['subject_id']) }}" class="tugas-btn-lihat">
                                Lihat Tugas <i class="fas fa-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="tugas-td tugas-td--empty">
                            <div class="tugas-empty-state">
                                <div class="tugas-empty-state__icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <p class="tugas-empty-state__title">Belum ada mata pelajaran</p>
                                <p class="tugas-empty-state__desc">Anda belum terdaftar di kelas manapun.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Info --}}
        @if(count($subjectData) > 0)
        <div class="tugas-pagination-bar" id="paginationBar">
            <span class="tugas-pagination-info" id="paginationInfo">Menampilkan 1 sampai {{ count($subjectData) }} dari {{ count($subjectData) }} data</span>
            <div class="tugas-pagination" id="paginationControls">
                {{-- JS-driven pagination --}}
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchMapel');
    const tableBody = document.getElementById('mapelTableBody');
    const rows = tableBody ? tableBody.querySelectorAll('tr.tugas-tr') : [];
    const itemsPerPage = 10;
    let currentPage = 1;
    let filteredRows = Array.from(rows);

    // Search
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            filteredRows = [];
            rows.forEach(function(row) {
                const searchData = row.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    filteredRows.push(row);
                }
            });
            currentPage = 1;
            renderTable();
        });
    }

    function renderTable() {
        // Hide all rows
        rows.forEach(function(row) { row.style.display = 'none'; });

        // Calculate pages
        const totalItems = filteredRows.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const end = Math.min(start + itemsPerPage, totalItems);

        // Show rows for current page, update numbering
        for (let i = start; i < end; i++) {
            filteredRows[i].style.display = '';
            filteredRows[i].querySelector('.tugas-td--num').textContent = i + 1;
        }

        // Update info
        const infoEl = document.getElementById('paginationInfo');
        if (infoEl) {
            if (totalItems === 0) {
                infoEl.textContent = 'Tidak ada data ditemukan';
            } else {
                infoEl.textContent = `Menampilkan ${start + 1} sampai ${end} dari ${totalItems} data`;
            }
        }

        // Render pagination buttons
        renderPaginationButtons(totalPages);
    }

    function renderPaginationButtons(totalPages) {
        const container = document.getElementById('paginationControls');
        if (!container) return;
        container.innerHTML = '';

        if (totalPages <= 1) return;

        // Prev
        const prevBtn = createPageBtn('<i class="fas fa-chevron-left"></i>', currentPage > 1, function() {
            if (currentPage > 1) { currentPage--; renderTable(); }
        });
        prevBtn.classList.add('tugas-page-btn--nav');
        container.appendChild(prevBtn);

        // Page numbers
        for (let p = 1; p <= totalPages; p++) {
            const btn = createPageBtn(p, true, function() {
                currentPage = p;
                renderTable();
            });
            if (p === currentPage) btn.classList.add('tugas-page-btn--active');
            container.appendChild(btn);
        }

        // Next
        const nextBtn = createPageBtn('<i class="fas fa-chevron-right"></i>', currentPage < totalPages, function() {
            if (currentPage < totalPages) { currentPage++; renderTable(); }
        });
        nextBtn.classList.add('tugas-page-btn--nav');
        container.appendChild(nextBtn);
    }

    function createPageBtn(content, enabled, onClick) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.innerHTML = content;
        btn.className = 'tugas-page-btn';
        btn.disabled = !enabled;
        if (enabled) btn.addEventListener('click', onClick);
        return btn;
    }

    // Initial render
    filteredRows = Array.from(rows);
    renderTable();
});
</script>
@endpush

@push('scripts')
<style>
/* ================================================================
   TUGAS STUDENT — Clean Modern UI
   Matching the reference image: soft orange, white bg, thin borders
   ================================================================ */

/* Wrapper */
.tugas-student-wrapper {
    max-width: 100%;
    font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Alert */
.tugas-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-size: 13px;
    font-weight: 500;
    animation: tugas-fadeInUp 0.3s ease-out;
}
.tugas-alert--success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
}
.tugas-alert__icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dcfce7;
    color: #16a34a;
    font-size: 13px;
}
.tugas-alert__text { flex: 1; }
.tugas-alert__close {
    background: none;
    border: none;
    cursor: pointer;
    color: inherit;
    opacity: 0.5;
    padding: 4px;
    transition: opacity 0.15s;
}
.tugas-alert__close:hover { opacity: 1; }

/* Page Header */
.tugas-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 16px;
}
.tugas-page-header__title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px 0;
    line-height: 1.3;
}
.dark .tugas-page-header__title { color: #f1f5f9; }

.tugas-page-header__subtitle {
    font-size: 13px;
    color: #94a3b8;
    margin: 0;
    font-weight: 400;
}

/* Search Box */
.tugas-search-box {
    position: relative;
    width: 260px;
}
.tugas-search-box__icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 13px;
    pointer-events: none;
}
.tugas-search-box__input {
    width: 100%;
    padding: 9px 14px 9px 38px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 13px;
    color: #334155;
    background: #fff;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    font-family: inherit;
}
.tugas-search-box__input::placeholder { color: #94a3b8; }
.tugas-search-box__input:focus {
    border-color: #f97316;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.08);
}
.dark .tugas-search-box__input {
    background: #1e293b;
    border-color: #334155;
    color: #e2e8f0;
}

/* Card */
.tugas-card {
    background: #ffffff;
    border: 1px solid #f1f5f9;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 1px 2px rgba(0, 0, 0, 0.02);
}
.dark .tugas-card {
    background: #0f172a;
    border-color: #1e293b;
}

/* Table */
.tugas-table-wrap {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.tugas-table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

/* Table Head */
.tugas-th {
    padding: 14px 20px;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #94a3b8;
    background: #fafbfc;
    border-bottom: 1px solid #f1f5f9;
    white-space: nowrap;
}
.dark .tugas-th {
    background: #0f172a;
    border-color: #1e293b;
    color: #64748b;
}

/* Table Rows */
.tugas-tr {
    transition: background-color 0.15s ease;
}
.tugas-tr:hover {
    background-color: #fafbfc;
}
.dark .tugas-tr:hover {
    background-color: #1e293b;
}
.tugas-tr:not(:last-child) .tugas-td {
    border-bottom: 1px solid #f8fafc;
}
.dark .tugas-tr:not(:last-child) .tugas-td {
    border-bottom-color: #1e293b;
}

/* Table Cells */
.tugas-td {
    padding: 16px 20px;
    font-size: 13.5px;
    color: #334155;
    vertical-align: middle;
    white-space: nowrap;
}
.dark .tugas-td { color: #cbd5e1; }

.tugas-td--num {
    color: #94a3b8;
    font-weight: 500;
    font-size: 13px;
}
.tugas-td--secondary {
    color: #64748b;
    font-weight: 400;
}
.tugas-td--center {
    text-align: center;
}
.tugas-td--empty {
    padding: 48px 20px;
    text-align: center;
}

/* Mapel Cell (icon + name) */
.tugas-mapel-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}
.tugas-mapel-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}
.tugas-mapel-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 13.5px;
}
.dark .tugas-mapel-name { color: #f1f5f9; }

/* Collected Badge */
.tugas-collected-badge {
    display: inline-block;
    font-weight: 600;
    color: #f97316;
    font-size: 14px;
}

/* Action Button */
.tugas-btn-lihat {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background: #ffffff;
    color: #475569;
    font-size: 12.5px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.15s ease;
    font-family: inherit;
    white-space: nowrap;
}
.tugas-btn-lihat i {
    font-size: 10px;
    transition: transform 0.15s;
}
.tugas-btn-lihat:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #f97316;
}
.tugas-btn-lihat:hover i {
    transform: translateX(2px);
}
.dark .tugas-btn-lihat {
    background: #1e293b;
    border-color: #334155;
    color: #94a3b8;
}
.dark .tugas-btn-lihat:hover {
    border-color: #475569;
    color: #f97316;
}

/* Pagination */
.tugas-pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    border-top: 1px solid #f1f5f9;
    flex-wrap: wrap;
    gap: 12px;
}
.dark .tugas-pagination-bar { border-color: #1e293b; }

.tugas-pagination-info {
    font-size: 12.5px;
    color: #94a3b8;
    font-weight: 400;
}
.tugas-pagination {
    display: flex;
    align-items: center;
    gap: 4px;
}
.tugas-page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 8px;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: #64748b;
    font-size: 12.5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.15s;
    font-family: inherit;
}
.tugas-page-btn:hover:not(:disabled):not(.tugas-page-btn--active) {
    background: #f1f5f9;
    color: #1e293b;
}
.tugas-page-btn--active {
    background: #f97316 !important;
    color: #ffffff !important;
    font-weight: 600;
    border-radius: 8px;
}
.tugas-page-btn--nav {
    color: #94a3b8;
    font-size: 11px;
}
.tugas-page-btn:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* Empty State */
.tugas-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}
.tugas-empty-state__icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: #fff7ed;
    color: #f97316;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 4px;
}
.tugas-empty-state__title {
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    margin: 0;
}
.tugas-empty-state__desc {
    font-size: 12.5px;
    color: #94a3b8;
    margin: 0;
}

/* Animation */
@keyframes tugas-fadeInUp {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .tugas-page-header {
        flex-direction: column;
    }
    .tugas-search-box {
        width: 100%;
    }
    .tugas-th, .tugas-td {
        padding: 12px 14px;
    }
}
</style>
@endpush
@endsection
