// Este script gestiona la apertura, cierre y el comportamiento táctil del menú desplegable de usuario,
// incluyendo la interacción con el botón de usuario y eventos táctiles en dispositivos móviles.
window.__user_dropdown_touch_loaded = false;
(function () {
    'use strict';
    window.__user_dropdown_touch_loaded = true;

    // Función que asegura que el código se ejecute una vez el DOM esté completamente cargado
    function onceDOMContentLoaded(fn) {
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', fn);
        else fn();
    }

    onceDOMContentLoaded(function () {
        var btn = document.getElementById('userBtn') || document.querySelector('.user-btn');
        var menu = document.getElementById('userDropdown') || document.querySelector('.user-dropdown');
        if (!btn || !menu) return;

        // Inicialización del estado ARIA y visibilidad del menú
        function isOpen() { return menu.classList.contains('abierto'); }

        // Funciones para abrir, cerrar y alternar el menú
        function openMenu() {
            menu.classList.add('abierto');
            try { menu.removeAttribute('hidden'); } catch (e) { }
            btn.setAttribute('aria-expanded', 'true');
        }

        // Función para cerrar el menú
        function closeMenu() {
            menu.classList.remove('abierto');
            try { menu.setAttribute('hidden', ''); } catch (e) { }
            btn.setAttribute('aria-expanded', 'false');
        }
        
        // Función para alternar el menú
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