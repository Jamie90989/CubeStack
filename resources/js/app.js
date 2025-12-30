import './bootstrap';

window.passwordToggle = function (passwordSelector, toggleSelector) {
    const passwordField = document.querySelector(passwordSelector);
    const toggleButton = document.querySelector(toggleSelector);

    if (!passwordField || !toggleButton) return;

    toggleButton.addEventListener("click", () => {
        const isPassword = passwordField.type === "password";
        passwordField.type = isPassword ? "text" : "password";
    });
};
