<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "adminwibu") {
    header("location: index.php");
    exit;
}
require_once "database.php";

if (empty($id_err)) {
    $sql = "DELETE FROM berita_website WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $_POST["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                header("location: index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        echo '
            <script>
                alert("Hello")
            </script>';
    }
} else {
    echo '
        <script>
            alert("Hello")
        </script>';
}
?>