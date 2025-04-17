<?php
    session_start();
    require_once "../DBConnect.php";
    
    //CHECK IF USER IS LOGGED IN
    if (isset($_SESSION['userID'])) {
    
    } else {
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Book Search.js"></script>
</head>
<main class="container ">

<!-- NAVIGATION BAR -->
<?php include '../Navbar.php'; ?>

    <div style="text-align: center; padding-bottom: 10px;">
        <img src="../Assets/dunblane_library.PNG" alt="Website banner for Becca's Books" class="img-fluid w-90 h-50 object-fit-cover" style="background-color: #f9e7e2">
    </div>



    <div class="banner">
        <!-- DYNAMIC SEARCH BAR -->
        <h2 class="text-center mb-4">Search Books</h2>
        <div>
        <form class="d-flex mx-auto w-50" id="searchForm" role="search" method="get">
            <input id="keyword" class="form-control" type="search" name="keyword" placeholder="Search for books or authors...">
            <button class="btn btn-secondary" type="submit" name="searchButton" id="searchButton">Search</button>
        </form>

        <!-- FILTER BOOKS BY GENRE -->
        <div class="text-center">
            <select id="genreFilter" class="form-select w-auto mx-auto">
                <option value="">Filter by Genre</option>
                <option value="action">Action & Adventure</option>
                <option value="mystery">Mystery</option>
                <option value="horror">Horror</option>
                <option value="thriller">Thriller</option>
                <option value="sci-fi">Science Fiction</option>
                <option value="romance">Romance</option>
                <option value="self-help">Self-Help</option>
                <option value="autobiography">Memoir & Autobiography</option>
                <option value="fantasy">Fantasy</option>
                <option value="crime">Crime</option>
            </select>
        </div><br>
    </div>
        </div>
        <div class="row g-4" id="book_summary">
        <!-- BOOKS WILL BE DISPLAYED HERE -->
        </div>

<!-- FOOTER -->
<footer class="bg-secondary text-center fw-bold py-3 text-white">
    <p>
        Address: 122 High St, Dunblane FK15 0ER<br>
        Phone: 01786 823125<br><br>
        &copy; Stirling Council 2025 - 2028. All rights reserved
        
    </p>
</footer>
        <script src="Book Search.js"></script>
        <script src="Genre Filter.js"></script>
    </main>
</html>
            
            
