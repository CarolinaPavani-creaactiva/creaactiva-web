const h_btnMenu = document.getElementById('h_btn-menu');
const h_nav = document.getElementById('h_navegacion');

h_btnMenu.addEventListener('click', () => {
    h_nav.classList.toggle('h_activo');
});
// Fin botonHamburguesaHeader.js