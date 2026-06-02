// Livewire 4 bundles Alpine.js; including it here keeps Vite's HMR aware.
// Public-site JS hooks (e.g. floating WhatsApp scroll-show) go below.

document.addEventListener('DOMContentLoaded', () => {
    // Scroll-to-top button visibility (mint chip on /durabilitate section)
    const toTop = document.querySelector('[data-scroll-to-top]');
    if (toTop) {
        toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    }
});
