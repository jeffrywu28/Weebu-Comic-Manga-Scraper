<?php
// Include config file
require_once "database.php";
 
// Define variables and initialize with empty values
$username = $userid = $password = $confirm_password = "";
$username_err = $userid_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
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
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style type="text/css">
        html, body { 
            width:100%;
            height: 100%;
        }
        body{ font: 14px sans-serif; }
        .bg{
            background-image: url("uploads/background2.jpg");
            background-size: cover;
            box-shadow: inset 120px 100px 250px #000000, inset -120px -100px 250px #000000;
        }
        .wrapper{ margin-left: 30%; margin-top: 10%; width: 40%; }
    </style>
</head>
<body class="bg">
<?php require_once('../navbar/navbar'); ?>

    <div class="container" style="text-align:center; color:white;">
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
                </div>
                <p>Already have an account? <a href="login.php" style="color:white;">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>