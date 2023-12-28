document.addEventListener("DOMContentLoaded", function() {
    var checkbox = document.getElementById("policy");
    var submitButton = document.getElementById("submitButton");

    submitButton.disabled = true; // Disabling the button initially
    submitButton.classList.add("disabled-button"); // Adding the disabled style initially

    checkbox.addEventListener("click", function() {
        submitButton.disabled = !checkbox.checked;
        if (submitButton.disabled) {
            submitButton.classList.add("disabled-button");
        } else {
            submitButton.classList.remove("disabled-button");
        }
    });
});