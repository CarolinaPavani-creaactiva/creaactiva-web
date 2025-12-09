document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("appModal");
    const btn = document.getElementById("openModal");
    const closeBtn = document.querySelector(".close");

    btn.onclick = function () {
        modal.style.display = "block";
    };

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});
