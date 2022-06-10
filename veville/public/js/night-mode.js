let button = document.getElementById("nightmode");
let darkMode = false;

button.addEventListener("click", function () {
    darkMode = !darkMode;
    if (darkMode === true) {
        document.body.classList.add("dark");
    } else document.body.classList.remove("dark");
});
