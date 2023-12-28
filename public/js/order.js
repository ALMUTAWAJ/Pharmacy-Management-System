

function showDeleteConfirmation(event) {
    event.preventDefault(); // Prevent form submission

    Swal.fire({
        title: 'Are you sure?',
        text: 'The order will be cancelled!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#bd2020',
        cancelButtonColor: '#362640',
        confirmButtonText: 'Yes, cancel it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form
            event.target.submit();
        }
    });
}


function increaseQuantity(button) {
    const inputField = button.parentNode.querySelector('input[type="number"]');
    inputField.stepUp();
}

function decreaseQuantity(button) {
    const inputField = button.parentNode.querySelector('input[type="number"]');
    inputField.stepDown();
}

function validateQuantity(input) {
    let value = parseFloat(input.value);

    if (isNaN(value) || value < 0) {
        input.value = 0;
    } else if (value > 30) {
        input.value = 30;
    } else if (Number.isInteger(value)) {
        input.value = value;
    } else {
        input.value = Math.round(value);
    }
}

function selectFilter(filterType) {
    document.getElementById('filter_type').value = filterType;
    document.getElementById('filter_type').closest('form').submit();
}



