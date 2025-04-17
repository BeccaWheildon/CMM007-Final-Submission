<!DOCTYPE html>
<!-- Code created referencing YouTube video - https://www.youtube.com/watch?v=nd9nOQemVAc&t=158s -->
 <!-- Using Tabledit plugin with jQuery Datatable in PHP Ajax -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Database Management - Book Catalogue</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="../Website Styling.css" rel="stylesheet">
    <link href="Manage Book Catalogue.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
 </head>

<main class="container">


<div class="banner">
   <h2 class="text-center my-3" style="font-weight: bold;">Admin Database Management - Book Catalogue</h2>
</div>
   <a href="../Admin Dashboard/Admin Dashboard.php" class="edit btn btn-primary btn-sm">Return to Admin Dashboard</a><br>
   <br />
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Book Catalogue</div>
    <div class="panel-body">
     <div class="table-responsive">
     <table id="book_data" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Genre</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
     </div>
    </div>
   </div>
</main>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
    var dataTable = $('#book_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "fetch.php",
            type: "POST"
        },
        columns: [
            { data: 'bookID' },
            { data: 'title' },
            { data: 'author' },
            { data: 'isbn' },
            { data: 'genre' },
            { data: 'quantity' },
            { data: 'description' },
            {
                data: 'bookID',
                render: function(data, type, row) {
                    return `
                        <a href="Edit Book.php?id=${data}" class="btn btn-primary btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data}">Delete</button>
                    `;
                }
            }
        ]
    });

    // Handle delete button click
    $('#book_data').on('click', '.delete-btn', function() {
        var bookID = $(this).data('id');

        if (confirm("Are you sure you want to delete this book?")) {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { bookID: bookID, action: 'delete' }, // Include 'action': 'delete'
                success: function(response) {
                    if (response.success) {
                        alert("Book deleted successfully.");
                        dataTable.ajax.reload(); // Reload DataTable
                    } else {
                        alert("Failed to delete the book: " + response.error);
                    }
                },
                error: function() {
                    alert("An error occurred while deleting the book.");
                }
            });
        }
    });
});
</script>
</body>
</html>