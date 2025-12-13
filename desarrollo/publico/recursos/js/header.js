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

    
(function () {
  'use strict';

  var userBtns = document.querySelectorAll('.user-btn');

  if (!userBtns || userBtns.length === 0) return;

  userBtns.forEach(function(btn) {
    var menu = btn.parentElement.querySelector('.user-dropdown');
    if (!menu) return;

    btn.setAttribute('aria-expanded', 'false');
    menu.hidden = menu.hidden === undefined ? true : !!menu.hidden;

    function toggleMenu(open) {
      var isOpen = btn.getAttribute('aria-expanded') === 'true';
      var wantOpen = open === undefined ? !isOpen : !!open;
      btn.setAttribute('aria-expanded', wantOpen ? 'true' : 'false');
      menu.hidden = !wantOpen;
    }

    btn.addEventListener('click', function (ev) {
      ev.stopPropagation();
      toggleMenu();
    });

    document.addEventListener('click', function (ev) {
      if (!menu.contains(ev.target) && ev.target !== btn) {
        toggleMenu(false);
      }
    });

    document.addEventListener('keydown', function (ev) {
      if (ev.key === 'Escape') {
        toggleMenu(false);
      }
    });

    var links = menu.querySelectorAll('a, button');
    links.forEach(function (el) {
      el.addEventListener('click', function (ev) {
        toggleMenu(false);
      });
    });
  });
})();

})();
