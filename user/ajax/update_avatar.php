<?php
// Assuming you have the necessary database connection and user ID already available
include('../../_config.php');
session_start();
if(isset($_COOKIE['userID'])){
    $user_id = $_COOKIE['userID'];
};

// Get the dataId parameter sent from the AJAX request
$dataId = $_POST['dataId'];

// Perform the database update operation using the $dataId value
// Replace this code with your actual database update logic


$sql = "UPDATE user_form SET image = '$dataId' WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Check if the database update was successful
if ($result) {
    // Return a success message
    echo "Avatar updated successfully";
} else {
    // Return an error message
    echo "Failed to update avatar";
}
?>
