const backdrop = document.getElementById("backdrop");
const modal = document.getElementById("modal");
const showModal = document.getElementById("showModal");
const contactAgency = document.getElementById("contactAgency");

showModal.addEventListener("click", function (e) {
    e.preventDefault();
    backdrop.classList.remove("d-none");
    modal.classList.remove("modal");
    document.body.classList.add("unscrollable");
});

function helloModal() {
    backdrop.classList.remove("d-none");
    modal.classList.remove("modal");
    document.body.classList.add("unscrollable");
}

contactAgency.addEventListener("click", function () {
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
