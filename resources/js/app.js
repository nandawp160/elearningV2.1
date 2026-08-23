import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();

const LoadingOverlay = (() => {
    let timer = null;
    let overlay = null;

    const ensureOverlay = () => {
        if (!overlay) {
            overlay = document.getElementById('global-loading');
        }
        return overlay;
    };

    const show = (delay = 0) => {
        clearTimeout(timer);
        if (delay > 0) {
            timer = setTimeout(() => {
                const el = ensureOverlay();
                if (el) {
                    el.classList.add('is-active');
                    el.setAttribute('aria-hidden', 'false');
                }
            }, delay);
        } else {
            const el = ensureOverlay();
            if (el) {
                el.classList.add('is-active');
                el.setAttribute('aria-hidden', 'false');
            }
        }
    };

    const hide = () => {
        clearTimeout(timer);
        const el = ensureOverlay();
        if (!el) return;
        el.classList.remove('is-active');
        el.setAttribute('aria-hidden', 'true');
    };

    const reset = () => {
        clearTimeout(timer);
        hide();
    };

    return { show, hide, start: show, stop: hide, reset };
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

document.addEventListener('submit', (event) => {
    const form = event.target;
    if (!form || form.tagName !== 'FORM') return;
    if (event.defaultPrevented) return;
    if (form.dataset.noLoading !== undefined) {
        window.isDownloading = true;
        setTimeout(() => {
            window.isDownloading = false;
        }, 1000);
        return;
    }

    // Tampilkan overlay jika form submit memakan waktu > 200ms (misal upload berkas besar)
    LoadingOverlay.show(200);
});

window.addEventListener('pageshow', () => {
    LoadingOverlay.reset();
});

window.addEventListener('pagehide', () => {
    LoadingOverlay.reset();
});
