<?php
require_once "../DBConnect.php";

// Validate book ID
$book_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$book_id || $book_id <= 0) {
    die("Invalid book ID.");
}

// Fetch book details
$sql = "SELECT * FROM books WHERE bookID = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$book_id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Book not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Dunblane Library</title>
    <link rel="stylesheet" href="../Bootstrap.css">
    <link rel="stylesheet" href="../Website Styling.css">
</head>

<body>

<?php include '../Navbar.php'; ?>

<main class="container"><br>
            <div class="col-md-12" style="background-color: white;">
            <h2>Edit Book - <?php echo htmlspecialchars($book['title']); ?></h2>
                <form method="POST" action="Update Book.php">
                    <input type="hidden" name="bookID" value="<?php echo $book['bookID']; ?>">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" name="author" id="author" class="form-control" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN:</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" value="<?php echo htmlspecialchars($book['isbn']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="book_genre">Genre:</label>
                        <select name="genre" class="form-select" id="book_genre" required>
                            <option value="">Select Genre</option>
                            <option value="action" <?php echo ($book['genre'] === 'action') ? 'selected' : ''; ?>>Action & Adventure</option>
                            <option value="mystery" <?php echo ($book['genre'] === 'mystery') ? 'selected' : ''; ?>>Mystery</option>
                            <option value="horror" <?php echo ($book['genre'] === 'horror') ? 'selected' : ''; ?>>Horror</option>
                            <option value="thriller" <?php echo ($book['genre'] === 'thriller') ? 'selected' : ''; ?>>Thriller</option>
                            <option value="sci-fi" <?php echo ($book['genre'] === 'sci-fi') ? 'selected' : ''; ?>>Science Fiction</option>
                            <option value="romance" <?php echo ($book['genre'] === 'romance') ? 'selected' : ''; ?>>Romance</option>
                            <option value="self-help" <?php echo ($book['genre'] === 'self-help') ? 'selected' : ''; ?>>Self-Help</option>
                            <option value="autobiography" <?php echo ($book['genre'] === 'autobiography') ? 'selected' : ''; ?>>Memoir & Autobiography</option>
                            <option value="fantasy" <?php echo ($book['genre'] === 'fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="crime" <?php echo ($book['genre'] === 'crime') ? 'selected' : ''; ?>>Crime</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo htmlspecialchars($book['quantity']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" required rows="15"><?php echo htmlspecialchars($book['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <a href="Manage Book Catalogue.php" class="btn btn-secondary">Cancel</a>
                </form><br>
            </div>
        </div><br>
    </main>
    <!-- Footer -->
<footer class="bg-secondary text-center fw-bold py-3 text-white">
    <p>
        Address: 122 High St, Dunblane FK15 0ER<br>
        Phone: 01786 823125<br><br>
        &copy; Stirling Council 2025 - 2028. All rights reserved
        
    </p>
</footer>
    </main>
</html>