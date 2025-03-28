const modal = document.getElementById("loginModal");
const modalContent = document.getElementById("modalContent");
const openModalButtons = document.querySelectorAll("[id='openModal']");
const closeModal = document.getElementById("closeModal");
const loginButton = document.getElementById("loginButton");

function openModalWithDelay() {
    setTimeout(() => {
        modal.classList.remove("hidden");
        setTimeout(() => {
            modalContent.classList.remove("translate-y-[-50px]", "opacity-0");
            modalContent.classList.add("translate-y-0", "opacity-100");
        }, 150);
    }, 600); 
}

openModalButtons.forEach(button => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        openModalWithDelay(); 
    });
});

closeModal.addEventListener("click", () => {
    modalContent.classList.add("translate-y-[-50px]", "opacity-0");
    setTimeout(() => {
        modal.classList.add("hidden");
    }, 300);
});

modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modalContent.classList.add("translate-y-[-50px]", "opacity-0");
        setTimeout(() => {
            modal.classList.add("hidden");
        }, 300);
    }
});

loginButton?.addEventListener("click", () => {
    window.location.href = "mainpage.html";
});

document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem("openLoginModal") === "true") {
        openModalWithDelay();
        localStorage.removeItem("openLoginModal"); 
    }
});

document.addEventListener("DOMContentLoaded", function () {
if (localStorage.getItem("openLoginModal") === "true") {
    openModalWithDelay();
}
});

// Pastikan modal tetap terbuka jika ada error
document.getElementById("loginForm").addEventListener("submit", function () {
localStorage.setItem("openLoginModal", "true");
});