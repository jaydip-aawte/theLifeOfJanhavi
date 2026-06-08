/* =============================================================
   TheLifeOfJanhavi — Core JavaScript
   Landing modal, music, lazy loading, floating hearts
   ============================================================= */

(function () {
    'use strict';

    /* ---------- Landing Modal ---------- */
    const LANDING_KEY = 'janhavi_visited';

    window.closeLandingModal = function () {
        const modal = document.getElementById('landingModal');
        if (modal) {
            modal.classList.add('hide');
            try {
                sessionStorage.setItem(LANDING_KEY, '1');
            } catch (e) { /* sessionStorage unavailable */ }
            // Remove from DOM after transition
            setTimeout(function () {
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }, 900);
        }
    };

    function initLandingModal() {
        const modal = document.getElementById('landingModal');
        if (!modal) return;

        let visited = false;
        try {
            visited = sessionStorage.getItem(LANDING_KEY) === '1';
        } catch (e) { /* ignore */ }

        if (visited) {
            modal.parentNode && modal.parentNode.removeChild(modal);
        }
    }

    /* ---------- Music Player ---------- */
    function initMusic() {
        const btn = document.getElementById('musicBtn');
        const audio = document.getElementById('bgMusic');

        if (!btn || !audio) return;

        btn.addEventListener('click', function () {
            if (audio.paused) {
                audio.play().then(function () {
                    btn.classList.add('playing');
                }).catch(function (err) {
                    console.warn('Music playback failed:', err);
                });
            } else {
                audio.pause();
                btn.classList.remove('playing');
            }
        });

        // Sync button state if audio ends
        audio.addEventListener('ended', function () {
            btn.classList.remove('playing');
        });
    }

    /* ---------- Lazy Loading (Intersection Observer) ---------- */
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('.lazy-image');
        if (lazyImages.length === 0) return;

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');
                        if (src) {
                            img.src = src;
                        }
                        img.classList.add('loaded');
                        obs.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            lazyImages.forEach(function (img) {
                observer.observe(img);
            });
        } else {
            // Fallback: load all immediately
            lazyImages.forEach(function (img) {
                const src = img.getAttribute('data-src');
                if (src) img.src = src;
                img.classList.add('loaded');
            });
        }
    }

    /* ---------- Floating Hearts ---------- */
    function initFloatingHearts() {
        const container = document.getElementById('floatingHearts');
        if (!container) return;

        const hearts = ['💕', '💖', '🌸', '✨', '🦋', '💗'];
        const count = window.innerWidth < 768 ? 8 : 15;

        for (let i = 0; i < count; i++) {
            const heart = document.createElement('span');
            heart.className = 'floating-heart';
            heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
            heart.style.left = Math.random() * 100 + '%';
            heart.style.fontSize = (Math.random() * 1.5 + 0.8) + 'rem';
            heart.style.animationDuration = (Math.random() * 15 + 15) + 's';
            heart.style.animationDelay = (Math.random() * 10) + 's';
            container.appendChild(heart);
        }
    }

    /* ---------- Init ---------- */
    function init() {
        initLandingModal();
        initMusic();
        initLazyLoading();
        initFloatingHearts();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
