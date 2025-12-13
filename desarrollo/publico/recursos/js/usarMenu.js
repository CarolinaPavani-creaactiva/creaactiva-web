document.addEventListener('DOMContentLoaded', function () {
    var userBtn = document.getElementById('userBtn');
    var userDropdown = document.getElementById('userDropdown');
    if (!userBtn || !userDropdown) return;

    function open() {
        userBtn.setAttribute('aria-expanded', 'true');
        userDropdown.removeAttribute('hidden');
        userDropdown.classList.add('abierto');
    }
    function close() {
        userBtn.setAttribute('aria-expanded', 'false');
        userDropdown.classList.remove('abierto');
        userDropdown.setAttribute('hidden', '');
    }
    userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        if (userDropdown.classList.contains('abierto')) close(); else open();
    });
    document.addEventListener('click', function (e) {
        if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) close();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') close();
    });
});
