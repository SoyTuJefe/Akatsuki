<?php
// Assuming you have a database connection established

include('../../_config.php');
session_start();

if (isset($_POST['delete_anime'])) {
    $animeTitle = $_POST['anime_title'];

    // Assuming you have a table named 'anime' with a column named 'anime_title'
    $query = "DELETE FROM user_history WHERE anime_title = '$animeTitle'";
    $result = mysqli_query($conn, $query);

    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>

