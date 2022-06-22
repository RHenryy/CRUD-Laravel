const backdrop = document.getElementById("backdrop");
const modal = document.getElementById("modal");
const showModal = document.getElementById("showModal");

showModal.addEventListener("click", function () {
    backdrop.classList.remove("d-none");
    modal.classList.remove("modal");
});
