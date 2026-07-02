<footer class="border-t border-slate-200/70 dark:border-slate-800/70 py-6">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
        <div>
            &copy; {{ date('Y') }}
            <a href="#" class="ml-1 font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                {{ config('app.name', 'Sistem Pembayaran') }}
            </a>
        </div>
        <div class="flex items-center gap-4">
            <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">About</a>
            <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Support</a>
            <a href="#" class="hover:text-slate-700 dark:hover:text-slate-200 transition-colors">Documentation</a>
        </div>
    </div>
</footer>
