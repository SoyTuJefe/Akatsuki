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
    $query = "INSERT INTO `completed` (user_id, name, anime_id, image, type, released) VALUES ('$user_id', '$name', '$animeID', '$image', '$type', '$release')";
    $result = mysqli_query($conn, $query);

    if ($result) {
    // Insertion into completed successful
            // Delete the anime from the plan-to-watch and watch_later tables
            $deleteQuery = "DELETE FROM `plan-to-watch` WHERE user_id = '$user_id' AND anime_id = '$animeID'";
            $deleteQuery1 = "DELETE FROM `watch_later` WHERE user_id = '$user_id' AND anime_id = '$animeID'";
            $deleteResult = mysqli_query($conn, $deleteQuery);
            $deleteResult1 = mysqli_query($conn, $deleteQuery1);

            if ($deleteResult && $deleteResult1) {
                // Deletion from plan-to-watch and watch_later successful
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
            } else {
                // Deletion from plan-to-watch or watch_later failed
                echo "Error deleting anime from plan-to-watch or watch_later: " . mysqli_error($conn);
            }
    }
}

?>