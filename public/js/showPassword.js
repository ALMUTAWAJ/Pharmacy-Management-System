function togglePasswordVisibility(element, passwordFieldId) {
    const passwordField = document.getElementById(passwordFieldId);

    if (passwordField.getAttribute("type") === "password") {
        element.innerHTML = "visibility";
        passwordField.setAttribute("type", "text");
    } else {
        element.innerHTML = "visibility_off";
        passwordField.setAttribute("type", "password");
    }
}

    
