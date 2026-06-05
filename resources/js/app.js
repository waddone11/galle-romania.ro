// Livewire 4 bundles Alpine.js; including it here keeps Vite's HMR aware.
// Public-site JS hooks (e.g. floating WhatsApp scroll-show) go below.

document.addEventListener('DOMContentLoaded', () => {
    // Scroll-to-top global (fixed in layout): click -> sus, vizibil dupa 400px.
    const toTop = document.querySelector('[data-scroll-to-top]');
    if (toTop) {
        toTop.addEventListener('click', () => {
            const smooth = !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            window.scrollTo({ top: 0, behavior: smooth ? 'smooth' : 'auto' });
        });
        const toggle = () => toTop.toggleAttribute('data-visible', window.scrollY > 400);
        window.addEventListener('scroll', toggle, { passive: true });
        toggle();
    }
});
