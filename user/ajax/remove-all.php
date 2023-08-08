<?php
include('../../_config.php');
session_start();
if(isset($_COOKIE['userID'])){
    $user_id = $_COOKIE['userID'];
  };

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animeID = $_POST["anime_id"];
   

$query = mysqli_query($conn, "SELECT * FROM `watch_later` WHERE user_id = '$user_id' AND anime_id = '$animeID'"); 
$query1 = mysqli_query($conn, "SELECT * FROM `plan-to-watch` WHERE user_id = '$user_id' AND anime_id = '$animeID'"); 
$query2 = mysqli_query($conn, "SELECT * FROM `completed` WHERE user_id = '$user_id' AND anime_id = '$animeID'"); 
$query = mysqli_fetch_array($query); 
$query1 = mysqli_fetch_array($query1);
$query2 = mysqli_fetch_array($query2);

if(isset($query['id'])){
    $id = $query['id'];
    $id1 = $query1['id'];
    $id2 = $query2['id'];

    mysqli_query($conn,"DELETE FROM `watch_later` WHERE id = $id");
    mysqli_query($conn,"DELETE FROM `plan-to-watch` WHERE id = $id1");
    mysqli_query($conn,"DELETE FROM `completed` WHERE id = $id2");
   
}
 header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>