$(document).ready(function () {
    $('#newBook').submit(function (event) {
        console.log('Submit handler triggered');
        event.preventDefault();

        var title = $('#book_title').val();
        var author = $('#book_author').val();
        var isbn = $('#book_isbn').val();
        var genre = $('#book_genre').val();
        var quantity = $('#book_quantity').val();
        var description = $('#book_description').val();
        var bookCoverElement = $('#book_cover')[0];
        
        // Validation: Check if all fields are filled
        if (!title || !author || !isbn || !genre || !quantity || !description || !bookCoverElement || !bookCoverElement.files.length) {
            console.log('Validation failed: Empty fields detected');
            alert('Please fill in all details.');
            return false;
        }

        // Validation: Check ISBN format
        var isbnRegex = /^\d{10}$|^\d{13}$/;
        if (!isbnRegex.test(isbn)) {
            console.log('Validation failed: ISBN format incorrect');
            alert('Incorrect ISBN. It must be 10 or 13 digits.');
            return false;
        }

        // Validation: Check file type
        var bookCover = bookCoverElement.files[0];
        const allowedFileTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!allowedFileTypes.includes(bookCover.type)) {
            console.log('Validation failed: File type not allowed');
            alert("Only JPG, PNG, or GIF files are allowed.");
            return false;
        }

        // Validation: Check file size
        const maxFileSize = 5 * 1024 * 1024;
        if (bookCover.size > maxFileSize) {
            console.log('Validation failed: File size exceeds limit');
            alert("File size exceeds 5MB.");
            return false;
        }

        console.log('Validation passed: Preparing to submit form');

        var formData = new FormData($('#newBook')[0]);

        $.ajax({
            url: "Upload Book.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                const result = typeof response === 'string' ? JSON.parse(response) : response;
        
                alert(result.message);
        
                window.location.href = result.redirect;
            },
            error: function (xhr, status, error) {
                console.error("AJAX error occurred: " + error);
                console.error("XHR response: ", xhr.responseText);
        
                alert("An error occurred. Please try again.");
            }
        });
        
    });
});
