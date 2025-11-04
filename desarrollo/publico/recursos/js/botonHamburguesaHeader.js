 const btnMenu = document.getElementById('btn-menu');
        const nav = document.getElementById('navegacion');

        btnMenu.addEventListener('click', () => {
            nav.classList.toggle('activo');
        });