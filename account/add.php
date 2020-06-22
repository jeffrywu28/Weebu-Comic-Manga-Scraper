<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "adminwibu") {
    header("location: index.php");
    exit;
}
require_once "database.php";

if (isset($_POST["judul"]) && isset($_POST["isi"]) && isset($_POST["tanggal"]) && isset($_POST["gambar"])) {
    $sql = "INSERT INTO berita_website (id, judul_berita, isi_berita, tanggal_kirim, gambar_berita) VALUES (0, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $param_judul, $param_isi, $param_tanggal, $param_gambar);

        // Set parameters
        $param_judul = $_POST["judul"];
        $param_isi = $_POST["isi"];
        $param_tanggal = $_POST["tanggal"];
        $param_gambar = $_POST["gambar"];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page
            header("location: index.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}
