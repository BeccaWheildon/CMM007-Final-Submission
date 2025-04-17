<?php
    require "../DBConnect.php";
    require "../Session Info.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashbaord - Dunblane Library</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Website Styling.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="New User Validation.js"></script>
    <script src="Submit New Book.js"></script>
</head>

<body>
<main class="container">

    <!-- NAVIGATION BAR -->
    <?php include '../Navbar.php'; ?>
    
    <div class="banner">
        <h2 class="text-center my-3">Admin Dashboard</h2><br>
    </div><br>
    
    <div style="display: flex; align-items: center; padding-bottom: 10px;">
        <h3 style="margin-right: 10px; text-align: center;"> Hello, <?php echo htmlspecialchars($userName); ?>. Welcome to your dashboard!</h3>
        <img src="../Assets/river_allen_image.JPG" alt="Image of the Allan River in Dunblane" class="img-fluid w-90 h-20 object-fit-cover">
    </div>
    
    
    
    <!-- BOOK CATALOGUE SECTION -->
        <div class="row">
            <div id="book_catalogue" class="col-lg-8" style="border: 1px solid gray; padding: auto;">
                
                <!-- START OF ADD BOOK FORM -->
                <!-- code used to create modal references YouTube video - https://www.youtube.com/watch?v=kkJ_AggbmrE&t=737s -->
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBook" style="float: right;">+ Add New Book</a>
                <div class="modal fade" id="addBook">
                    <div class="modal-dialogue" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add New Book</h3>
                            </div>
                            <div class="modal-body">
                                <form id="newBook" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Book Title</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="title" id="book_title" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Book Author (Full Name)</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="author" id="book_author" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">ISBN</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="isbn" id="book_isbn" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label" for="book_genre">Genre</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="genre" class="form-select" id="book_genre" required>
                                                    <option value="">Select Genre</option>
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="quantity" id="book_quantity" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="book_description" class="control-label">Description</label>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea class="form-control" id="book_description" name="description" required rows="15"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Upload Book Cover</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" id="book_cover" name="image" accept=".jpg, .jpeg, .png " required> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="edit btn btn-primary btn-sm">Submit New Book</button>
                                        <button type="button" class="btn btn-close" data-dismiss="modal" onclick="location.reload(true);">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF ADD BOOK FORM -->


                <button class="edit btn btn-primary btn-sm float-right" onclick="location.href='../Book Management Admin/Manage Book Catalogue.php';">Edit Book Catalogue</button>
                <h2>Recently Added Books</h2>
                <div class="row">

                    <?php
                    include("../DBConnect.php"); 
                    try {
                        $sql = "SELECT books.*, bookcovers.imagePath 
                        FROM books
                        LEFT JOIN bookcovers ON books.bookID = bookcovers.bookID
                        GROUP BY books.bookID 
                        ORDER BY uploadDate DESC LIMIT 6";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                        if (count($results) > 0) {
                            foreach ($results as $row) {
                                // Code to get image path taken from CoPilot
                                $imagePath = !empty($row['imagePath']) && file_exists("../Book_Covers/" . $row['imagePath'])
                                ? "../Book_Covers/" . htmlspecialchars($row['imagePath'])
                                : null;
                                // End of code from CoPilot
                                echo "
                                <div class='col-sm-6 col-lg-4'>
                                    <div class='card h-100'>
                                        <img src='" . $imagePath . "' class='img-thumbnail' alt='" . $row['title'] . "'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>
                                            <p>" . htmlspecialchars($row['author']) . "</p>
                                        </div>
                                    </div>
                                </div>";
                            }
                        } else {
                            echo "<p>No records found</p>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    
                    $db = null;
                    ?>

                </div>
            </div>

            <!-- User Management Section -->
            <div id="user_management" class="col-lg-4" style="border: 1px solid gray">
                
                <!-- START OF ADD USER FORM -->
                <!-- code used to create modal references YouTube video - https://www.youtube.com/watch?v=kkJ_AggbmrE&t=737s -->
                <a href="" class="btn btn-sm" data-toggle="modal" data-target="#addUser" style="float: right;">+ Add New User</a>
                <div class="modal fade" id="addUser">
                    <div class="modal-dialogue" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add New User</h3>
                            </div>
                            <div class="modal-body">
                            <form id="newUser" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" action="Upload User.php">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">User Full Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="userName" id="user_name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">User Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="email" id="user_email" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Password</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="password" id="user_password" placeholder="Set temporary password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label">Role</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="userType" id="user_type" required>
                                                    <option value="">Select Role</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="User">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="error_messages">

                                    </div>
                                    
                                    <div class="modal-footer">
                                    <button type="submit" name="submit" class="edit btn btn-primary btn-sm" onclick="return validateForm()">Submit New User</button> 
                                        <button type="button" class="btn btn-close" data-dismiss="modal" onclick="location.reload(true);">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    
            
                <button class="edit btn btn-sm float-right" id="button" onclick="location.href='../User Management Admin/Manage User.php';" >Edit Users</button>
                <h2>Recently Added Users</h2>
                <div class="list-group">
                    <?php
                        include("../DBConnect.php");
                        try {
                        $sql = "SELECT * FROM userdetails ORDER BY dateAdded DESC LIMIT 6";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (count($results) > 0) {
                            foreach ($results as $row) {
                                echo "
                                    <div class='list-group-item'>
                                        <h5 class='mb-1'>" . htmlspecialchars($row["userName"]) . "</h5>
                                        <p class='mb-1'>Email: " . htmlspecialchars($row["email"]) . "</p>
                                        <small>User Type: " . htmlspecialchars($row["userType"]) . "</small>
                                    </div>";
                            }
                        } else {
                            echo "<p>No records found</p>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    
                    $db = null;
                        ?>
                </div>
            </div>
        </div>
    <!-- Footer -->
    <footer class="bg-secondary text-center fw-bold py-3 text-white">
        <p>
            Address: 122 High St, Dunblane FK15 0ER<br>
            Phone: 01786 823125<br><br>
            &copy; Stirling Council 2025 - 2028. All rights reserved
            
        </p>
</footer>
</main>
<script>
    function validateForm() {
        const userName = document.getElementById('user_name').value.trim();
        const userEmail = document.getElementById('user_email').value.trim();
        const userPassword = document.getElementById('user_password').value.trim();
        const userType = document.getElementById('user_type').value.trim();
        const errorElement = document.getElementById('error_messages');

        let messages = [];

        // Validation logic
        if (userName === '') {
            messages.push('User Full Name is required.');
        }

        if (userEmail === '') {
            messages.push('User Email is required.');
        } else if (!userEmail.includes('@') || !userEmail.includes('.')) {
            messages.push('Invalid email format.');
        }

        if (userPassword === '') {
            messages.push('Password is required.');
        } else if (userPassword.length < 6) {
            messages.push('Password must be at least 6 characters long.');
        } else if (!/[a-z]/.test(userPassword) || !/[A-Z]/.test(userPassword) || !/[0-9]/.test(userPassword)) {
            messages.push('Password must include one uppercase letter, one lowercase letter, and one number.');
        }

        if (userType === '') {
            messages.push('Role is required.');
        }

        if (messages.length > 0) {
            errorElement.innerHTML = messages.join('<br>');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
</body>
</html>
