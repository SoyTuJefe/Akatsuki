<?php 
session_start();
require('../_config.php'); 
if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page']; 
}
?>

<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title><?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title"
        content="<?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads" />
    <meta name="description"
        content="<?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime." />
    <meta name="keywords"
        content="<?=$websiteTitle?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa" />
    <meta name="charset" content="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="en" />
    <meta property="og:title"
        content="<?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads">
    <meta property="og:description"
        content="<?=$websiteTitle?> #1 Watch High Quality Anime Online Without Ads. You can watch anime online free in HD without Ads. Best place for free find and one-click anime.">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$websiteTitle?>">
    <meta property="og:url" content="<?=$websiteUrl?>/home">
    <meta itemprop="image" content="<?=$banner?>">
    <meta property="og:image" content="<?=$banner?>">
    <meta property="og:image:secure_url" content="<?=$banner?>">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="shortcut icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" />
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/style.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/min.css?v=<?=$version?>">
    <!--<script async src="https://arc.io/widget.min.js#wHLGVKUU"></script>-->
    <script type="text/javascript">
    setTimeout(function() {
        var wpse326013 = document.createElement('link');
        wpse326013.rel = 'stylesheet';
        wpse326013.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css';
        wpse326013.type = 'text/css';
        var godefer = document.getElementsByTagName('link')[0];
        godefer.parentNode.insertBefore(wpse326013, godefer);
        var wpse326013_2 = document.createElement('link');
        wpse326013_2.rel = 'stylesheet';
        wpse326013_2.href =
            'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css';
        wpse326013_2.type = 'text/css';
        var godefer2 = document.getElementsByTagName('link')[0];
        godefer2.parentNode.insertBefore(wpse326013_2, godefer2);
    }, 500);
    </script>
    <noscript>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    </noscript>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} </style>
</head>

<body data-page="page_home">
        <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
        <?php include('../_php/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper">
                  <div class="profile-header">
        <div class="profile-header-cover"
          style="background-image: url(<?php echo $websiteUrl.'/files/avatar/'.$fetch['image'] ?>);"></div>
        <div class="container">
          <div class="ph-title"><?=$fetch['name']?></div>
          <div class="ph-tabs">
            <div class="bah-tabs">
              <ul class="nav nav-tabs pre-tabs">
                <li class="nav-item"><a class="nav-link" href="<?=$websiteUrl?>/user/profile"><i
                      class="fas fa-user mr-2"></i>Profile</a></li>
                      
                      <li class="nav-item"><a class="nav-link active " href="<?=$websiteUrl?>/latest/continue-watching"><i class="fas fa-history mr-2"></i>Continue Watching</a></li>
                      
                <li class="nav-item"><a class="nav-link " href="<?=$websiteUrl?>/user/watchlist"><i class="fas fa-heart mr-2"></i>Watchlist</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$websiteUrl?>/user/changepass"><i class="fas fa-key mr-2"></i>Change Password</a></li>
              </ul>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
            
            <div class="container">
                <div id="main-content">
                <?php if(isset($_COOKIE['userID'])){ 
                    $user_id = $_COOKIE['userID'];
                    $select = mysqli_query($conn, "SELECT * FROM `user_history` WHERE user_id = $user_id");
                    $rows = mysqli_fetch_all($select, MYSQLI_ASSOC);
                    $rows = array_reverse($rows);
                    if(count($rows) != 0){ ?>

                <section class="block_area block_area_home">
  <div class="block_area-header">
    <div class="float-left bah-heading mr-4">
      <h2 class="cat-heading" style="color: white;"><i class="fas fa-history mr-2"></i>Continue Watching</h2>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="tab-content">
    <div class="block_area-content block_area-list film_list film_list-grid">
      <div class="film_list-wrap">

        <?php
        // Initialize the anime array and counter variable
        $animeArray = [];
        $counter = 0;

        // Loop over the rows
        foreach ($rows as $row) {

          // Check if the anime is already in the array
          $animeIndex = array_search($row['anime_title'], array_column($animeArray, 'anime_title'));

          // If it's not in the array, add it
          if ($animeIndex === false) {
           $animeArray[] = [
    'anime_title' => $row['anime_title'],
    'anime_ep' => $row['anime_ep'],
    'anime_image' => $row['anime_image'],
    'anime_id' => $row['anime_id'],
    'anime_release' => $row['anime_release'],
    'anime_type' => $row['anime_type'],
    'dubOrSub' => $row['dubOrSub'], // Add this line
];

          } else {
            // Otherwise, update the episode number and URL if the new episode is higher
            if ($row['anime_ep'] > $animeArray[$animeIndex]['anime_ep']) {
              $animeArray[$animeIndex]['anime_ep'] = $row['anime_ep'];
              $animeArray[$animeIndex]['anime_id'] = $row['anime_id'];
            }
          }

          // Increment the counter
          $counter++;
        }

        // Loop over the anime array and display the anime
        foreach ($animeArray as $anime) {
        ?>
          <div class="flw-item">
            <div data-movieid="<?= $anime['anime_title'] ?>" class="remove-item remove-cw" data-toggle="tooltip" data-original-title="Remove">
              <form method="post" action="ajax/_delete_anime.php">
                <input type="hidden" name="anime_title" value="<?= $anime['anime_title'] ?>">
                <button type="submit" name="delete_anime" style="border: none; background: none; cursor: pointer;">
                  <i class="fas fa-times"></i>
                </button>
              </form>
            </div>
            <div class="film-poster">
              <div class="tick ltr">
        <div class="tick-item-<?=$anime['dubOrSub']?> tick-eps amp-algn">
            <?=strtoupper($anime['dubOrSub'])?>
        </div>
    </div>
              <div class="tick rtl">
                <div class="tick-item tick-eps amp-algn">Ep <?= $anime['anime_ep'] ?></div>
              </div>
              <img class="film-poster-img lazyload" data-src="<?= $anime['anime_image'] ?>" src="https://anikatsu.me/files/images/no_poster.jpg" alt="<?= $anime['anime_title'] ?>">
              <a class="film-poster-ahref" href="/watch/<?= $anime['anime_id'] ?>" title="<?= $anime['anime_title'] ?>" data-jname="<?= $anime['anime_title'] ?>"><i class="fas fa-play"></i></a>
            </div>
            <div class="film-detail">
              <h3 class="film-name">
                <a href="/watch/<?= $anime['anime_id'] ?>" title="<?= $anime['anime_title'] ?>" data-jname="<?= $anime['anime_title'] ?>"><?= $anime['anime_title'] ?></a>
              </h3>
              <div class="fd-infor">
                <span class="fdi-item"><?= $anime['anime_release'] ?></span>
                <span class="dot"></span>
                <span class="fdi-item"><?= $anime['anime_type'] ?></span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>

        <?php } ?>

      </div>
      <div class="clearfix"></div>

    </div>
</section>

                <?php } ?>
                <?php } ?>

                    <div class="clearfix"></div>
                </div>
                <?php include('../_php/sidenav.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php include('../_php/footer.php'); ?>
        <div id="mask-overlay"></div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/comman.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/movie.js"></script>
        <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/function.js"></script>
        
    </div>
    </div>
</body>

</html>