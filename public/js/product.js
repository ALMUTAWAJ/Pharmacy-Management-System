const fileInput = document.getElementById('product-image');
const fileNameDisplay = document.getElementById('file-name');

fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
        fileNameDisplay.innerHTML = `Selected file: ${fileInput.files[0].name}`;
    } else {
        fileNameDisplay.innerHTML = '<span class="font-semibold">Click to upload</span> or drag and drop';
    }
});



function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var imagePreview = document.getElementById('image-preview');
        imagePreview.innerHTML = '<img src="' + reader.result + '" alt="Product Image" class="object-cover">';
    }
    reader.readAsDataURL(event.target.files[0]);
}


function selectFilter(filterType) {
    document.getElementById('filter_type').value = filterType;
    document.getElementById('filter_type').closest('form').submit();
}

function showDeleteConfirmation(event) {
    event.preventDefault(); // Prevent form submission

    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#bd2020',
        cancelButtonColor: '#362640',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form
            event.target.submit();
        }
    });
}




function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var imagePreview = document.getElementById('image-preview');
        imagePreview.innerHTML = '<img src="' + reader.result + '" alt="Product Image" class="object-contain w-full h-full">';
    }
    reader.readAsDataURL(event.target.files[0]);
}
