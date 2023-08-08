<?php
include('../../_config.php');
session_start();
if(isset($_COOKIE['userID'])){
    $user_id = $_COOKIE['userID'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animeID = $_POST["anime_id"];
    $getAnime = file_get_contents("$api/getAnime/$animeID");
    $getAnime = json_decode($getAnime, true);
    $name = $getAnime['name'];
    $type = $getAnime['type'];
    $image = $getAnime['imageUrl'];
    $release = $getAnime['released'];
  
    // Insert the anime into the completed table
    $query = "INSERT INTO `plan-to-watch` (user_id, name, anime_id, image, type, released) VALUES ('$user_id', '$name', '$animeID', '$image', '$type', '$release')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Insertion into completed successful
        // Delete the anime from the plan-to-watch table
        $deleteQuery = "DELETE FROM `completed` WHERE user_id = '$user_id' AND anime_id = '$animeID'";
        $deleteResult = mysqli_query($conn, $deleteQuery);
      
        if ($deleteResult) {
            // Deletion from plan-to-watch successful
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            // Deletion from plan-to-watch failed
            echo "Error deleting anime from plan-to-watch: " . mysqli_error($conn);
        }
    } else {
        // Insertion into completed failed
        echo "Error adding anime to completed: " . mysqli_error($conn);
    }
}

?>