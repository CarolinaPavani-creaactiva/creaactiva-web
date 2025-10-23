document.addEventListener('DOMContentLoaded', () => {
    const btnSubir = document.getElementById('btn-subir');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            // usar setTimeout mínimo para que la transición se note
            if (!btnSubir.classList.contains('mostrar')) {
                requestAnimationFrame(() => btnSubir.classList.add('mostrar'));
            }
        } else {
            btnSubir.classList.remove('mostrar');
        }
    });

    btnSubir.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
