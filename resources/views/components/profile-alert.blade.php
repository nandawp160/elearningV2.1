@if(auth()->check() && (
    (auth()->user()->isStudent() && auth()->user()->student && empty(auth()->user()->student->nis)) ||
    (auth()->user()->isTeacher() && auth()->user()->teacher && (empty(auth()->user()->teacher->nip) || empty(auth()->user()->teacher->email)))
))
<div class="mb-6 p-4 rounded-xl bg-orange-50 border border-orange-200 flex items-start gap-4 shadow-sm no-print">
    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <div>
        <h4 class="font-bold text-orange-800">Perhatian: Data Profil Belum Lengkap!</h4>
        <p class="text-sm text-orange-700 mt-1">Kami mendeteksi bahwa data penting seperti NIS/NIP belum terisi. Harap segera lengkapi biodata Anda melalui menu Profil agar Anda terdaftar dengan benar di sistem.</p>
        <a href="{{ auth()->user()->isStudent() ? route('student.biodata.create') : route('profile.edit') }}" class="inline-block mt-3 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Lengkapi Sekarang</a>
    </div>
</div>
@endif
