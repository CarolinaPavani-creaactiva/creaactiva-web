// publico/recursos/js/accesibilidad.js
// Manejo local del menú de accesibilidad (A+ / A-). NO captura clicks globales.

document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("accesibilidadBtn");
    const menu = document.getElementById("accesibilidadMenu");
    if (!btn || !menu) return;

    const STORAGE_KEY = "access_font_scale_px";
    const LEGACY_KEY = "access_font_scale";
    const MIN_PX = 12;
    const MAX_PX = 28;
    const STEP_RATIO = 1.1;

    function parsePx(v) {
        if (!v) return null;
        const s = String(v).trim();
        if (s.indexOf('%') !== -1) {
            const n = parseFloat(s);
            if (isNaN(n)) return null;
            return (n / 100) * 16;
        }
        const m = s.match(/^(\d+(\.\d+)?)/);
        if (!m) return null;
        return parseFloat(m[1]);
    }
    function getComputedPx() {
        return parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
    }
    function setFontPx(px) {
        const clamped = Math.max(MIN_PX, Math.min(MAX_PX, Math.round(px * 10) / 10));
        const value = clamped + "px";
        document.documentElement.style.fontSize = value;
        try { localStorage.setItem(STORAGE_KEY, value); } catch (e) { /* ignore */ }
        // aria-live announcement (hidden)
        let live = document.getElementById("a11y-live");
        if (!live) {
            live = document.createElement("div"); live.id = "a11y-live";
            live.setAttribute("aria-live", "polite");
            live.style.position = "absolute"; live.style.left = "-9999px";
            document.body.appendChild(live);
        }
        live.textContent = "Tamaño de texto " + clamped + "px";
    }

    // Restaurar preferencia si existe
    try {
        const saved = localStorage.getItem(STORAGE_KEY) || localStorage.getItem(LEGACY_KEY);
        const px = parsePx(saved);
        if (px) setFontPx(px);
    } catch (e) { /* ignore */ }

    // Apertura / cierre del propio menú (solo su área)
    function openMenu() {
        menu.hidden = false;
        menu.classList.add("abierto");
        btn.setAttribute("aria-expanded", "true");
        // focus al primer elemento
        const first = menu.querySelector("button, [tabindex], a");
        if (first) first.focus();
    }
    function closeMenu() {
        menu.classList.remove("abierto");
        btn.setAttribute("aria-expanded", "false");
        menu.hidden = true;
        btn.focus();
    }
    function toggleMenu(e) {
        if (e && e.stopPropagation) e.stopPropagation();
        if (menu.classList.contains("abierto")) closeMenu(); else openMenu();
    }

    // Eventos: SOLO en btn y en el menú (no globales)
    btn.addEventListener("click", toggleMenu);

    menu.addEventListener("click", function (e) {
        // evitar que clicks en otros dropdowns sean capturados aquí
        e.stopPropagation();
        const opt = e.target.closest(".acc-option");
        if (!opt) return;
        const action = opt.getAttribute("data-action");
        const cur = getComputedPx();
        if (action === "increase") setFontPx(cur * STEP_RATIO);
        else if (action === "decrease") setFontPx(cur / STEP_RATIO);
        closeMenu();
    });

    // teclado en el menú
    menu.addEventListener("keydown", function (e) {
        if (e.key === "Escape") { closeMenu(); }
        if (e.key === "Enter" || e.key === " ") {
            const opt = e.target.closest(".acc-option");
            if (opt) { e.preventDefault(); opt.click(); }
        }
    });

    // cerrar si click fuera: este listener SOLO cierra si SU menú está abierto
    document.addEventListener("click", function (e) {
        if (!menu.classList.contains("abierto")) return;
        if (e.target === btn || btn.contains(e.target) || menu.contains(e.target)) return;
        closeMenu();
    });
});
