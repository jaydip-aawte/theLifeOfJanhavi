/* =============================================================
   TheLifeOfJanhavi — Phase 3 Scrapbook JavaScript
   Scroll reveals, floating decorations, Open When envelopes,
   video memory modal, "Take Wishes To The Sky" animation.
   Lightweight, CSS-transform driven.
   ============================================================= */

(function () {
    'use strict';

    var reduceMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- Scroll Reveal (page transitions) ---------- */
    function initReveal() {
        var items = document.querySelectorAll('.reveal');
        if (!items.length) return;

        if (reduceMotion || !('IntersectionObserver' in window)) {
            items.forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }
        var obs = new IntersectionObserver(function (entries, o) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    o.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        items.forEach(function (el) { obs.observe(el); });
    }

    /* ---------- Floating Decorations (Module 9) ---------- */
    function initDecorations() {
        var layer = document.getElementById('decorLayer');
        if (!layer || reduceMotion) return;
        var set = (layer.getAttribute('data-decor') || '').split(',').filter(Boolean);
        if (!set.length) return;
        var count = window.innerWidth < 768 ? 9 : 16;
        for (var i = 0; i < count; i++) {
            var s = document.createElement('span');
            s.className = 'scrap-decor';
            s.textContent = set[Math.floor(Math.random() * set.length)];
            s.style.left = Math.random() * 100 + '%';
            s.style.fontSize = (Math.random() * 1.2 + 0.9) + 'rem';
            s.style.animationDuration = (Math.random() * 12 + 12) + 's';
            s.style.animationDelay = (Math.random() * 12) + 's';
            layer.appendChild(s);
        }
    }

    /* ---------- Open When Letters (envelope → letter) ---------- */
    function initEnvelopes() {
        var envelopes = document.querySelectorAll('.envelope');
        var overlay = document.getElementById('letterOverlay');
        if (!envelopes.length || !overlay) return;

        var titleEl = overlay.querySelector('.letter-title');
        var contentEl = overlay.querySelector('.letter-content');

        function openLetter(env) {
            env.classList.add('is-open');
            titleEl.textContent = env.getAttribute('data-title') || '';
            contentEl.textContent = env.getAttribute('data-content') || '';
            // brief delay so the flap animation is visible first
            setTimeout(function () { overlay.classList.add('open'); }, 280);
        }
        function closeLetter() {
            overlay.classList.remove('open');
            document.querySelectorAll('.envelope.is-open').forEach(function (e) {
                e.classList.remove('is-open');
            });
        }

        envelopes.forEach(function (env) {
            env.addEventListener('click', function () { openLetter(env); });
        });
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeLetter();
        });
        var closeBtn = overlay.querySelector('.letter-close');
        if (closeBtn) closeBtn.addEventListener('click', closeLetter);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeLetter();
        });
    }

    /* ---------- Video Memory Modal (Module 2) ---------- */
    function initVideoGallery() {
        var cards = document.querySelectorAll('.video-card[data-embed]');
        var overlay = document.getElementById('videoModal');
        if (!cards.length || !overlay) return;

        var frame = overlay.querySelector('.video-modal-frame');
        var nameEl = overlay.querySelector('.video-modal-name');
        var textEl = overlay.querySelector('.video-modal-text');

        function open(card) {
            var src = card.getAttribute('data-embed');
            frame.innerHTML = '<iframe src="' + src +
                '" title="video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            nameEl.textContent = card.getAttribute('data-name') || '';
            textEl.textContent = card.getAttribute('data-text') || '';
            overlay.classList.add('open');
        }
        function close() {
            overlay.classList.remove('open');
            frame.innerHTML = '';
        }
        cards.forEach(function (card) {
            card.addEventListener('click', function () { open(card); });
        });
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) close();
        });
        var closeBtn = overlay.querySelector('.letter-close');
        if (closeBtn) closeBtn.addEventListener('click', close);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });
    }

    /* ---------- Take Wishes To The Sky (Module 1) ---------- */
    function initSky() {
        var btn = document.getElementById('takeToSky');
        var sky = document.getElementById('nightSky');
        if (!btn || !sky) return;

        var dataEl = document.getElementById('wishData');
        var wishes = [];
        if (dataEl) {
            try { wishes = JSON.parse(dataEl.textContent) || []; } catch (e) { wishes = []; }
        }
        var reader = sky.querySelector('.star-reader');
        var readerName = sky.querySelector('.sr-name');
        var readerText = sky.querySelector('.sr-text');
        var built = false;

        function buildStars() {
            if (built) return;
            built = true;
            // twinkling background stars
            for (var i = 0; i < 60; i++) {
                var bg = document.createElement('span');
                bg.className = 'bg-star';
                bg.style.left = Math.random() * 100 + '%';
                bg.style.top = Math.random() * 100 + '%';
                bg.style.animationDelay = (Math.random() * 3) + 's';
                sky.appendChild(bg);
            }
            // wish stars
            var glyphs = ['⭐', '🌟', '✨', '💫'];
            wishes.forEach(function (w, idx) {
                var star = document.createElement('div');
                star.className = 'wish-star';
                star.innerHTML = '<span class="star-glyph">' +
                    glyphs[idx % glyphs.length] + '</span>' +
                    '<span class="star-name"></span>';
                star.querySelector('.star-name').textContent = w.name || '';
                star.style.left = (10 + Math.random() * 80) + '%';
                star.style.top = (18 + Math.random() * 60) + '%';
                star.addEventListener('click', function (e) {
                    e.stopPropagation();
                    readerName.textContent = w.name || '';
                    readerText.textContent = w.text || '';
                    reader.classList.add('show');
                });
                sky.appendChild(star);
                // stagger the float-in
                setTimeout(function () { star.classList.add('flew'); }, 200 + idx * 120);
            });
        }

        btn.addEventListener('click', function () {
            buildStars();
            sky.classList.add('open');
            document.body.style.overflow = 'hidden';
        });

        var closeBtn = sky.querySelector('.night-sky-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                sky.classList.remove('open');
                reader.classList.remove('show');
                document.body.style.overflow = '';
            });
        }
        sky.addEventListener('click', function (e) {
            if (e.target === sky) reader.classList.remove('show');
        });
    }

    function init() {
        initReveal();
        initDecorations();
        initEnvelopes();
        initVideoGallery();
        initSky();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
