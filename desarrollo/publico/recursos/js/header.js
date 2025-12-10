// publico/recursos/js/header.js
(function(){
  function setCookie(name, value, days) {
    var expires = "";
    if (typeof days === "number") {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value || "") + expires + "; path=/";
  }
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i=0;i<ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length,c.length));
    }
    return null;
  }
  function eraseCookie(name){ setCookie(name, '', -1); }

  // Idioma
  var selectIdioma = document.getElementById('select-idioma');
  if (selectIdioma) {
    selectIdioma.addEventListener('change', function(){
      var lang = selectIdioma.value;
      setCookie('site_lang', lang, 365);
      localStorage.setItem('site_lang', lang);
      if (window.i18n && typeof window.i18n.changeLanguage === 'function') {
        try { window.i18n.changeLanguage(lang); } catch(e){ location.reload(); }
      } else { location.reload(); }
    });
  }

  // Contraste (único botón)
  var btnContraste = document.getElementById('btn-contraste');
  if (btnContraste) {
    btnContraste.addEventListener('click', function(){
      var cur = getCookie('site_contrast');
      if (cur === 'high') { eraseCookie('site_contrast'); document.body.classList.remove('alto-contraste'); btnContraste.setAttribute('aria-pressed','false'); }
      else { setCookie('site_contrast','high',365); document.body.classList.add('alto-contraste'); btnContraste.setAttribute('aria-pressed','true'); }
    });
    btnContraste.setAttribute('aria-pressed', document.body.classList.contains('alto-contraste') ? 'true' : 'false');
  }

  // Tamaño texto
  var btnA = document.getElementById('btn-aumentar-texto');
  var btnD = document.getElementById('btn-disminuir-texto');
  var scale = parseFloat(localStorage.getItem('site_font_scale')) || 1.0;
  function aplicar(s){ document.documentElement.style.fontSize = (100*s) + '%'; localStorage.setItem('site_font_scale', s); }
  aplicar(scale);
  if (btnA) btnA.addEventListener('click', function(){ scale = Math.min(1.5, +(scale + 0.1).toFixed(2)); aplicar(scale); });
  if (btnD) btnD.addEventListener('click', function(){ scale = Math.max(0.8, +(scale - 0.1).toFixed(2)); aplicar(scale); });

  // Toggle menu movil
  var btnHamb = document.getElementById('btn-hamburguesa');
  var navMovil = document.getElementById('nav-movil');
  if (btnHamb && navMovil) {
    function abrir(){ navMovil.classList.add('open'); navMovil.setAttribute('aria-hidden','false'); btnHamb.setAttribute('aria-expanded','true'); document.documentElement.style.overflow = 'hidden'; }
    function cerrar(){ navMovil.classList.remove('open'); navMovil.setAttribute('aria-hidden','true'); btnHamb.setAttribute('aria-expanded','false'); document.documentElement.style.overflow = ''; }
    btnHamb.addEventListener('click', function(){ navMovil.classList.contains('open') ? cerrar() : abrir(); });
    navMovil.addEventListener('click', function(e){ if (e.target === navMovil) cerrar(); });
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape' && navMovil.classList.contains('open')) cerrar(); });
  }

  // Init i18n if needed
  document.addEventListener('DOMContentLoaded', function(){
    if (window.i18n && typeof window.i18n.init === 'function') {
      try { window.i18n.init(); } catch(e) {}
    }
  });
})();
