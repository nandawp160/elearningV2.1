@extends('layouts.app')

@section('title', 'Daftar Kelas Pengajuan Banding')

@section('content')
<div class="tg-wrapper">
    {{-- Alerts for success/error feedback --}}
    @if(session('success'))
    <div class="tg-alert tg-alert--success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="tg-alert__close"><i class="fas fa-times"></i></button>
    </div>
    @endif

    <!-- Header Area -->
    <div class="tg-page-header">
        <div>
            <h1 class="tg-page-title">Daftar Kelas Pengajuan Banding</h1>
            <p class="tg-page-sub">Pilih kelas untuk meninjau permohonan perpanjangan waktu tugas (SSL) dari siswa.</p>
        </div>
    </div>

    <!-- Table Card -->
    <div class="tg-card">
        <div class="tg-card-header">
            <div>
                <h2 class="tg-card-title">Daftar Kelas</h2>
                <p class="tg-card-sub">Pilih kelas untuk melihat pengajuan banding.</p>
            </div>
            <div class="tg-filters">
                <select id="filterMapel" class="tg-select">
                    <option value="">Semua Mapel</option>
                    @foreach(collect($classData)->pluck('subject_name')->unique() as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </select>
                <div class="tg-search">
                    <i class="fas fa-search tg-search__icon"></i>
                    <input type="text" id="searchInput" class="tg-search__input" placeholder="Cari kelas...">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse border border-slate-300" id="appealsTable">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700" style="width:52px">NO</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">NAMA KELAS</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">MATA PELAJARAN</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">STATUS ANTREAN SSL</th>
                        <th class="px-4 py-3 font-bold text-center whitespace-nowrap border border-slate-300 text-slate-700">AKSI</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($classData as $i => $class)
                    <tr class="tg-row hover:bg-yellow-50 transition border-b border-slate-200" data-mapel="{{ strtolower($class->subject_name) }}" data-search="{{ strtolower($class->name.' '.$class->subject_name) }}">
                        <td class="px-4 py-2 border border-slate-300 text-slate-600 text-center tg-td--num">{{ $i + 1 }}</td>
                        <td class="px-4 py-2 border border-slate-300 font-semibold text-slate-800 whitespace-nowrap text-center">Kelas {{ $class->name }} <br><span class="text-xs text-slate-500 font-normal">{{ $class->student_count }} Siswa</span></td>
                        <td class="px-4 py-2 border border-slate-300 font-semibold text-slate-800 whitespace-nowrap">{{ $class->subject_name }}</td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            @if($class->pending_count > 0)
                                <span class="text-rose-600 font-bold"><span class="inline-block w-2 h-2 rounded-full bg-rose-500 mr-1"></span>{{ $class->pending_count }} Permohonan Baru</span>
                            @else
                                <span class="text-emerald-600 font-bold"><span class="inline-block w-2 h-2 rounded-full bg-emerald-500 mr-1"></span>0 Permohonan</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-slate-300 text-center whitespace-nowrap">
                            <a href="{{ route('appeals.index', ['class_id' => $class->name]) }}" class="border border-[#D65A20] text-[#D65A20] hover:bg-[#D65A20] hover:text-white rounded px-3 py-1 text-xs font-bold transition inline-block text-center whitespace-nowrap">
                                {{ $class->pending_count > 0 ? 'Tinjau Kelas' : 'Buka Kelas' }}
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center border border-slate-300 text-slate-500">
                            <i class="fas fa-school text-slate-300 mb-2 text-3xl block"></i>
                            <p class="font-semibold text-sm">Tidak ada data kelas yang Anda ampu saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer: info + pagination --}}
        <div class="tg-table-footer" id="tableFooter">
            <span class="tg-info" id="paginationInfo"></span>
            <div class="tg-pagination" id="paginationControls"></div>
        </div>
    </div>
</div>

<style>
.tg-wrapper { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; position: relative; }

/* Alerts */
.tg-alert { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 13.5px; font-weight: 500; }
.tg-alert--success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
.tg-alert__icon { flex-shrink: 0; width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.5); font-size: 13px; }
.tg-alert__close { background: none; border: none; cursor: pointer; color: inherit; opacity: 0.5; padding: 4px; margin-left: auto; }

/* Header */
.tg-page-header { margin-bottom: 24px; }
.tg-page-title { font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 0 6px 0; }
.dark .tg-page-title { color: #f1f5f9; }
.tg-page-sub { font-size: 14px; color: #64748b; margin: 0; }

/* Card */
.tg-card { background: #fff; border: 1px solid #f1f5f9; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
.dark .tg-card { background: #0f172a; border-color: #1e293b; }

.tg-card-header { padding: 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; }
.dark .tg-card-header { border-color: #1e293b; }
.tg-card-title { font-size: 17px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; }
.dark .tg-card-title { color: #f1f5f9; }
.tg-card-sub { font-size: 13px; color: #64748b; margin: 0; }

.tg-filters { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
.tg-select { padding: 8px 32px 8px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; color: #475569; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%2394a3b8'/%3E%3C/svg%3E") no-repeat right 12px center; appearance: none; outline: none; cursor: pointer; transition: all 0.15s; }
.tg-select:focus { border-color: #f97316; }
.dark .tg-select { background-color: #1e293b; border-color: #334155; color: #e2e8f0; }

.tg-search { position: relative; }
.tg-search__icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px; pointer-events: none; }
.tg-search__input { padding: 8px 14px 8px 38px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; color: #334155; background: #fff; outline: none; width: 220px; transition: all 0.15s; }
.tg-search__input::placeholder { color: #94a3b8; }
.tg-search__input:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.08); }
.dark .tg-search__input { background: #1e293b; border-color: #334155; color: #e2e8f0; }

/* Table Footer */
.tg-table-footer { padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; background: #fff; border-top: 1px solid #f1f5f9; flex-wrap: wrap; gap: 12px; }
.dark .tg-table-footer { background: #0f172a; border-color: #1e293b; }
.tg-info { font-size: 13px; color: #64748b; }
.tg-pagination { display: flex; gap: 6px; }
.tg-page-btn { min-width: 32px; height: 32px; padding: 0 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff; color: #475569; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s; }
.tg-page-btn:hover:not(:disabled) { border-color: #f97316; color: #f97316; background: #fff7ed; }
.tg-page-btn--active { border-color: #f97316; background: #f97316; color: #fff; }
.tg-page-btn--active:hover:not(:disabled) { background: #ea580c; border-color: #ea580c; color: #fff; }
.tg-page-btn:disabled { opacity: 0.5; cursor: not-allowed; background: #f8fafc; }
.dark .tg-page-btn { background: #1e293b; border-color: #334155; color: #e2e8f0; }
.dark .tg-page-btn:disabled { background: #0f172a; }
</style>

@push('scripts')
<script>
(function() {
    const PER_PAGE   = 10;
    let currentPage  = 1;
    let filteredRows = [];

    const tbody     = document.getElementById('tableBody');
    const allRows   = tbody ? Array.from(tbody.querySelectorAll('tr.tg-row')) : [];
    const infoEl    = document.getElementById('paginationInfo');
    const pagEl     = document.getElementById('paginationControls');
    const searchEl  = document.getElementById('searchInput');
    const mapelSel  = document.getElementById('filterMapel');

    function applyFilters() {
        const q      = (searchEl ? searchEl.value : '').toLowerCase().trim();
        const mapel  = (mapelSel ? mapelSel.value : '').toLowerCase();

        filteredRows = allRows.filter(row => {
            const s = row.dataset.search || '';
            const m = row.dataset.mapel  || '';
            return (!q || s.includes(q)) && (!mapel || m === mapel);
        });
        currentPage = 1;
        render();
    }

    function render() {
        allRows.forEach(r => r.style.display = 'none');
        const total     = filteredRows.length;
        const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
        const start     = (currentPage - 1) * PER_PAGE;
        const end       = Math.min(start + PER_PAGE, total);

        for (let i = start; i < end; i++) {
            filteredRows[i].style.display = '';
            // Renumber
            filteredRows[i].querySelector('.tg-td--num').textContent = i + 1;
        }

        infoEl.textContent = total === 0
            ? 'Tidak ada data ditemukan'
            : `Menampilkan ${start + 1} sampai ${end} dari ${total} data`;

        buildPagination(totalPages);
    }

    function buildPagination(totalPages) {
        if (!pagEl) return;
        pagEl.innerHTML = '';
        if (totalPages <= 1) return;

        pagEl.appendChild(createBtn('‹', currentPage > 1, () => { currentPage--; render(); }));

        // Simple logic for < 7 pages
        if (totalPages <= 7) {
            for (let p = 1; p <= totalPages; p++) {
                pagEl.appendChild(createBtn(p, true, () => { currentPage = p; render(); }, p === currentPage));
            }
        } else {
            // First page
            pagEl.appendChild(createBtn(1, true, () => { currentPage = 1; render(); }, 1 === currentPage));
            
            if (currentPage > 3) {
                const dots = document.createElement('span');
                dots.className = 'px-2 py-1 text-slate-400';
                dots.textContent = '...';
                pagEl.appendChild(dots);
            }

            let startP = Math.max(2, currentPage - 1);
            let endP   = Math.min(totalPages - 1, currentPage + 1);

            for (let p = startP; p <= endP; p++) {
                pagEl.appendChild(createBtn(p, true, () => { currentPage = p; render(); }, p === currentPage));
            }

            if (currentPage < totalPages - 2) {
                const dots = document.createElement('span');
                dots.className = 'px-2 py-1 text-slate-400';
                dots.textContent = '...';
                pagEl.appendChild(dots);
            }

            // Last page
            pagEl.appendChild(createBtn(totalPages, true, () => { currentPage = totalPages; render(); }, totalPages === currentPage));
        }

        pagEl.appendChild(createBtn('›', currentPage < totalPages, () => { currentPage++; render(); }));
    }

    function createBtn(label, enabled, onClick, isActive = false) {
        const b = document.createElement('button');
        b.type = 'button';
        b.textContent = label;
        b.className = 'tg-page-btn';
        if (isActive) b.classList.add('tg-page-btn--active');
        b.disabled = !enabled;
        if (enabled) {
            b.addEventListener('click', onClick);
        }
        return b;
    }

    if (searchEl) searchEl.addEventListener('input', applyFilters);
    if (mapelSel) mapelSel.addEventListener('change', applyFilters);

    // Initial render
    filteredRows = [...allRows];
    render();
})();
</script>
@endpush
@endsection

