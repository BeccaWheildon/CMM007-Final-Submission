<?php
    session_start();
    require "../DBConnect.php";
    require "../Session Info.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard - Dunblane Library</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Website Styling.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<main class="container">
    <?php include '../Navbar.php'; ?>

    <div class="banner">
        <h2 class="text-center my-3">User Dashboard</h2><br>
    </div><br>

    <div style="display: flex; align-items: center; padding-bottom: 10px;">
        <h3 style="margin-right: 10px; text-align: center;"> Hello, <?php echo htmlspecialchars($userName); ?>. Welcome to your dashboard!</h3>
        <img src="../Assets/user_dashboard_image.jpg" alt="Image of the Dunblane Cathedral" class="img-fluid w-75 h-20 object-fit-cover">
    </div>


    <div class="container mt-4">
    <section>
        <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mb-4 w-100">
                        <div class="card-body text-center">
                            <img src="../Assets/book_symbol.png" alt="avatar" class="img-fluid" style="width: 150px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <p class="mb-0">User Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0 text-capitalize"><?php echo $userName; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $email; ?></p>
                                </div>
                            </div>                          
                            <hr>
                            <div class="row justify-content-center">
                                <a href="" class="btn btn-sm" data-toggle="modal" data-target="#editDetails">Edit Details</a>

                                <!-- START OF EDIT DETAILS FORM -->
                                        <div class="modal fade" id="editDetails">
                                            <div class="modal-dialogue" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Edit Details</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="newUser" method="post" enctype="multipart/form-data" action="Update User Details.php" onsubmit="return validateForm()">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label class="control-label">Full Name</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="userName" id="user_name" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label class="control-label">Email</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="email" id="user_email" required>
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
                                        
                                        <a href="" class="btn btn-sm" data-toggle="modal" data-target="#changePassword">Change Password</a>

                                        <!-- START OF CHANGE PASSWORD FORM -->
                                        <div class="modal fade" id="changePassword">
                                            <div class="modal-dialogue" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Change Password</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="changePassword" method="post" action="change_password.php">
                                                                    <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label class="control-label">Old Password</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="password" class="form-control" name="old_password" id="old_password" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label class="control-label">New Password</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="password" class="form-control" name="new_password" id="new_password" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="submit" name="submit" class="edit btn btn-primary btn-sm">Submit New Password</button> 
                                                                <button type="button" class="btn btn-close" data-dismiss="modal" onclick="location.reload(true);">Close</button>
                                                            </div>
                                                        </form>
                                                    



                            </div>
                        </>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="container mt-4" style="background-color: white;">
    <!-- Reserved Books Section -->
        <div class="section2" id="reserved_books">
        <h2>Reserved Books</h2>
        <div>
        <form class="d-flex mx-auto w-50" id="searchForm" role="search" method="get">
            <input id="keyword" class="form-control" type="search" name="keyword" placeholder="Search for books or authors...">
            <button class="btn btn-secondary" type="submit" name="searchButton" id="searchButton">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table id="book_res" class="table" style="margin-top: 15px;">
                    <thead>
                        <tr>
                            <th>Book Title</th><th>Author</th><th>Date Book was Reserved</th><th>Return Date</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<footer class="bg-secondary text-center fw-bold py-3 text-white">
        <p>
            Address: 122 High St, Dunblane FK15 0ER<br>
            Phone: 01786 823125<br><br>
            &copy; Stirling Council 2025 - 2028. All rights reserved
            
        </p>
</footer>
</div> 
</main>
<script src="Search Book Reservations.js"></script>
</body>
</html>
