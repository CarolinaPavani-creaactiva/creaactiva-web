document.addEventListener("DOMContentLoaded", () => {

  const BASE = "publico/recursos/i18n";
  const langBtn = document.getElementById("lang-btn");
  const langMenu = document.getElementById("lang-menu");

  const supported = ["es", "en", "va"]; // idiomas válidos en tu web

  // Idioma inicial desde localStorage
  let lang = localStorage.getItem("lang") || "es";
  actualizarBotonIdioma(lang);

  // ============================
  // ABRIR / CERRAR MENÚ IDIOMAS
  // ============================
  langBtn?.addEventListener("click", () => {
    langMenu?.classList.toggle("show");
  });

  // ============================
  // CAMBIO DE IDIOMA
  // ============================
  document.querySelectorAll("#lang-menu span[data-lang]").forEach(span => {
    span.addEventListener("click", async () => {
      const nuevoLang = span.dataset.lang;

      if (!supported.includes(nuevoLang)) return;

      // Guardar
      localStorage.setItem("lang", nuevoLang);
      lang = nuevoLang;

      actualizarBotonIdioma(lang);

      // 🔥 ACTUALIZAR FORMULARIO JOTFORM SI ESTAMOS EN CONTACTO
      actualizarIframeFormulario(lang);

      langMenu?.classList.remove("show");

      // Aplicar traducciones al contenido de tu web
      await aplicarTraducciones();
    });
  });

  // Aplicar traducciones iniciales
  aplicarTraducciones();

  // ============================
  // FUNCIONES
  // ============================

  function actualizarBotonIdioma(l) {
    if (!langBtn) return;
    langBtn.textContent = l.toUpperCase();
    langBtn.setAttribute("data-current-lang", l);
  }

  async function aplicarTraducciones() {
    lang = localStorage.getItem("lang") || "es";

    // 👇 Mapeo: "va" y "val" usan JSON en carpeta "va"
    const mapLang = {
      val: "va",
      ca: "va"
    };

    lang = mapLang[lang] || lang;

    const page = obtenerNombrePagina();

    const urls = [
      `${BASE}/${lang}/header_${lang}.json`,
      `${BASE}/${lang}/common_${lang}.json`,
      `${BASE}/${lang}/${page}_${lang}.json`,
      `${BASE}/${lang}/footer_${lang}.json`,
      `${BASE}/${lang}/mantenimiento_${lang}.json`
    ];

    const responses = await Promise.allSettled(
      urls.map(u => fetch(u, { cache: "no-store" }))
    );

    const jsons = [];

    for (let i = 0; i < responses.length; i++) {
      const r = responses[i];

      if (r.status === "fulfilled" && r.value.ok) {
        try {
          const data = await r.value.json();
          jsons.push(data);
        } catch (err) {
          console.warn("Error leyendo JSON:", urls[i]);
        }
      }
    }

    if (!jsons.length) return;

    document.querySelectorAll("[data-i18n]").forEach(el => {
      const key = el.dataset.i18n.trim();
      const attr = el.dataset.i18nAttr;

      let valor = null;

      for (const json of jsons) {
        const encontrado = obtenerClave(json, key);
        if (encontrado !== undefined) {
          valor = encontrado;
          break;
        }
      }

      if (valor === null || valor === undefined) return;

      if (attr) {
        el.setAttribute(attr, valor);
      } else {
        el.textContent = valor;
      }
    });
  }

  function obtenerClave(obj, key) {
    return key.split(".").reduce((o, k) => {
      if (o && typeof o === "object" && k in o) return o[k];
      return undefined;
    }, obj);
  }

  function obtenerNombrePagina() {
    const params = new URLSearchParams(window.location.search);
    const p = params.get("page");

    if (p) return p;

    const file = window.location.pathname.split("/").pop();

    if (!file || file === "index.php") return "home";

    return file.replace(/\.[^/.]+$/, "");
  }

  // ============================================
  // 🔥 ACTUALIZAR FORMULARIO JOTFORM SEGÚN IDIOMA
  // ============================================
  function actualizarIframeFormulario(langWeb) {
    const iframe = document.getElementById("JotFormIFrame-253363021678861");
    if (!iframe) return; // si NO estamos en la página contacto, salir

    // Valenciano/valenciano/catalán usan "ca" en JotForm
    let langJotform = (langWeb === "va" || langWeb === "val") ? "ca" : langWeb;

    iframe.src = `https://creaactiva.jotform.com/253363021678861?language=${langJotform}`;
  }

});
