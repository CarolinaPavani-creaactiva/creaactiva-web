// header.js - Helpers ligeros y ajustes menores para header (no maneja dropdowns)
(function () {
    'use strict';
    function qs(sel) { return document.querySelector(sel); }
    function qsa(sel) { return Array.from(document.querySelectorAll(sel)); }
    function obtenerElemento(id, fallbackSelector) {
        var el = document.getElementById(id);
        if (el) return el;
        if (fallbackSelector) return qs(fallbackSelector);
        return null;
    }
    window.headerHelpers = { qs: qs, qsa: qsa, obtenerElemento: obtenerElemento };
    document.addEventListener("DOMContentLoaded", function () {
        try {
            var header = document.getElementById("site-header");
            if (header) header.style.overflow = "visible";
            var wrappers = document.querySelectorAll(".language-wrapper, .accesibilidad-wrapper");
            wrappers.forEach(function(w){ w.style.overflow = "visible"; });
        } catch (e) { console.warn("header.js init error", e); }
    });

    // user-dropdown-toggle.js  (añádelo al final de header.js)
(function () {
  'use strict';

  // find all user menu buttons (supports future multiple instances)
  var userBtns = document.querySelectorAll('.user-btn');

  if (!userBtns || userBtns.length === 0) return;

  userBtns.forEach(function(btn) {
    var menu = btn.parentElement.querySelector('.user-dropdown');
    if (!menu) return;

    // ensure ARIA attributes initial state
    btn.setAttribute('aria-expanded', 'false');
    menu.hidden = menu.hidden === undefined ? true : !!menu.hidden;

    // toggle function
    function toggleMenu(open) {
      var isOpen = btn.getAttribute('aria-expanded') === 'true';
      var wantOpen = open === undefined ? !isOpen : !!open;
      btn.setAttribute('aria-expanded', wantOpen ? 'true' : 'false');
      menu.hidden = !wantOpen;
    }

    // click opens / closes
    btn.addEventListener('click', function (ev) {
      ev.stopPropagation();
      toggleMenu();
    });

    // close when clicking outside
    document.addEventListener('click', function (ev) {
      if (!menu.contains(ev.target) && ev.target !== btn) {
        toggleMenu(false);
      }
    });

    // close on escape
    document.addEventListener('keydown', function (ev) {
      if (ev.key === 'Escape') {
        toggleMenu(false);
      }
    });

    // ensure links inside menu behave normally (in case other handlers stop them)
    var links = menu.querySelectorAll('a, button');
    links.forEach(function (el) {
      el.addEventListener('click', function (ev) {
        // allow navigation; but close the menu after click (useful on mobile)
        toggleMenu(false);
      });
    });
  });
})();

})();
