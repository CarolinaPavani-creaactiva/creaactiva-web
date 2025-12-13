/* publico/recursos/js/i18n.js
   i18n robusto (carga tolerante de JSON, merge y dropdown accesible)
   - Intenta múltiples nombres de fichero para evitar 404 si algunas páginas
     usan "mantenimiento" en lugar de "desarrollo", etc.
   - Mapea "va"/"val" -> "ca".
   - No rompe si falta un JSON; usa FALLBACK mínimo para header/nav.
   - Manejo accesible y robusto del dropdown de idioma integrado.
*/

(function () {
  'use strict';

  // --- Configuración básica / constantes ---
  var BASE = (window.I18N_BASE || '') + '/publico/recursos/i18n';
  var STORAGE_KEY = 'app_lang';
  var BUTTON_IDS = ['languageBtn', 'lang-btn'];
  var MENU_IDS = ['languageMenu', 'lang-menu'];
  var CACHE = {}; // cache simple en memoria

  // Fallback de emergencia (mínimo)
  var FALLBACK = {
    es: {
      header: { idiomaActual: 'ES', entrar: 'Entrar', accesibilidad: 'Accesibilidad' },
      nav: { inicio: 'Inicio', equipo: 'Equipo', servicios: 'Servicios', blog: 'Blog', contacto: 'Contacto' }
    },
    ca: {
      header: { idiomaActual: 'CA', entrar: 'Entrar', accesibilidad: 'Accessibilitat' },
      nav: { inicio: 'Inici', equipo: 'Equip', servicios: 'Serveis', blog: 'Blog', contacto: 'Contacte' }
    },
    en: {
      header: { idiomaActual: 'EN', entrar: 'Sign in', accesibilidad: 'Accessibility' },
      nav: { inicio: 'Home', equipo: 'Team', servicios: 'Services', blog: 'Blog', contacto: 'Contact' }
    }
  };

  // --- Utilidades pequeñas ---
  function q(idList) {
    for (var i = 0; i < idList.length; i++) {
      var el = document.getElementById(idList[i]);
      if (el) return el;
    }
    return null;
  }

  function safeJSONParse(text) {
    if (!text || !text.trim()) return {};
    try { return JSON.parse(text); } catch (err) { return {}; }
  }

  function mapFolderForLang(lang) {
    if (!lang) return 'es';
    var l = String(lang).toLowerCase();
    if (l === 'va' || l === 'val' || l === 'ca') return 'ca';
    if (l === 'en') return 'en';
    return 'es';
  }

  // Obtiene la "page" detectada (intenta query string, data-page, y pathname)
  function detectPage() {
    try {
      var sp = new URLSearchParams(window.location.search);
      var p = sp.get('page');
      if (p) return p;
    } catch (e) { /* ignore */ }
    var b = document.body;
    if (b && b.getAttribute) {
      var dp = b.getAttribute('data-page');
      if (dp) return dp;
    }
    var parts = (window.location.pathname || '').split('/').filter(Boolean);
    var name = parts.pop() || 'index.php';
    if (/index/i.test(name)) return 'home';
    return name.replace(/\.[a-z]+$/i, '');
  }

  function detectPageSafe() {
    try { return detectPage(); } catch (e) { return 'home'; }
  }

  // almacenamiento simple
  function getSavedLang() {
    try {
      var v = localStorage.getItem(STORAGE_KEY);
      if (v) return v;
      var c = document.cookie.match(/(?:^|; )site_lang=([^;]+)/);
      if (c) return decodeURIComponent(c[1]);
    } catch (e) {}
    return null;
  }

  function saveLang(l) {
    try {
      localStorage.setItem(STORAGE_KEY, l);
      document.cookie = "site_lang=" + encodeURIComponent(l) + "; path=/; max-age=" + (60 * 60 * 24 * 365);
    } catch (e) {}
  }

  // --- Generador de URLs candidatas (intenta varias alternativas por página) ---
  function candidateUrlsFor(lang, page) {
    var folder = mapFolderForLang(lang);
    var base = BASE;
    var pageName = String(page || '').replace(/\.[a-z]+$/i, '');

    var pageCandidates = [pageName];
    var altNames = ['mantenimiento', 'maintenance', 'home', 'index', 'pagina', 'desarrollo'];
    altNames.forEach(function (n) {
      if (!n) return;
      if (pageCandidates.indexOf(n) === -1) pageCandidates.push(n);
    });

    var urls = [];
    // header/common/footer: con sufijo de idioma o sin él
    var headerCandidates = ['header_' + folder + '.json', 'header.json'];
    var commonCandidates = ['common_' + folder + '.json', 'common.json'];
    var footerCandidates = ['footer_' + folder + '.json', 'footer.json'];

    headerCandidates.forEach(function (f) { urls.push(base + '/' + folder + '/' + f); });
    commonCandidates.forEach(function (f) { urls.push(base + '/' + folder + '/' + f); });

    pageCandidates.forEach(function (p) {
      if (!p) return;
      urls.push(base + '/' + folder + '/' + (p + '_' + folder + '.json'));
      urls.push(base + '/' + folder + '/' + (p + '.json'));
    });

    footerCandidates.forEach(function (f) { urls.push(base + '/' + folder + '/' + f); });

    // dedup
    var seen = {};
    urls = urls.filter(function (u) { if (seen[u]) return false; seen[u] = true; return true; });

    return urls;
  }

  // --- Fetch tolerante ---
  function fetchJsonTry(url) {
    if (CACHE[url]) return Promise.resolve(CACHE[url]);
    return fetch(url, { cache: 'no-store' }).then(function (res) {
      if (!res.ok) return Promise.reject({ code: res.status, url: url });
      return res.text().then(function (t) {
        var parsed = safeJSONParse(t);
        CACHE[url] = parsed;
        return parsed;
      });
    }).catch(function (err) {
      // loguear suavemente y devolver {}
      if (console && console.warn) console.warn('[i18n] fetch failed for', url, err && err.code ? ('http ' + err.code) : err);
      return {};
    });
  }

  // --- Merge helper (fusión superficial; subobjetos se mergean shallow) ---
  function mergeJsons(arr) {
    var merged = {};
    arr.forEach(function (o) {
      if (!o || typeof o !== 'object') return;
      Object.keys(o).forEach(function (k) {
        if (typeof o[k] === 'object' && o[k] !== null) {
          merged[k] = merged[k] || {};
          merged[k] = Object.assign({}, merged[k], o[k]);
        } else {
          merged[k] = o[k];
        }
      });
    });
    return merged;
  }

  // Helper para obtener valor por ruta
  function getByPath(obj, path) {
    if (!obj || !path) return undefined;
    return path.split('.').reduce(function (cur, p) { return (cur && typeof cur === 'object') ? cur[p] : undefined; }, obj);
  }

  // --- Aplicar traducciones al DOM ---
  function applyTranslations(jsonMerged) {
    var lang = getSavedLang() || (navigator.language || '').slice(0, 2) || 'es';
    lang = (lang === 'va') ? 'ca' : (lang ? lang.slice(0, 2) : 'es');

    // Si está vacío, usamos fallback mínimo para header/nav
    if (!jsonMerged || Object.keys(jsonMerged).length === 0) {
      jsonMerged = jsonMerged || {};
      jsonMerged.header = Object.assign({}, (FALLBACK[lang] || FALLBACK['es']).header, jsonMerged.header || {});
      jsonMerged.nav = Object.assign({}, (FALLBACK[lang] || FALLBACK['es']).nav, jsonMerged.nav || {});
    }

    // data-i18n -> texto o atributo
    Array.from(document.querySelectorAll('[data-i18n]')).forEach(function (el) {
      var key = el.getAttribute('data-i18n');
      if (!key) return;
      var val = getByPath(jsonMerged, key);
      if (val === undefined) return;
      var attr = el.getAttribute('data-i18n-attr');
      if (attr) el.setAttribute(attr, val);
      else el.textContent = val;
    });

    // placeholders
    Array.from(document.querySelectorAll('[data-i18n-placeholder]')).forEach(function (el) {
      var key = el.getAttribute('data-i18n-placeholder');
      var v = getByPath(jsonMerged, key);
      if (v !== undefined) el.setAttribute('placeholder', v);
    });

    // title attributes
    Array.from(document.querySelectorAll('[data-i18n-title]')).forEach(function (el) {
      var key = el.getAttribute('data-i18n-title');
      var v = getByPath(jsonMerged, key);
      if (v !== undefined) el.setAttribute('title', v);
    });

    // Actualizar etiqueta del botón de idioma si existe
    var btn = q(BUTTON_IDS);
    if (btn) {
      var label = getByPath(jsonMerged, 'header.idiomaActual') || getByPath(jsonMerged, 'encabezado.idiomaActual');
      var caret = btn.querySelector('.caret');
      if (label) {
        if (caret) {
          Array.from(btn.childNodes).forEach(function (n) { if (n.nodeType === 3) n.remove(); });
          btn.insertBefore(document.createTextNode(label + ' '), caret);
        } else btn.textContent = label + ' ';
      } else {
        var cur = getSavedLang() || 'es';
        if (caret) {
          Array.from(btn.childNodes).forEach(function (n) { if (n.nodeType === 3) n.remove(); });
          btn.insertBefore(document.createTextNode(cur.toUpperCase() + ' '), caret);
        } else btn.textContent = (getSavedLang() || 'ES').toUpperCase();
      }
    }
  }

  // --- Core loader: intenta múltiples URLs y mergea resultados ---
  function loadAndApply() {
    var lang = getSavedLang() || (navigator.language || '').slice(0, 2) || 'es';
    lang = (lang === 'va') ? 'ca' : (lang ? lang.slice(0, 2) : 'es');
    var page = detectPageSafe();

    var urls = candidateUrlsFor(lang, page);
    // map a promesas tolerantes
    var promises = urls.map(function (u) { return fetchJsonTry(u); });

    return Promise.all(promises).then(function (results) {
      // results es array de objetos (muchos serán {} si no existen)
      var merged = mergeJsons(results);
      // asegurar header/nav/footer fallback
      var headFallback = FALLBACK[lang] || FALLBACK['es'];
      merged.header = Object.assign({}, headFallback.header, merged.header || {});
      merged.nav = Object.assign({}, headFallback.nav, merged.nav || {});
      merged.footer = Object.assign({}, (headFallback.footer || {}), merged.footer || {});
      applyTranslations(merged);
      return merged;
    }).catch(function (err) {
      console.error('[i18n] loadAndApply final error', err);
      applyTranslations({});
      return {};
    });
  }

  // --- Dropdown / manejo accesible del selector de idioma ---
  function initDropdown() {
    var btn = q(BUTTON_IDS);
    var menu = q(MENU_IDS);
    if (!btn || !menu) return;

    if (!btn.hasAttribute('aria-expanded')) btn.setAttribute('aria-expanded', 'false');
    if (!menu.hasAttribute('role')) menu.setAttribute('role', 'menu');

    function openMenu() {
      btn.setAttribute('aria-expanded', 'true');
      if (menu.hasAttribute('hidden')) menu.removeAttribute('hidden');
      menu.classList.add('abierto');
      requestAnimationFrame(function () { menu.classList.add('animado'); });
      // focus primer item
      var first = menu.querySelector('button, a, [tabindex]:not([tabindex="-1"])');
      if (first) first.focus();
    }
    function closeMenu() {
      btn.setAttribute('aria-expanded', 'false');
      menu.classList.remove('animado');
      var ran = false;
      var onEnd = function () {
        if (ran) return; ran = true;
        if (!menu.hasAttribute('hidden')) menu.setAttribute('hidden', '');
        menu.classList.remove('abierto');
        menu.removeEventListener('transitionend', onEnd);
      };
      menu.addEventListener('transitionend', onEnd);
      setTimeout(onEnd, 360);
    }
    function toggleMenu(e) {
      if (e && e.stopPropagation) e.stopPropagation();
      if (menu.classList.contains('abierto')) closeMenu(); else openMenu();
    }

    btn.addEventListener('click', function (e) { e.stopPropagation(); toggleMenu(); });
    btn.addEventListener('keydown', function (e) {
      var k = e.key;
      if (k === 'Enter' || k === ' ' || k === 'Spacebar' || k === 'ArrowDown') {
        e.preventDefault(); openMenu();
      } else if (k === 'Escape') { closeMenu(); btn.focus(); }
    });

    // cierre fuera (non-capturing)
    document.addEventListener('click', function (e) {
      if (!btn.contains(e.target) && !menu.contains(e.target)) if (menu.classList.contains('abierto')) closeMenu();
    });

    // opciones de idioma dentro del menu: captura para interceptar otros listeners
    var opts = Array.from(menu.querySelectorAll('[data-role="lang-option"], .language-option, [data-lang]'));
    opts.forEach(function (opt) {
      var handler = function (e) {
        try { if (e.preventDefault) e.preventDefault(); } catch (err) { /* ignore */ }
        if (e.stopImmediatePropagation) e.stopImmediatePropagation();
        if (e.stopPropagation) e.stopPropagation();

        var lang = opt.getAttribute('data-lang') || opt.dataset.lang;
        if (!lang) return;
        saveLang(lang);
        try { loadAndApply().catch(function () { setTimeout(loadAndApply, 100); }); } catch (err) { setTimeout(loadAndApply, 100); }
        closeMenu();
      };
      opt.addEventListener('click', handler, true);

      opt.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ' || e.key === 'Spacebar') {
          e.preventDefault(); handler(e);
        } else if (e.key === 'ArrowDown') {
          e.preventDefault();
          var next = this.parentElement.nextElementSibling;
          if (next) {
            var f = next.querySelector('button, a, [tabindex]:not([tabindex="-1"])');
            if (f) f.focus();
          }
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          var prev = this.parentElement.previousElementSibling;
          if (prev) {
            var f = prev.querySelector('button, a, [tabindex]:not([tabindex="-1"])');
            if (f) f.focus();
          }
        }
      });
    });
  }

  // Exponer API pública mínima
  window.traducir = window.traducir || {};
  window.traducir.aplicar = loadAndApply;
  window.setLanguage = function (lang) {
    if (!lang) return;
    saveLang(String(lang).slice(0, 2));
    try { loadAndApply(); } catch (e) { setTimeout(loadAndApply, 50); }
  };

  // Inicialización automática
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { loadAndApply(); initDropdown(); });
  } else {
    loadAndApply(); initDropdown();
  }

})();
