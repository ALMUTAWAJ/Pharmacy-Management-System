document.addEventListener("DOMContentLoaded", function() {
    // Initialize the active card based on a cookie or local storage
    let activeCard = localStorage.getItem('activeCard');
    if (!activeCard) {
        activeCard = 'card1'; // Set a default active card
    }

    function hideAllForms() {
        document.getElementById("card1").style.display = "none";
        document.getElementById("card2").style.display = "none";
        document.getElementById("card3").style.display = "none";
    }

    function showForm(formId, buttonId, cardTitle) {
        hideAllForms();
        document.getElementById(formId).style.display = "block";

        // Update the title based on the active card
        document.getElementById("title").innerHTML = cardTitle;

        // Store the active card in a cookie or local storage
        localStorage.setItem('activeCard', formId);
    }

    // Show the initially active card
    showForm(activeCard, `${activeCard}-button`, getCardTitle(activeCard));

    document.getElementById("card1-button").addEventListener("click", function() {
        showForm("card1", "card1-button", getCardTitle("card1"));
        hideMessages();
    });

    document.getElementById("card2-button").addEventListener("click", function() {
        showForm("card2", "card2-button", getCardTitle("card2"));
        hideMessages();
    });

    document.getElementById("card3-button").addEventListener("click", function() {
        showForm("card3", "card3-button", getCardTitle("card3"));
        hideMessages();
    });

    function hideMessages() { // To hide messages
        let success = document.getElementById("success");
        hideMessage(success);


        let fail = document.getElementById("fail");
        hideMessage(fail);

        let errors = document.getElementById("errors");
        hideMessage(errors);
    }

    function hideMessage(messageElement) {
        messageElement.style.display = "none";
    }



    // Helper function to get the title for a card
    function getCardTitle(cardId) {
        switch (cardId) {
            case "card1":
                return "Customer Information";
            case "card2":
                return "Change Password";
            case "card3":
                return "Customer Address";
            default:
                return "";
        }
    }
});


$('#address_select').on('change', function() {
    // Submit the form when the select value changes
    $('#address_selection').submit();
});
