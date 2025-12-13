// publico/recursos/js/menuHamburguesa.js

(function () {
    'use strict';

    // DEBUG: pon true para ver logs, false para silenciar
    var DEBUG = false;
    function log() { if (DEBUG && console && console.log) console.log.apply(console, arguments); }

    // Selector elements 
    var BTN_SELECTOR = '.btn-hamburguesa';
    var NAV_MOVIL_SELECTOR = '.nav-movil';
    var NAV_OVERLAY_SELECTOR = '.nav-movil .nav-movil-overlay';
    var NAV_INNER_SELECTOR = '.nav-movil .nav-movil-inner';
    var BODY_NAV_ABIERTO_CLASS = 'nav-abierto';
    var MOBILE_QUERY = '(max-width: 992px)'; 

    function qs(sel) { return document.querySelector(sel); }

    function init() {
        var btn = qs(BTN_SELECTOR);
        var nav = qs(NAV_MOVIL_SELECTOR);
        if (!btn || !nav) {
            log('[menuHamburguesa] elementos no encontrados; abortando init');
            return;
        }

        var overlay = qs(NAV_OVERLAY_SELECTOR);
        var inner = qs(NAV_INNER_SELECTOR);

        var mq = window.matchMedia(MOBILE_QUERY);

        function isMobile() {
            try { return mq.matches; }
            catch (e) { return window.innerWidth <= 992; }
        }

        function openNav() {
            if (!isMobile()) {
                log('[menuHamburguesa] open aborted: not mobile');
                return;
            }
            nav.classList.add('visible');
            document.body.classList.add(BODY_NAV_ABIERTO_CLASS);
            log('[menuHamburguesa] opened');
            var f = inner && inner.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
            if (f) f.focus();
        }

        function closeNav() {
            nav.classList.remove('visible');
            document.body.classList.remove(BODY_NAV_ABIERTO_CLASS);
            log('[menuHamburguesa] closed');
            btn.focus();
        }

        function toggleNav(e) {
            if (e && e.stopImmediatePropagation) e.stopImmediatePropagation();
            if (e && e.stopPropagation) e.stopPropagation();

            if (nav.classList.contains('visible')) closeNav();
            else openNav();
        }

        btn.addEventListener('click', function (e) {
            log('[menuHamburguesa] btn click');
            toggleNav(e);
        }, true);

        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault(); toggleNav(e);
            } else if (e.key === 'Escape') {
                if (nav.classList.contains('visible')) closeNav();
            }
        });

        if (overlay) {
            overlay.addEventListener('click', function (e) {
                if (nav.classList.contains('visible')) closeNav();
            });
            overlay.addEventListener('touchstart', function (e) {
                if (nav.classList.contains('visible')) { e.preventDefault(); closeNav(); }
            }, { passive: false });
        }

        document.addEventListener('click', function (e) {
            if (!nav.classList.contains('visible')) return;
            if (btn.contains(e.target) || nav.contains(e.target)) return;
            closeNav();
        }, true);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('visible')) closeNav();
        });

        if (mq && typeof mq.addEventListener === 'function') {
            mq.addEventListener('change', function (ev) {
                log('[menuHamburguesa] mq changed ->', ev.matches ? 'mobile' : 'desktop');
                if (!ev.matches && nav.classList.contains('visible')) {
                    closeNav();
                }
            });
        } else if (mq && typeof mq.addListener === 'function') {
            mq.addListener(function (matches) {
                if (!matches && nav.classList.contains('visible')) closeNav();
            });
        }


        log('[menuHamburguesa] init complete, mobile?', isMobile());
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();

})();
