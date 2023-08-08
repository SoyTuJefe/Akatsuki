<?php
include('../../_config.php');
session_start();
if(isset($_COOKIE['userID'])){
    $user_id = $_COOKIE['userID'];
  };

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animeID = $_POST["anime_id"];
    $getAnime = file_get_contents("$api/getAnime/$animeID");
    $getAnime = json_decode($getAnime, true);
    $name = $getAnime['name'];
    $type = $getAnime['type'];
    $image = $getAnime['imageUrl'];
    $release = $getAnime['released'];
  

    // Insert the anime into the plan-to-watch table
    $query = "INSERT INTO `plan-to-watch` (user_id,name,anime_id,image,type,released) VALUES('$user_id','$name','$animeID','$image', '$type', '$release')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        // Insertion failed
        echo "Error adding anime to Plan to Watch: " . mysqli_error($conn);
    }
}
?>