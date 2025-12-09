function cambiarIdioma() {
    let currentLang = new URLSearchParams(window.location.search).get("lang") || "es";
    let newLang = currentLang === "val" ? "es" : "val"; 
    window.location.href = "?lang=" + newLang;
}