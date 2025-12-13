// Este script gestiona la apertura y cierre del menú desplegable de usuario
// cuando se hace clic en el botón del usuario o se presiona la tecla Escape.
document.addEventListener('DOMContentLoaded', function () {
    var userBtn = document.getElementById('userBtn');
    var userDropdown = document.getElementById('userDropdown');
    if (!userBtn || !userDropdown) return;

     // Función para abrir el menú desplegable
    function open() {
        userBtn.setAttribute('aria-expanded', 'true');
        userDropdown.removeAttribute('hidden');
        userDropdown.classList.add('abierto');
    }
    // Función para cerrar el menú desplegable
    function close() {
        userBtn.setAttribute('aria-expanded', 'false');
        userDropdown.classList.remove('abierto');
        userDropdown.setAttribute('hidden', '');
    }
    // Alternar el estado del menú desplegable al hacer clic en el botón
    userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        if (userDropdown.classList.contains('abierto')) close(); else open();
    });
    // Cerrar el menú desplegable al hacer clic fuera de él o al presionar Escape
    document.addEventListener('click', function (e) {
        if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) close();
    });
    // Cerrar el menú desplegable al presionar la tecla Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') close();
    });
});
