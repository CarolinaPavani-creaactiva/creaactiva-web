const btnMenu = document.getElementById('h_btn-menu');
const nav = document.getElementById('h_navegacion');

btnMenu.addEventListener('click', () => {
    nav.classList.toggle('h_activo');
});
