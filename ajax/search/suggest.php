<?php
include('../../_config.php');
session_start();
// Get the keyword from the AJAX request
$keyword = $_GET['keyword'];

// Perform your processing
// Assuming $api is the URL of your API endpoint
$json = file_get_contents("$api/search?keyw=$keyword");
$data = json_decode($json, true);

// Initialize an empty HTML variable
$html = '';

// Set the maximum number of iterations to 4
$maxIterations = 5;
$iterationCount = 0;

// Iterate over the data array and generate HTML dynamically
foreach ($data as $item) {
    // Break the loop if the maximum iteration count is reached
    if ($iterationCount >= $maxIterations) {
        break;
    }

    $html .= '
    <a href="/anime/'.$item['anime_id'].'?ref=search" class="nav-item">
        <div class="film-poster">
            <img data-src="'.$item['img_url'].'" class="film-poster-img lazyload" alt="'.$item['name'].'">
        </div>
        <div class="srp-detail">
            <h3 class="film-name dynamic-name" data-jname="'.$item['name'].'">'.$item['name'].'</h3>
            <div class="alias-name">'.$item['name'].'</div>
            <div class="film-infor">
                <span>'.$item['status'].'</span>
                <i class="dot"></i>TV<i class="dot"></i>
            </div>
        </div>
        <div class="clearfix"></div>
    </a>';

    $iterationCount++;
}

// Check if any results were found
if ($iterationCount == 0) {
    // No results found
    $html = '<div class="no-results">No results found.</div>';
} else {
    // Results found
    $html .= '<a href="/search?keyword='.$keyword.'" class="nav-item nav-bottom">
        View all results<i class="fa fa-angle-right ml-2"></i>
    </a>';
}

// Add the dynamic HTML to the result array
$result = array(
    'status' => true,
    'html' => $html
);

// Output the processed result as JSON
header('Content-Type: application/json');
echo json_encode($result);

?>
