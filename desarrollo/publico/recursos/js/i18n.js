document.addEventListener("DOMContentLoaded", () => {
  const BASE = "publico/recursos/i18n";
  const langBtn = document.getElementById("lang-btn");
  const langMenu = document.getElementById("lang-menu");

  const supported = ["es", "en", "val"];

  let lang = localStorage.getItem("lang") || "es";
  actualizarBotonIdioma(lang);

  // Abrir / cerrar menú
  langBtn?.addEventListener("click", () => {
    langMenu?.classList.toggle("show");
  });

  // Cambio de idioma
  document.querySelectorAll("#lang-menu span[data-lang]").forEach(span => {
    span.addEventListener("click", async () => {
      const nuevoLang = span.dataset.lang;

      if (!supported.includes(nuevoLang)) return;

      localStorage.setItem("lang", nuevoLang);
      lang = nuevoLang;

      actualizarBotonIdioma(lang);
      langMenu?.classList.remove("show");

      await aplicarTraducciones();
    });
  });

  aplicarTraducciones();

  // ===========================
  // FUNCIONES
  // ===========================

  function actualizarBotonIdioma(l) {
    if (!langBtn) return;
    langBtn.textContent = l.toUpperCase();
    langBtn.setAttribute("data-current-lang", l);
  }

  async function aplicarTraducciones() {
    lang = localStorage.getItem("lang") || "es";

    const page = obtenerNombrePagina();

    // 🔥 IMPORTANTE: mantenimiento necesita su JSON siempre
    const urls = [
      `${BASE}/${lang}/header_${lang}.json`,
      `${BASE}/${lang}/common_${lang}.json`,
      `${BASE}/${lang}/${page}_${lang}.json`,
      `${BASE}/${lang}/footer_${lang}.json`,
      `${BASE}/${lang}/mantenimiento_${lang}.json` // <-- AÑADIDO
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

    // 🔥 Ahora también soporta data-i18n-attr="alt" placeholder, title...
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
        // si tiene atributo para traducir
        el.setAttribute(attr, valor);
      } else {
        // si solo es texto
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
});
