<?php
require_once "database.php";
$username = $userid = $password = $confirm_password = "";
$username_err = $userid_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $userid_err = "Please enter a username.";
    } elseif(strlen(trim($_POST["username"])) < 6 || strlen(trim($_POST["username"])) > 20){
        $userid_err = "Username or ID must have atleast 6 characters and below 20 characters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM account_user WHERE user_id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_userid);
            
            // Set parameters
            $param_userid = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $userid_err = "This username is already taken.";
                } else{
                    $userid = test_input($_POST["username"]);
                    if(!preg_match("/^[a-zA-Z0-9]*$/",$userid)){
                        $userid_err = "Username or ID only number, normal letters and capital letters";
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
        $username_err = "Please enter a Name.";     
    } elseif(strlen(trim($_POST["name"])) < 6 || strlen(trim($_POST["name"])) > 20){
        $username_err = "Name must have atleast 6 characters and below 20 characters.";
    } else{
        $username = test_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z 0-9]*$/",$username)){
            $username_err = "Name only space, number, normal letters and capital letters";
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = test_input($_POST["password"]);
        if(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
            $password_err = "Password only number, normal letters and capital letters";
        }
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = test_input($_POST["confirm_password"]);
        if(!preg_match("/^[a-zA-Z0-9]*$/",$confirm_password)){
            $confirm_password_err = "Confirm password only number, normal letters and capital letters";
        }
        elseif(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($userid_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO account_user (id, user_id, user_password, user_name, user_status) VALUES (0, ?, ?, ?, 'member')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_userid, $param_password, $param_username);
            
            // Set parameters
            $param_userid = $userid;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Registrasi Berhasil!</strong> Silahkan login disini : <a href="http://localhost/proyek/account/login.php">Login</a>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"> -->
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style type="text/css">
        body {
            margin: 0 px;
            background-color: black;
        }

        #active-page {
            font-weight: bold;
        }

        .wrapper {
            width: 350px;
            padding-top: 3%;
            color: white;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item disabled">
                    <div class="navbar-brand">Wibu Comic</div>
                </li>
                <li class="nav-item active">
                    <a class="navbar-brand" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="genre/viewallgenre.php">Genre</a>
                </li>
                <li class="nav-item">
<<<<<<< Updated upstream
                    <a class="navbar-brand" href="../topmanga.php" >Top Manga of All Time</a>
                </li>
            </ul>
        </div>
=======
                    <a class="navbar-brand" href="account/isiberita.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="topmanga.php">Top Manga</a>
                </li>
                <ul class="navbar-nav ml-auto" id="active-page">
                    <li class="nav-item dropdown" id="secret">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            News
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item btn btn-dark" style="color:grey" href="addberita.php">Add</a>
                            <a class="dropdown-item btn btn-dark" style="color:grey" href="editberita.php">Edit</a>
                            <a class="dropdown-item btn btn-dark" style="color:grey" href="deleteberita.php">Delete</a>
                        </div>
                    </li>
                </ul>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto" id="active-page">
            <li class="nav-item dropdown" id="secret">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/login.php">Login</a>
                    <a class="dropdown-item btn btn-dark" style="color:grey" href="account/register.php">Register</a>
                </div>
            </li>
        </ul>
>>>>>>> Stashed changes
        </div>
    </nav>


    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($userid_err)) ? 'has-error' : ''; ?>">
                <label>Username or ID</label>
                <input type="text" name="username" class="form-control" value="<?php echo $userid; ?>">
                <span class="help-block"><?php echo $userid_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>