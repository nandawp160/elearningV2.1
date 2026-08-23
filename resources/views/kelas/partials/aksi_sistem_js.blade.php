@push('scripts')
<script>
// Kenaikan JS
function openPlottingSiswaModal() {
        $('#modalPlottingSiswa').removeClass('hidden');
        $('body').addClass('overflow-hidden');
    }
    function closePlottingSiswaModal() {
        $('#modalPlottingSiswa').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

function openKelulusanKenaikanModal() {
        $('#modalKelulusanKenaikan').removeClass('hidden');
        $('body').addClass('overflow-hidden');
        switchTab('kelulusan');
        resetKelulusanKenaikanForm();
    }

    function closeKelulusanKenaikanModal() {
        $('#modalKelulusanKenaikan').addClass('hidden');
        $('body').removeClass('overflow-hidden');
    }

    function resetKelulusanKenaikanForm() {
        const cbs = document.querySelectorAll('#kelasTwelveContainer .kelas-checkbox');
        cbs.forEach(cb => cb.checked = false);
        $('#gradStudentsList').html('');
        $('#gradStudentsSection').addClass('hidden');
        $('#gradSelectedCount').text('0 siswa terpilih');
        
        // Reset mapping select dropdowns to empty state if any
        document.querySelectorAll('.auto-mapping-select').forEach(select => {
            select.selectedIndex = 0;
        });
    }

    function switchTab(tab) {
        if (tab === 'kenaikan') {
            $('#tab-kenaikan').addClass('text-orange-500 border-orange-500').removeClass('text-slate-500 border-transparent');
            $('#tab-kelulusan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            $('#tab-penjurusan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            
            $('#formKenaikan').removeClass('hidden');
            $('#formKelulusan').addClass('hidden');
            $('#formPenjurusan').addClass('hidden').removeClass('flex');
        }
        if (tab === 'kelulusan') {
            $('#tab-kelulusan').addClass('text-orange-500 border-orange-500').removeClass('text-slate-500 border-transparent');
            $('#tab-kenaikan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            $('#tab-penjurusan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            
            $('#formKelulusan').removeClass('hidden');
            $('#formKenaikan').addClass('hidden');
            $('#formPenjurusan').addClass('hidden').removeClass('flex');
        }
        if (tab === 'penjurusan') {
            $('#tab-penjurusan').addClass('text-orange-500 border-orange-500').removeClass('text-slate-500 border-transparent');
            $('#tab-kelulusan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            $('#tab-kenaikan').removeClass('text-orange-500 border-orange-500').addClass('text-slate-500 border-transparent');
            
            $('#formPenjurusan').removeClass('hidden').addClass('flex');
            $('#formKelulusan').addClass('hidden');
            $('#formKenaikan').addClass('hidden');
        }
    }

    function loadStudentsForGraduation() {
        const checkedClasses = [];
        $('#kelasTwelveContainer input[name="kelas[]"]:checked').each(function() {
            checkedClasses.push($(this).val());
        });

        if (checkedClasses.length === 0) {
            $('#gradStudentsList').html('');
            $('#gradStudentsSection').addClass('hidden');
            $('#gradSelectedCount').text('0 siswa terpilih');
            return;
        }

        fetch(`{{ route('students.by-classes') }}?kelas=${checkedClasses.join(',')}`)
            .then(res => res.json())
            .then(data => {
                let html = '';
                if (data.length === 0) {
                    html = '<p class="text-xs text-slate-400 text-center py-4">Tidak ada siswa aktif di kelas ini.</p>';
                } else {
                    data.forEach(student => {
                        html += `
                            <label class="flex items-center justify-between p-2 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg cursor-pointer border border-transparent hover:border-slate-100 dark:hover:border-slate-700/50 student-item" data-name="${student.nama.toLowerCase()}">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="id_siswa[]" value="${student.id}" checked class="student-checkbox rounded border-slate-300 text-orange-500 focus:ring-orange-500" onchange="updateGradCount()" />
                                    <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">${student.nama} <span class="text-xxs text-slate-400 font-mono">(${student.nis})</span></span>
                                </div>
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-500 dark:text-slate-400 rounded-md font-mono">${student.kelas}</span>
                            </label>
                        `;
                    });
                }
                $('#gradStudentsList').html(html);
                $('#gradStudentsSection').removeClass('hidden');
                updateGradCount();
            });
    }

    function updateGradCount() {
        const total = $('#gradStudentsList input[type="checkbox"]').length;
        const checked = $('#gradStudentsList input[type="checkbox"]:checked').length;
        $('#gradSelectedCount').text(`${checked} dari ${total} siswa terpilih`);
    }

    // ==========================================
    // PENJURUSAN (X ke XI) INTERACTIVE ENGINE
    // ==========================================
    let penjurusanStudents = [];
    let penjurusanKelasXIList = [];
    let penjurusanFilterMode = 'all';

    function initPenjurusanClasses() {
        const store = document.getElementById('kelasXIDataStore');
        if (store) {
            try {
                penjurusanKelasXIList = JSON.parse(store.getAttribute('data-classes') || '[]');
            } catch (e) {
                penjurusanKelasXIList = [];
            }
        }
        
        // Populate Bulk Target dropdown
        const bulkSelect = document.getElementById('penjurusanBulkTarget');
        if (bulkSelect) {
            bulkSelect.innerHTML = '<option value="">Pilih Kelas XI Tujuan...</option>';
            penjurusanKelasXIList.forEach(cls => {
                bulkSelect.innerHTML += `<option value="${cls.name}">${cls.name} (Kapasitas: ${cls.max_students})</option>`;
            });
        }
    }

    function loadStudentsForPenjurusan(kelas) {
        initPenjurusanClasses();

        if (!kelas) {
            $('#penjurusanStatsSummary, #penjurusanQuotaMonitor, #penjurusanToolbar, #penjurusanStudentsSection').addClass('hidden');
            $('#btnProsesPenjurusan').prop('disabled', true);
            $('#penjurusanFooterSummary').text('Pilih kelas asal untuk memulai.');
            penjurusanStudents = [];
            return;
        }

        $('#penjurusanStudentsList').html('<tr><td colspan="4" class="py-8 text-center text-xs text-slate-400"><i class="fas fa-spinner fa-spin mr-2"></i>Memuat daftar siswa...</td></tr>');
        $('#penjurusanStudentsSection').removeClass('hidden');

        fetch(`{{ route('students.by-classes') }}?kelas=${encodeURIComponent(kelas)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    $('#penjurusanStudentsList').html('<tr><td colspan="4" class="py-8 text-center text-xs text-slate-400">Tidak ada siswa aktif di kelas ini.</td></tr>');
                    $('#penjurusanStatsSummary, #penjurusanQuotaMonitor, #penjurusanToolbar').addClass('hidden');
                    $('#btnProsesPenjurusan').prop('disabled', true);
                    $('#penjurusanFooterSummary').text('Tidak ada siswa aktif di kelas ini.');
                    penjurusanStudents = [];
                    return;
                }

                penjurusanStudents = data.map(s => ({
                    id: s.id,
                    nama: s.nama,
                    nis: s.nis,
                    target: ''
                }));

                $('#penjurusanStatsSummary, #penjurusanQuotaMonitor, #penjurusanToolbar, #penjurusanStudentsSection').removeClass('hidden');
                $('#btnProsesPenjurusan').prop('disabled', false);

                renderPenjurusanTable();
                updateLivePenjurusanQuota();
                updatePenjurusanStats();
            })
            .catch(err => {
                $('#penjurusanStudentsList').html('<tr><td colspan="4" class="py-8 text-center text-xs text-rose-500"><i class="fas fa-exclamation-triangle mr-2"></i>Gagal memuat data siswa.</td></tr>');
            });
    }

    function renderPenjurusanTable() {
        let html = '';
        
        penjurusanStudents.forEach((student, index) => {
            // Quick pill buttons HTML - Clean, legible horizontal buttons
            let pillsHtml = '<div class="flex items-center gap-1.5 flex-wrap sm:flex-nowrap overflow-x-auto py-1">';
            penjurusanKelasXIList.forEach(cls => {
                const isActive = student.target === cls.name;
                const activeClass = isActive 
                    ? 'bg-[#D65A20] text-white border-[#D65A20] font-bold shadow-sm ring-2 ring-orange-500/40' 
                    : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-700 hover:border-orange-400 hover:text-orange-600 font-semibold';
                
                const safeClsKey = cls.name.replace(/\s+/g, '_').replace(/\./g, '_');
                pillsHtml += `
                    <button type="button" 
                            onclick="selectPenjurusanPill(${student.id}, '${cls.name}')" 
                            class="pill-btn-${student.id} pill-class-${safeClsKey} px-3 py-1.5 text-xs rounded-xl border transition-all duration-150 flex items-center justify-center gap-1 whitespace-nowrap shadow-xs ${activeClass}" 
                            data-class="${cls.name}"
                            title="Set ke ${cls.name}">
                        <span>${cls.name}</span>
                        <span class="active-check-${student.id}-${safeClsKey} ${isActive ? 'inline' : 'hidden'} text-[10px] text-white"><i class="fas fa-check"></i></span>
                    </button>
                `;
            });
            pillsHtml += '</div>';

            // Status Badge
            const statusBadgeHtml = student.target 
                ? `<span class="status-badge-${student.id} inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300"><i class="fas fa-check-circle mr-1 text-[8px]"></i>${student.target}</span>` 
                : `<span class="status-badge-${student.id} inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300">Belum Diplot</span>`;

            html += `
                <tr class="penjurusan-row odd:bg-white even:bg-slate-50/50 dark:odd:bg-slate-900 dark:even:bg-slate-800/30 hover:bg-orange-50/30 dark:hover:bg-orange-950/10 transition-colors" 
                    id="row_student_${student.id}"
                    data-student-id="${student.id}"
                    data-name="${student.nama.toLowerCase()}" 
                    data-nis="${(student.nis || '').toLowerCase()}"
                    data-assigned="${student.target ? '1' : '0'}">
                    
                    <td class="py-3 px-3 text-center">
                        <input type="checkbox" 
                                class="penjurusan-student-checkbox rounded border-slate-300 text-orange-500 focus:ring-orange-500 cursor-pointer" 
                                value="${student.id}" 
                                onchange="updatePenjurusanCheckedCount()">
                        <input type="hidden" name="id_siswa[]" value="${student.id}">
                    </td>
                    
                    <td class="py-3 px-4">
                        <div class="min-w-0">
                            <span class="font-bold text-slate-800 dark:text-slate-100 block text-xs truncate" title="${student.nama}">${student.nama}</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[10px] text-slate-400 font-mono">${student.nis || '-'}</span>
                                <div id="badge_container_${student.id}">${statusBadgeHtml}</div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="py-3 px-4">
                        ${pillsHtml}
                    </td>
                </tr>
            `;
        });

        $('#penjurusanStudentsList').html(html);
        $('#checkAllPenjurusan').prop('checked', false);
        updatePenjurusanCheckedCount();
    }

    function selectPenjurusanPill(studentId, className) {
        const student = penjurusanStudents.find(s => s.id === studentId);
        if (!student) return;

        if (student.target !== className) {
            // Check capacity before assigning
            const cls = penjurusanKelasXIList.find(c => c.name === className);
            if (cls) {
                const max = cls.max_students || 36;
                const alreadyAssignedOthers = penjurusanStudents.filter(s => s.target === className && s.id !== studentId).length;
                const projectedTotal = cls.current_count + alreadyAssignedOthers + 1;
                if (projectedTotal > max) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kapasitas Penuh!',
                        text: `Kapasitas kelas ${className} sudah PENUH (${max}/${max} kursi). Silakan pilih kelas XI tujuan lainnya.`,
                        confirmButtonColor: '#D65A20',
                        confirmButtonText: 'Mengerti'
                    });
                    return;
                }
            }
            student.target = className;
        } else {
            student.target = ''; // Toggle off
        }

        updateSingleStudentUI(studentId, student.target);
        updateLivePenjurusanQuota();
        updatePenjurusanStats();
    }

    function updateSingleStudentUI(studentId, targetClass) {
        // 1. Update pill button classes
        $(`.pill-btn-${studentId}`).each(function() {
            const pillClass = $(this).attr('data-class');
            const safeClsKey = pillClass.replace(/\s+/g, '_').replace(/\./g, '_');
            const checkIcon = $(this).find(`.active-check-${studentId}-${safeClsKey}`);

            if (pillClass === targetClass) {
                $(this).removeClass('bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-700 hover:border-orange-400 hover:text-orange-600 font-semibold')
                       .addClass('bg-[#D65A20] text-white border-[#D65A20] font-bold shadow-sm ring-2 ring-orange-500/40');
                checkIcon.removeClass('hidden').addClass('inline');
            } else {
                $(this).removeClass('bg-[#D65A20] text-white border-[#D65A20] font-bold shadow-sm ring-2 ring-orange-500/40')
                       .addClass('bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-slate-200 dark:border-slate-700 hover:border-orange-400 hover:text-orange-600 font-semibold');
                checkIcon.addClass('hidden').removeClass('inline');
            }
        });

        // 2. Update status badge
        const badgeHtml = targetClass
            ? `<span class="status-badge-${studentId} inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300"><i class="fas fa-check-circle mr-1 text-[8px]"></i>${targetClass}</span>`
            : `<span class="status-badge-${studentId} inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300">Belum Diplot</span>`;
        $(`#badge_container_${studentId}`).html(badgeHtml);

        // 3. Update data-assigned attribute on row
        $(`#row_student_${studentId}`).attr('data-assigned', targetClass ? '1' : '0');
    }

    function toggleAllPenjurusanCheckboxes(isChecked) {
        $('.penjurusan-row:visible .penjurusan-student-checkbox').prop('checked', isChecked);
        updatePenjurusanCheckedCount();
    }

    function updatePenjurusanCheckedCount() {
        const checked = $('.penjurusan-student-checkbox:checked').length;
        $('#penjurusanBulkCount').text(`${checked} dipilih`);
    }

    function applyBulkPenjurusanTarget() {
        const targetClass = $('#penjurusanBulkTarget').val();
        if (!targetClass) {
            Swal.fire({
                icon: 'info',
                title: 'Pilih Kelas Tujuan',
                text: 'Silakan pilih Kelas XI Tujuan terlebih dahulu pada dropdown toolbar.',
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Baik'
            });
            $('#penjurusanBulkTarget').focus();
            return;
        }

        const checkedBoxes = $('.penjurusan-student-checkbox:checked');
        if (checkedBoxes.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Belum Ada Siswa Dipilih',
                text: 'Silakan centang minimal satu siswa yang ingin diterapkan kelas tujuannya.',
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Baik'
            });
            return;
        }

        const cls = penjurusanKelasXIList.find(c => c.name === targetClass);
        const max = cls ? (cls.max_students || 36) : 36;
        const currentBase = cls ? cls.current_count : 0;
        
        // Count existing assignments excluding checked students
        const checkedIds = checkedBoxes.map(function() { return parseInt($(this).val()); }).get();
        const existingOthers = penjurusanStudents.filter(s => s.target === targetClass && !checkedIds.includes(s.id)).length;
        const availableSlots = Math.max(0, max - (currentBase + existingOthers));

        if (checkedBoxes.length > availableSlots) {
            Swal.fire({
                icon: 'error',
                title: 'Kuota Tidak Mencukupi!',
                text: `Kapasitas kelas ${targetClass} hanya tersisa ${availableSlots} kursi lagi, tetapi Anda mencentang ${checkedBoxes.length} siswa.`,
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Tutup'
            });
            return;
        }

        checkedBoxes.each(function() {
            const studentId = parseInt($(this).val());
            const student = penjurusanStudents.find(s => s.id === studentId);
            if (student) {
                student.target = targetClass;
                updateSingleStudentUI(studentId, targetClass);
            }
        });

        // Uncheck all after applying
        $('.penjurusan-student-checkbox').prop('checked', false);
        $('#checkAllPenjurusan').prop('checked', false);
        updatePenjurusanCheckedCount();

        updateLivePenjurusanQuota();
        updatePenjurusanStats();
    }

    function autoDistributeRemainingPenjurusan() {
        const unassigned = penjurusanStudents.filter(s => !s.target);
        if (unassigned.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Semua Siswa Sudah Terplot',
                text: 'Semua siswa di kelas ini sudah memiliki kelas tujuan.',
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Tutup'
            });
            return;
        }

        // Calculate assigned counts in modal
        const counts = {};
        penjurusanKelasXIList.forEach(cls => {
            counts[cls.name] = cls.current_count + penjurusanStudents.filter(s => s.target === cls.name).length;
        });

        let assignedInThisRun = 0;
        unassigned.forEach(student => {
            // Filter classes that have not reached max_students
            const availableClasses = penjurusanKelasXIList.filter(cls => {
                const currentTotal = counts[cls.name] || 0;
                const max = cls.max_students || 36;
                return currentTotal < max;
            });

            if (availableClasses.length > 0) {
                availableClasses.sort((a, b) => (counts[a.name] || 0) - (counts[b.name] || 0));
                const chosenClass = availableClasses[0];

                student.target = chosenClass.name;
                counts[chosenClass.name] = (counts[chosenClass.name] || 0) + 1;
                updateSingleStudentUI(student.id, chosenClass.name);
                assignedInThisRun++;
            }
        });

        if (assignedInThisRun < unassigned.length) {
            const remainingUnassigned = unassigned.length - assignedInThisRun;
            Swal.fire({
                icon: 'warning',
                title: 'Sebagian Siswa Terbagi',
                text: `Sebanyak ${assignedInThisRun} siswa berhasil dibagi rata. ${remainingUnassigned} siswa lainnya tidak dapat ditempatkan karena seluruh kelas XI tujuan telah mencapai batas kuota maksimal.`,
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Tutup'
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Pembagian Rata Selesai',
                text: `${assignedInThisRun} siswa berhasil dibagi rata secara merata.`,
                timer: 1800,
                showConfirmButton: false
            });
        }

        updateLivePenjurusanQuota();
        updatePenjurusanStats();
    }

    function resetPenjurusanSelection(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        Swal.fire({
            title: 'Reset Pilihan Penjurusan?',
            text: 'Semua pilihan kelas tujuan yang belum disimpan pada kelas ini akan dikosongkan kembali.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#D65A20',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fas fa-undo mr-1.5"></i> Ya, Reset Pilihan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                penjurusanStudents.forEach(student => {
                    student.target = '';
                    updateSingleStudentUI(student.id, '');
                });

                // Uncheck all checkboxes
                $('#checkAllPenjurusan').prop('checked', false);
                $('.penjurusan-student-checkbox').prop('checked', false);
                updatePenjurusanCheckedCount();

                updateLivePenjurusanQuota();
                updatePenjurusanStats();

                Swal.fire({
                    icon: 'success',
                    title: 'Pilihan Direset',
                    text: 'Semua pilihan kelas tujuan telah dikosongkan.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
        return false;
    }

    function submitPenjurusanViaAjax() {
        const assignedStudents = penjurusanStudents.filter(s => s.target && s.target !== '');
        if (assignedStudents.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Belum Ada Siswa Terplot',
                text: 'Silakan tentukan kelas tujuan siswa terlebih dahulu sebelum menyimpan.',
                confirmButtonColor: '#D65A20',
                confirmButtonText: 'Baik'
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Penjurusan Siswa?',
            html: `Apakah Anda yakin ingin menyimpan penempatan <b>${assignedStudents.length} siswa</b> ke kelas XI tujuan masing-masing?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#D65A20',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="fas fa-save mr-1.5"></i> Ya, Simpan Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const btn = document.getElementById('btnProsesPenjurusan');
                const originalBtnHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i> Menyimpan...';

                Swal.fire({
                    title: 'Menyimpan Data...',
                    text: 'Mohon tunggu, sistem sedang memperbarui kelas siswa.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const id_siswa = [];
                const tujuan = {};

                penjurusanStudents.forEach(s => {
                    id_siswa.push(s.id);
                    tujuan[s.id] = s.target || null;
                });

                const csrfToken = document.querySelector('meta[name="csrf-token"]') 
                    ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                    : '{{ csrf_token() }}';

                fetch("{{ route('students.promote-students') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id_siswa: id_siswa,
                        tujuan: tujuan
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // 1. Update current_count on penjurusanKelasXIList so live quota remains accurate
                        penjurusanStudents.forEach(s => {
                            if (s.target) {
                                const targetCls = penjurusanKelasXIList.find(c => c.name === s.target);
                                if (targetCls) {
                                    targetCls.current_count = (targetCls.current_count || 0) + 1;
                                }
                            }
                        });

                        // 2. Mark completed class in dropdown
                        const currentClassVal = $('#kelasXSelector').val();
                        if (currentClassVal) {
                            const opt = $(`#kelasXSelector option[value="${currentClassVal}"]`);
                            opt.text(currentClassVal + ' (Selesai ✓)');
                            opt.prop('disabled', true);
                        }

                        // 3. Reset students list & selector for next class
                        $('#kelasXSelector').val('');
                        loadStudentsForPenjurusan('');
                        
                        btn.disabled = false;
                        btn.innerHTML = originalBtnHtml;

                        // 4. Show success alert without reloading page
                        Swal.fire({
                            icon: 'success',
                            title: 'Penjurusan Berhasil Disimpan!',
                            text: (data.message || 'Data berhasil disimpan.') + ' Silakan pilih kelas X berikutnya untuk melanjutkan.',
                            confirmButtonColor: '#D65A20',
                            confirmButtonText: '<i class="fas fa-arrow-right mr-1.5"></i> Lanjut Kelas Lain'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: data.message || 'Terjadi kesalahan saat memproses data.',
                            confirmButtonColor: '#D65A20'
                        });
                        btn.disabled = false;
                        btn.innerHTML = originalBtnHtml;
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Jaringan',
                        text: 'Terjadi kesalahan koneksi atau server: ' + err.message,
                        confirmButtonColor: '#D65A20'
                    });
                    btn.disabled = false;
                    btn.innerHTML = originalBtnHtml;
                });
            }
        });
    }

    function updateLivePenjurusanQuota() {
        // Count newly assigned per class in modal
        const newlyAssigned = {};
        penjurusanStudents.forEach(s => {
            if (s.target) {
                newlyAssigned[s.target] = (newlyAssigned[s.target] || 0) + 1;
            }
        });

        let badgesHtml = '';
        penjurusanKelasXIList.forEach(cls => {
            const added = newlyAssigned[cls.name] || 0;
            const total = cls.current_count + added;
            const max = cls.max_students || 36;
            const remaining = Math.max(0, max - total);

            const percentFilled = Math.min(100, Math.round((total / max) * 100));

            let cardBorder = 'border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900';
            let badgeBg = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300';
            let progressColor = 'bg-emerald-500';
            let badgeText = `Sisa ${remaining} Kursi`;

            if (total >= max) {
                cardBorder = 'border-rose-300 dark:border-rose-900 bg-rose-50/40 dark:bg-rose-950/20';
                badgeBg = 'bg-rose-600 text-white animate-pulse';
                progressColor = 'bg-rose-600';
                badgeText = 'PENUH';
            } else if (remaining <= 5) {
                cardBorder = 'border-amber-300 dark:border-amber-900 bg-amber-50/40 dark:bg-amber-950/20';
                badgeBg = 'bg-amber-200 text-amber-900 dark:bg-amber-900/60 dark:text-amber-200';
                progressColor = 'bg-amber-500';
                badgeText = `Sisa ${remaining} Kursi`;
            } else if (added > 0) {
                cardBorder = 'border-emerald-300 dark:border-emerald-800 bg-emerald-50/30 dark:bg-emerald-950/20';
            }

            badgesHtml += `
                <div class="p-3 rounded-xl border transition-all duration-200 flex flex-col justify-between shadow-xs ${cardBorder}">
                    <div class="flex items-center justify-between gap-1 mb-1">
                        <span class="font-extrabold text-sm text-slate-800 dark:text-slate-100 tracking-tight">${cls.name}</span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-lg whitespace-nowrap ${badgeBg}">${badgeText}</span>
                    </div>

                    <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 my-1 overflow-hidden border border-slate-200/60 dark:border-slate-700/60">
                        <div class="h-2 rounded-full transition-all duration-300 ${progressColor}" style="width: ${percentFilled}%"></div>
                    </div>

                    <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium mt-1">
                        Terisi <strong class="text-slate-800 dark:text-slate-100 font-bold font-mono">${total}</strong> dari <span class="font-mono font-semibold">${max}</span> siswa
                    </div>
                </div>
            `;

            // Mark full pills visually
            const safeClsKey = cls.name.replace(/\s+/g, '_').replace(/\./g, '_');
            if (remaining <= 0) {
                $(`.pill-class-${safeClsKey}:not(.bg-\\[\\#D65A20\\])`).addClass('opacity-35 cursor-not-allowed border-dashed bg-slate-100').attr('title', `Kelas ${cls.name} sudah PENUH!`);
            } else {
                $(`.pill-class-${safeClsKey}:not(.bg-\\[\\#D65A20\\])`).removeClass('opacity-35 cursor-not-allowed border-dashed bg-slate-100').attr('title', `Set ke ${cls.name} (Tersisa ${remaining} slot)`);
            }
        });

        $('#penjurusanQuotaBadges').html(badgesHtml);

        // Update bulk select options with dynamic remaining slots
        const bulkSelect = document.getElementById('penjurusanBulkTarget');
        if (bulkSelect) {
            const currentVal = bulkSelect.value;
            let optionsHtml = '<option value="">Pilih Kelas XI Tujuan...</option>';
            penjurusanKelasXIList.forEach(cls => {
                const added = newlyAssigned[cls.name] || 0;
                const total = cls.current_count + added;
                const max = cls.max_students || 36;
                const remaining = Math.max(0, max - total);
                const disabled = remaining <= 0 ? 'disabled' : '';
                const isSelected = currentVal === cls.name ? 'selected' : '';
                const slotLabel = remaining <= 0 ? '[PENUH - 0 Slot]' : `(Sisa: ${remaining} slot / Kapasitas ${max})`;

                optionsHtml += `<option value="${cls.name}" ${disabled} ${isSelected}>${cls.name} ${slotLabel}</option>`;
            });
            bulkSelect.innerHTML = optionsHtml;
        }
    }

    function updatePenjurusanStats() {
        const total = penjurusanStudents.length;
        const assigned = penjurusanStudents.filter(s => s.target).length;
        const unassigned = total - assigned;

        $('#statTotalStudents').text(`${total} Siswa`);
        $('#statAssignedCount').text(`${assigned} Terplot`);
        $('#statUnassignedCount').text(`${unassigned} Belum Terplot`);

        $('#countFilterAll').text(total);
        $('#countFilterUnassigned').text(unassigned);
        $('#countFilterAssigned').text(assigned);

        // Control Submit button state
        $('#btnProsesPenjurusan').prop('disabled', assigned === 0);

        if (assigned > 0) {
            $('#penjurusanFooterSummary').html(`<strong class="text-emerald-600 dark:text-emerald-400">${assigned}</strong> dari ${total} siswa siap dipindahkan ke Kelas XI.`);
        } else {
            $('#penjurusanFooterSummary').text(`0 dari ${total} siswa terpilih. Silakan tentukan kelas tujuan siswa.`);
        }

        filterPenjurusanStudents();
    }

    function setPenjurusanFilterMode(mode) {
        penjurusanFilterMode = mode;

        $('#btnFilterAll, #btnFilterUnassigned, #btnFilterAssigned').removeClass('bg-orange-500 text-white font-bold').addClass('text-slate-600 dark:text-slate-300 font-semibold hover:bg-slate-100 dark:hover:bg-slate-800');

        if (mode === 'all') {
            $('#btnFilterAll').addClass('bg-orange-500 text-white font-bold').removeClass('text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800');
        } else if (mode === 'unassigned') {
            $('#btnFilterUnassigned').addClass('bg-orange-500 text-white font-bold').removeClass('text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800');
        } else if (mode === 'assigned') {
            $('#btnFilterAssigned').addClass('bg-orange-500 text-white font-bold').removeClass('text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800');
        }

        filterPenjurusanStudents();
    }

    function filterPenjurusanStudents() {
        const keyword = ($('#searchPenjurusanSiswa').val() || '').toLowerCase().trim();

        $('.penjurusan-row').each(function() {
            const name = $(this).attr('data-name') || '';
            const nis = $(this).attr('data-nis') || '';
            const isAssigned = $(this).attr('data-assigned') === '1';

            const matchesKeyword = !keyword || name.includes(keyword) || nis.includes(keyword);
            let matchesFilter = true;

            if (penjurusanFilterMode === 'unassigned') {
                matchesFilter = !isAssigned;
            } else if (penjurusanFilterMode === 'assigned') {
                matchesFilter = isAssigned;
            }

            if (matchesKeyword && matchesFilter) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    }

    // Bind event handler for search input inside modal
    $(document).on('keyup', '#searchGradStudents', function() {
        const keyword = $(this).val().toLowerCase();
        $('#gradStudentsList .student-item').each(function() {
            const name = $(this).attr('data-name');
            if (name.includes(keyword)) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    });
    function toggleAllClasses(isChecked) {
        const container = document.getElementById('kelasTwelveContainer');
        if (!container) return;
        const checkboxes = container.querySelectorAll('.kelas-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = isChecked;
        });
        loadStudentsForGraduation();
    }

    function toggleAllCheckboxes(containerId, isChecked, updateCallback) {
        const container = document.getElementById(containerId);
        if (!container) return;
        const checkboxes = container.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => {
            // Only affect visible (non-filtered) checkboxes
            if (cb.closest('label') && cb.closest('label').style.display !== 'none') {
                cb.checked = isChecked;
            }
        });
        if (updateCallback === 'updateGradCount' && typeof updateGradCount === 'function') updateGradCount();
        if (updateCallback === 'updatePromoCount' && typeof updatePromoCount === 'function') updatePromoCount();
    }

    // Auto Match Classes function
    function autoMatchClasses() {
        // Track already selected target classes so we don't map multiple origin classes to the same target class
        const usedTargets = new Set();
        
        // Track all origin classes in this bulk promotion to know which ones will be emptied
        const originClasses = new Set();
        document.querySelectorAll('.auto-mapping-select').forEach(select => {
            const asal = select.getAttribute('data-asal');
            if (asal) originClasses.add(asal.trim().toUpperCase());
        });
        
        document.querySelectorAll('.auto-mapping-select').forEach(select => {
            const asal = select.getAttribute('data-asal');
            if (!asal) return;
            
            const originCount = parseInt(select.getAttribute('data-students-count')) || 0;
            const cleanAsal = asal.trim().toUpperCase();
            
            // Tentukan pola nama kelas tujuan yang diharapkan (misal XI F 1 -> XII F 1)
            let targetName = '';
            if (cleanAsal.startsWith('XI ')) targetName = cleanAsal.replace(/^XI /, 'XII ');
            else if (cleanAsal.startsWith('XI.')) targetName = cleanAsal.replace(/^XI\./, 'XII.');
            else if (cleanAsal.startsWith('XI')) targetName = cleanAsal.replace(/^XI/, 'XII');
            else if (cleanAsal.startsWith('X ')) targetName = cleanAsal.replace(/^X /, 'XI ');
            else if (cleanAsal.startsWith('X.')) targetName = cleanAsal.replace(/^X\./, 'XI.');
            else if (cleanAsal.startsWith('X')) targetName = cleanAsal.replace(/^X/, 'XI');
            
            let found = false;
            
            // Function to check if option is valid (not used + has capacity)
            const isValidOption = (optVal, optionElement) => {
                if (usedTargets.has(optVal)) return false;
                const capacity = parseInt(optionElement.getAttribute('data-capacity')) || 36;
                let current = parseInt(optionElement.getAttribute('data-current')) || 0;
                
                // If the target class is ALSO an origin class in this promotion, 
                // assume its current students will leave, making it empty.
                if (originClasses.has(optVal)) {
                    current = 0;
                }
                
                return (current + originCount) <= capacity;
            };

            // 1. Exact Match Check
            for (let i = 0; i < select.options.length; i++) {
                const optVal = select.options[i].value.trim().toUpperCase();
                if (optVal === targetName && isValidOption(optVal, select.options[i])) {
                    select.selectedIndex = i;
                    usedTargets.add(optVal);
                    found = true;
                    break;
                }
            }
            
            // 2. Suffix Match Check
            if (!found && targetName) {
                const parts = cleanAsal.split(' ');
                if (parts.length > 1) {
                    const suffix = parts.slice(1).join(' ');
                    for (let i = 0; i < select.options.length; i++) {
                        const optVal = select.options[i].value.trim().toUpperCase();
                        if (optVal.endsWith(suffix) && isValidOption(optVal, select.options[i])) {
                            select.selectedIndex = i;
                            usedTargets.add(optVal);
                            found = true;
                            break;
                        }
                    }
                }
            }

            // 3. Sequential Mapping for Kurikulum Merdeka (if no exact match, just take the first available valid class)
            if (!found) {
                for (let i = 1; i < select.options.length; i++) { // Skip index 0 ("-- Jangan Naikkan Dulu --")
                    const optVal = select.options[i].value.trim().toUpperCase();
                    if (optVal !== '' && isValidOption(optVal, select.options[i])) {
                        select.selectedIndex = i;
                        usedTargets.add(optVal);
                        found = true;
                        break;
                    }
                }
            }
        });
    }
</script>
@endpush