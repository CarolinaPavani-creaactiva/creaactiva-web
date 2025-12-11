// publico/recursos/js/header.js
// Controla: language dropdown, accesibilidad A+/A-, hamburger toggle.
// Incluye: reparenting de #nav-movil a <body> para evitar stacking context del hero.

console.log('header.js cargado — inicializando controles de header');

(function () {

  /* -------------------- helpers -------------------- */
  function setCookie(name, value, days) {
    var expires = "";
    if (typeof days === "number") {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value || "") + expires + "; path=/";
  }
  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
  }

  /* -------------------- lógica principal -------------------- */

  // Esperamos DOMContentLoaded para manipular el DOM (y mover nav-movil)
  document.addEventListener('DOMContentLoaded', function () {

    // --- Mover nav-movil al body para evitar stacking context de ancestros ---
    (function ensureNavMovilAtBody() {
      var navMovil = document.getElementById('nav-movil');
      if (!navMovil) return;
      if (navMovil.parentElement !== document.body) {
        try {
          // Guardamos el estado visible para preservarlo tras mover
          var wasVisible = navMovil.classList.contains('visible');
          document.body.appendChild(navMovil);
          // Asegurar estilos pos-movimiento (por si hay overrides)
          navMovil.style.position = navMovil.style.position || 'fixed';
          navMovil.style.inset = navMovil.style.inset || '0';
          navMovil.style.zIndex = navMovil.style.zIndex || '120000';
          if (wasVisible) navMovil.classList.add('visible');
        } catch (e) {
          console.warn('header.js: no se pudo mover #nav-movil al body', e);
        }
      }
    })();

    // --- Selección de elementos ---
    var btnHamb = document.getElementById('btn-hamburguesa');
    var navMovil = document.getElementById('nav-movil');

    // Si no está el botón, no hacemos nada
    if (!btnHamb) {
      console.warn('header.js: #btn-hamburguesa no encontrado');
      return;
    }

    // Funciones abrir/cerrar
    function abrirNav() {
      if (!navMovil) return;
      navMovil.classList.add('visible');
      navMovil.setAttribute('aria-hidden', 'false');
      btnHamb.classList.add('active');
      btnHamb.setAttribute('aria-expanded', 'true');
      // evitar scroll del fondo
      document.documentElement.style.overflow = 'hidden';
      document.body.style.touchAction = 'none';
    }

    function cerrarNav() {
      if (!navMovil) return;
      navMovil.classList.remove('visible');
      navMovil.setAttribute('aria-hidden', 'true');
      btnHamb.classList.remove('active');
      btnHamb.setAttribute('aria-expanded', 'false');
      document.documentElement.style.overflow = '';
      document.body.style.touchAction = '';
    }

    // Toggle al hacer click en el botón
    btnHamb.addEventListener('click', function (e) {
      e.preventDefault();
      if (!navMovil) return;
      if (navMovil.classList.contains('visible')) cerrarNav();
      else abrirNav();
    });

    // Cerrar al clickar fuera del panel (click en el overlay)
    if (navMovil) {
      navMovil.addEventListener('click', function (e) {
        if (e.target === navMovil) cerrarNav();
      });
    }

    // Cerrar con Escape
    document.addEventListener('keydown', function (e) {
      if ((e.key === 'Escape' || e.key === 'Esc') && navMovil && navMovil.classList.contains('visible')) {
        cerrarNav();
      }
    });

    // Si hay enlaces dentro del nav-movil, cerrar al clicar uno (UX típico)
    if (navMovil) {
      var enlaces = navMovil.querySelectorAll('a');
      enlaces.forEach(function (a) {
        a.addEventListener('click', function () {
          cerrarNav();
        });
      });
    }

    // Inicialización i18n si el proyecto lo usa
    if (window.i18n && typeof window.i18n.init === 'function') {
      try { window.i18n.init(); } catch (e) { console.warn('i18n init error', e); }
    }

  }); // DOMContentLoaded

})();
