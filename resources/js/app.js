import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();

const LoadingOverlay = (() => {
    let counter = 0;
    let overlay = null;

    const ensureOverlay = () => {
        if (!overlay) {
            overlay = document.getElementById('global-loading');
        }
        return overlay;
    };

    const show = () => {
        const el = ensureOverlay();
        if (!el) return;
        el.classList.add('is-active');
        el.setAttribute('aria-hidden', 'false');
    };

    const hide = () => {
        const el = ensureOverlay();
        if (!el) return;
        el.classList.remove('is-active');
        el.setAttribute('aria-hidden', 'true');
    };

    const start = () => {
        counter += 1;
        show();
    };

    const stop = () => {
        counter = Math.max(0, counter - 1);
        if (counter === 0) hide();
    };

    const reset = () => {
        counter = 0;
        hide();
    };

    return { show, hide, start, stop, reset };
})();

window.LoadingOverlay = LoadingOverlay;

document.addEventListener('DOMContentLoaded', () => {
    LoadingOverlay.reset();
});

// Deteksi klik pada tautan unduhan/ekspor agar tidak memicu loading screen permanen
document.addEventListener('click', (event) => {
    const link = event.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    if (
        link.hasAttribute('download') || 
        link.dataset.noLoading !== undefined || 
        (href && (href.includes('/export') || href.includes('/download')))
    ) {
        window.isDownloading = true;
        setTimeout(() => {
            window.isDownloading = false;
        }, 1000);
    }
});

// Removed click listener that showed loading overlay to prevent swallowed clicks.
// The loading overlay is now handled reliably by the beforeunload listener.

document.addEventListener('submit', (event) => {
    const form = event.target;
    if (!form || form.tagName !== 'FORM') return;
    if (event.defaultPrevented) return;
    if (form.dataset.noLoading !== undefined) return;

    LoadingOverlay.show();
});

window.addEventListener('beforeunload', () => {
    if (window.isDownloading) {
        return;
    }
    LoadingOverlay.show();
});

window.addEventListener('pageshow', () => {
    LoadingOverlay.reset();
});

if (window.fetch && !window.__loadingFetchWrapped) {
    window.__loadingFetchWrapped = true;
    const originalFetch = window.fetch.bind(window);
    window.fetch = (...args) => {
        // Skip loading overlay for Vite HMR, dev-server, and internal requests
        const url = typeof args[0] === 'string' ? args[0] : (args[0]?.url || '');
        const isDevRequest = url.includes('/@vite') || url.includes('/__vite') ||
                             url.includes('.hot-update.') || url.includes('/@fs/') ||
                             url.includes('node_modules/') || url.startsWith('ws:');
        if (isDevRequest) {
            return originalFetch(...args);
        }
        LoadingOverlay.start();
        return originalFetch(...args)
            .finally(() => LoadingOverlay.stop());
    };
}

if (window.axios && !window.__loadingAxiosBound) {
    window.__loadingAxiosBound = true;
    window.axios.interceptors.request.use(
        (config) => {
            LoadingOverlay.start();
            return config;
        },
        (error) => {
            LoadingOverlay.stop();
            return Promise.reject(error);
        }
    );

    window.axios.interceptors.response.use(
        (response) => {
            LoadingOverlay.stop();
            return response;
        },
        (error) => {
            LoadingOverlay.stop();
            return Promise.reject(error);
        }
    );
}
