document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById('formLogin');
    if (!form) return;

    form.addEventListener('submit', function () {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Entrando...';
        }
    });
});
