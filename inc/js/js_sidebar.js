window.onload= function () {
    const sidebar = document.getElementById("sidebar");
    const tgButton = document.getElementById("sidebarCollapse");

    tgButton.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    })
};    