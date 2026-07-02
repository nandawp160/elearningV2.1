<section>
    <form method="post" action="{{ route('profile.guru.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nip" :value="__('NIP (Nomor Induk Pegawai)')" />
            <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip', $user->teacher->nip ?? '')" required autofocus autocomplete="nip" />
            <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="spesialisasi" :value="__('Spesialisasi (Mata Pelajaran)')" />
                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-500 uppercase tracking-wider">Hanya Admin</span>
            </div>
            <x-text-input id="spesialisasi" name="spesialisasi" type="text" class="mt-1 block w-full bg-slate-50 dark:bg-slate-800 text-slate-500 cursor-not-allowed select-none border-slate-200" :value="old('spesialisasi', $user->teacher->spesialisasi ?? '')" readonly />
            <p class="text-[11px] text-slate-400 mt-1.5"><i class="fas fa-lock mr-1"></i> Data spesialisasi hanya dapat diubah oleh Administrator Sekolah.</p>
        </div>

        <div>
            <x-input-label for="no_hp" :value="__('Nomor Handphone')" />
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->teacher->no_hp ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        <div>
            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-orange-500 dark:focus:border-orange-600 focus:ring-orange-500 dark:focus:ring-orange-600 rounded-lg shadow-sm" rows="3">{{ old('alamat', $user->teacher->alamat ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
            @if (session('status') === 'guru-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-semibold text-emerald-600"
                ><i class="fas fa-check-circle mr-1"></i> {{ __('Berhasil disimpan') }}</p>
            @endif
            <x-primary-button class="bg-orange-600 hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800">{{ __('Simpan Biodata') }}</x-primary-button>
        </div>
    </form>
</section>
