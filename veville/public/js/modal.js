const backdrop = document.getElementById("backdrop");
const modal = document.getElementById("modal");
const showModal = document.getElementById("showModal");

showModal.addEventListener("click", function () {
    backdrop.classList.remove("d-none");
    modal.classList.remove("modal");
    document.body.classList.add("unscrollable");
});

function closeModal() {
    backdrop.classList.add("d-none");
    modal.classList.add("modal");
    document.body.classList.remove("unscrollable");
}

window.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeModal();
    }
});
