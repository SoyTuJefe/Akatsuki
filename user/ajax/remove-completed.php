<?php
include('../../_config.php');
session_start();
if(isset($_COOKIE['userID'])){
    $user_id = $_COOKIE['userID'];
  };

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animeID = $_POST["anime_id"];
   
 
$query = mysqli_query($conn, "SELECT * FROM `completed` WHERE user_id = '$user_id' AND anime_id = '$animeID'"); 
$query = mysqli_fetch_array($query); 


if(isset($query['id'])){
    $id = $query['id'];



    mysqli_query($conn,"DELETE FROM `completed` WHERE id = $id");
   
}
 header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>