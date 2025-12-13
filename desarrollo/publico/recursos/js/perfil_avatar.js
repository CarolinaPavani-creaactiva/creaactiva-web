// Muestra vista previa del avatar al seleccionar un nuevo archivo.

document.addEventListener("DOMContentLoaded", () => {
    const inputAvatar = document.getElementById('avatar');
    const previewBox = document.getElementById('previewAvatar');
    if (!inputAvatar || !previewBox) return;

    const previewImg = previewBox.querySelector('img');

    inputAvatar.addEventListener('change', () => {
        const file = inputAvatar.files[0];
        if (!file) {
            previewBox.style.display = "none";
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            previewBox.style.display = "block";
        };
        reader.readAsDataURL(file);
    });
});
