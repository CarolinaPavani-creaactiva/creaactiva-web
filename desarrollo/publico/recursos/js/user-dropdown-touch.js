/* user-dropdown-touch inline — pegar justo antes de </body> */
window.__user_dropdown_touch_loaded = false;
(function () {
    'use strict';
    window.__user_dropdown_touch_loaded = true;

    function onceDOMContentLoaded(fn) {
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', fn);
        else fn();
    }

    onceDOMContentLoaded(function () {
        var btn = document.getElementById('userBtn') || document.querySelector('.user-btn');
        var menu = document.getElementById('userDropdown') || document.querySelector('.user-dropdown');
        if (!btn || !menu) return;

        function isOpen() { return menu.classList.contains('abierto'); }
        function openMenu() {
            menu.classList.add('abierto');
            try { menu.removeAttribute('hidden'); } catch (e) { }
            btn.setAttribute('aria-expanded', 'true');
        }
        function closeMenu() {
            menu.classList.remove('abierto');
            try { menu.setAttribute('hidden', ''); } catch (e) { }
            btn.setAttribute('aria-expanded', 'false');
        }
        function toggleMenu(e) {
            if (e && e.stopImmediatePropagation) e.stopImmediatePropagation();
            if (e && e.stopPropagation) e.stopPropagation();
            if (isOpen()) closeMenu(); else openMenu();
        }

        btn.addEventListener('click', toggleMenu, true);
        btn.addEventListener('touchstart', function (ev) { ev.preventDefault(); toggleMenu(ev); }, { passive: false, capture: true });

        document.addEventListener('click', function (ev) {
            if (!isOpen()) return;
            if (btn.contains(ev.target) || menu.contains(ev.target)) return;
            closeMenu();
        }, true);

        document.addEventListener('touchstart', function (ev) {
            if (!isOpen()) return;
            if (btn.contains(ev.target) || menu.contains(ev.target)) return;
            closeMenu();
        }, { passive: true, capture: true });

        document.addEventListener('keydown', function (ev) {
            if (ev.key === 'Escape' && isOpen()) closeMenu();
        });
    });
})();