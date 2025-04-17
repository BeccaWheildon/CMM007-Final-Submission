
function searchBooks() {
    var keyword = $("#keyword").val().trim();

    if (!keyword) {
        populateSection("");
    } else {
        populateSection(keyword);
    }
}

$(function() {
    $("#searchButton").click(function() {
        searchBooks();
    });

    let debounceTimer;
    $("#keyword").on("keyup", function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => searchBooks(), 300);
    });

    searchBooks();
});

function populateSection(keyword) {
    var url = "Search Book Reservations.php";
    var data = { "keyword": keyword };

    $.getJSON(url, data, function(result) {
        console.log("Server response:", result);
        $("#book_res tbody").empty(); 

        if (!result || result.length === 0 || result.message) {
            const message = result.message || "You currently have no borrowed books";
            $("#book_res tbody").append(`<tr><td colspan='5'>${message}</td></tr>`);
            return;
        }

        for (var index in result) {
            var reservations = result[index]; 

            // Code taken from Copilot to convert dates to DD-MM-YYYY format
            var originalResDate = new Date(reservations["reservationDate"]);
            var formattedResDate = originalResDate.getDate().toString().padStart(2, '0') + "-" + 
                                   (originalResDate.getMonth() + 1).toString().padStart(2, '0') + "-" + 
                                   originalResDate.getFullYear();

            var originalReturnDate = new Date(reservations["returnDate"]);
            var formattedReturnDate = originalReturnDate.getDate().toString().padStart(2, '0') + "-" + 
                                      (originalReturnDate.getMonth() + 1).toString().padStart(2, '0') + "-" + 
                                      originalReturnDate.getFullYear();
            // End of code taken from Copilot

            var htmlCode = "<tr>";                        
            htmlCode += "<td>" + reservations["title"] + "</td>";
            htmlCode += "<td>" + reservations["author"] + "</td>";
            htmlCode += "<td>" + formattedResDate + "</td>";
            htmlCode += "<td>" + formattedReturnDate + "</td>";
            htmlCode += "<td><form action='Return Book.php' method='POST' style='display:inline;'><input type='hidden' name='bookID' value='" + reservations.bookID + "'><button type='submit' class='btn btn-primary moreInfo'>Return Book</button></form></td>";
            htmlCode += "</tr>";
            $("#book_res tbody").append(htmlCode);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX request failed:", textStatus, errorThrown);
        $("#book_res tbody").append("<tr><td colspan='5'>Unable to fetch reservations. Please try again later.</td></tr>");
    });
}
