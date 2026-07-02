<div 
    x-show="notification.show" 
    x-cloak 
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
>
    {{-- Backdrop --}}
    <div 
        x-show="notification.show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"
        @click="notification.show = false"
    ></div>

    {{-- Modal Content --}}
    <div 
        x-show="notification.show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full max-w-sm bg-white dark:bg-slate-900 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-slate-800 p-8 text-center overflow-hidden"
    >
        {{-- Decorative background element --}}
        <div class="absolute -top-24 -right-24 w-48 h-48 rounded-full blur-3xl opacity-10"
             :class="notification.type === 'success' ? 'bg-emerald-500' : 'bg-rose-500'"></div>

        {{-- Icon Section --}}
        <div class="relative mb-6">
            <div class="w-20 h-20 mx-auto rounded-3xl flex items-center justify-center transform rotate-12 transition-transform hover:rotate-0 duration-500"
                 :class="notification.type === 'success' ? 'bg-emerald-500 shadow-lg shadow-emerald-500/20' : 'bg-rose-500 shadow-lg shadow-rose-500/20'">
                <template x-if="notification.type === 'success'">
                    <i class="fas fa-check text-3xl text-white -rotate-12"></i>
                </template>
                <template x-if="notification.type === 'error'">
                    <i class="fas fa-exclamation-triangle text-3xl text-white -rotate-12"></i>
                </template>
                <template x-if="notification.type === 'info'">
                    <i class="fas fa-info-circle text-3xl text-white -rotate-12"></i>
                </template>
            </div>
        </div>

        {{-- Text Content --}}
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2" x-text="notification.type === 'success' ? 'Berhasil!' : 'Oops!' "></h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-8" x-html="notification.message"></p>

        {{-- Action Button --}}
        <button 
            @click="notification.show = false" 
            class="w-full py-4 px-6 rounded-2xl text-sm font-bold transition-all duration-300 transform active:scale-[0.98] shadow-lg"
            :class="notification.type === 'success' 
                ? 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-emerald-500/25' 
                : 'bg-rose-500 hover:bg-rose-600 text-white shadow-rose-500/25'"
        >
            Mengerti
        </button>
    </div>
</div>
