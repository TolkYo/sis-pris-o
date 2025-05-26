window.onload= function () {
    const sidebar = document.getElementById("sidebarroger");
    const tgButton = document.getElementById("sidebarbutton");

    tgButton.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    })
};    