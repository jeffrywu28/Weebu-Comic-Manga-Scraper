<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "adminwibu") {
    header("location: index.php");
    exit;
}
require_once "database.php";

if (isset($id_err) && isset($judul_err) && isset($isi_err) && isset($tanggal_err) && isset($gambar_err)) {
    $sql = "UPDATE berita_website SET judul_berita = ?, isi_berita = ?, tanggal_kirim = ?, gambar_berita = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssi", $param_judul, $param_isi, $param_tanggal, $param_gambar, $param_id);

        // Set parameters
        $param_judul = $_POST["judul"];
        $param_isi = $_POST["isi"];
        $param_tanggal = $_POST["tanggal"];
        $param_gambar = $_POST["gambar"];
        $param_id = $_POST["id"];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
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