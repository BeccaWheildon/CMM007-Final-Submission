

$(function() {
    $(document).on("change", "#genreFilter", function() {
        var selectedGenre = $(this).val();
        filterByGenre(selectedGenre);
    });

    filterByGenre("");
});

function filterByGenre(selectedGenre) {
    var url = "Genre Filter.php";
    var data = { "genre_name": selectedGenre };

    $.getJSON(url, data, function(result) {
        $('#book_summary').empty();
        if (result.length > 0) {
            result.forEach(book => {
                var imagePath = book.imagePath && book.imagePath.trim() !== ""
                    ? `../Book_Covers/${book.imagePath}`
                    : '../Book_Covers/placeholder.jpg';
                var htmlCode = `
                    <div class='col-md-6 col-lg-3'>
                        <div class='card'>
                            <img src='${imagePath}' class='img-thumbnail' alt='${book.title ? book.title : "No title available"}'>
                            <div class='card-body'>
                                <h5 class='card-title'>${book.title}</h5>
                                <p>Author: ${book.author}</p>
                                <a href="book.php?id=${book.bookID}" class="btn btn-primary moreInfo">More Info</a>
                            </div>
                        </div>
                    </div>
                `;
                $("#book_summary").append(htmlCode);
            });
        } else {
            $('#book_summary').append("<div class='d-flex justify-content-center'><h5 class='text-center'>No books found. Please try another keyword.</h5></div>");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        $('#book_summary').empty().append("<p>Unable to fetch results. Please try again later.</p>");
    });
}
