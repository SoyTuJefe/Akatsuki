<?php 
require_once('../_config.php');
$animeId = $_GET['id'];

$getAnime = file_get_contents("$ani/meta/anilist/info/$animeId");
$getAnime = json_decode($getAnime, true);
$title = $getAnime['title'];
$episodelist = $getAnime['episodes'];

// Original code to set the format based on the availability of English title
if (isset($title['romaji']) && !empty($title['romaji'])) {
    $format = $title['romaji'];
} else {
    $format = $title['english'];
}

// Convert the title to lowercase
$format = strtolower($format);

// Replace spaces with dashes
$format = str_replace(' ', '-', $format);

// Replace special characters ☆, ( ), and : with spaces
$format = str_replace(['×', '×', '☆', '(', ')', ':'], ' ', $format);

// Now $format contains the formatted anime title with special characters replaced by spaces, in lowercase, and with spaces replaced by dashes.

// Check if 'Shippuuden' is present in the title and has more than 2 'u'
if (strpos($format, 'shippuuden') !== false && substr_count($format, 'u') > 2) {
    // Replace the first occurrence of 'uu' with 'u' to make it 'shippuden'
    $format = str_replace('uu', 'u', $format);
}

// URL encode the formatted title
$keyword = urlencode($format);

// Perform the first search using the English title
$json = file_get_contents("$api/search?keyw=$keyword");
$json = json_decode($json, true);

// Check if the search result is empty for English title
if (empty($json)) {
    // If the search result is empty, use the Romaji title as a fallback
    $format_romaji = $title['romaji'];

    // Convert the Romaji title to lowercase
    $format_romaji = strtolower($format_romaji);

    // Replace spaces with dashes
    $format_romaji = str_replace(' ', '-', $format_romaji);

    // Replace special characters ☆, ( ), and : with spaces
    $format_romaji = str_replace(['×', '×', '☆', '(', ')', ':'], ' ', $format_romaji);

    // Check if 'Shippuuden' is present in the title and has more than 2 'u'
    if (strpos($format_romaji, 'shippuuden') !== false && substr_count($format_romaji, 'u') > 2) {
        // Replace the first occurrence of 'uu' with 'u' to make it 'shippuden'
        $format_romaji = str_replace('uu', 'u', $format_romaji);
    }

    // URL encode the formatted Romaji title
    $keyword_romaji = urlencode($format_romaji);

    // Perform the search using the Romaji title
    $json = file_get_contents("$api/search?keyw=$keyword_romaji");
    $json = json_decode($json, true);
}

$url = $json[0]['anime_id'];

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YMF34F7PHK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YMF34F7PHK');
</script>
    <title>Watch <?=$getAnime['name']?> - <?=$websiteTitle?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="Watch <?=$getAnime['name']?> - <?=$websiteTitle?>" />
    <meta name="description" content="<?=substr($getAnime['synopsis'],0, 150)?>.... Read More On <?=$websiteTitle?>" />
    <meta name="keywords" content="<?=$getAnime['name']?>, <?=$getAnime['othername']?>, <?=$websiteTitle?>, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, <?=$websiteTitle?>, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa" />
    <meta name="charset" content="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="en" />
    <meta property="og:title" content="Watch <?=$getAnime['name']?> - <?=$websiteTitle?>">
    <meta property="og:description" content="W<?=substr($getAnime['synopsis'],0, 150)?>.... Read More On <?=$websiteTitle?>.">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$websiteTitle?>">
    <meta property="og:url" content="<?=$websiteUrl?>/anime/<?=$url?>">
    <meta itemprop="image" content="<?=$getAnime['imageUrl']?>">
    <meta property="og:image" content="<?=$getAnime['imageUrl']?>">
    <meta property="og:image:secure_url" content="<?=$getAnime['imageUrl']?>">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="twitter:title" content="Watch <?=$getAnime['name']?> - <?=$websiteTitle?>">
    <meta property="twitter:description" ontent="W<?=substr($getAnime['synopsis'],0, 150)?>.... Read More On <?=$websiteTitle?>.">
    <meta property="twitter:url" content="<?=$websiteUrl?>/anime/<?=$url?>">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="shortcut icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$websiteUrl?>/streamable.ico?v=<?=$version?>" />
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/style.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/min.css?v=<?=$version?>">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63430163bc99824a"></script>
    <script type="text/javascript">
        setTimeout(function () {
            var wpse326013 = document.createElement('link');
            wpse326013.rel = 'stylesheet';
            wpse326013.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css';
            wpse326013.type = 'text/css';
            var godefer = document.getElementsByTagName('link')[0];
            godefer.parentNode.insertBefore(wpse326013, godefer);
            var wpse326013_2 = document.createElement('link');
            wpse326013_2.rel = 'stylesheet';
            wpse326013_2.href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css';
            wpse326013_2.type = 'text/css';
            var godefer2 = document.getElementsByTagName('link')[0];
            godefer2.parentNode.insertBefore(wpse326013_2, godefer2);
        }, 500);
    </script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
    </noscript>
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} </style>
</head>

<body data-page="movie_info">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
        <?php include('../_php/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" date-page="movie_info" data-id="<?=$id?>">
            <?php include('./components/anime/detailsFetch.php'); ?>
            <div class="container">
                <div id="main-content">

                    <?php include('./components/recommended.php'); ?>
                    <div class="clearfix"></div>
                </div>
                <?php include('../_php/sidenav.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
       <?php include('../_php/footer.php'); ?>
        <div id="mask-overlay"></div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/comman.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/movie.js"></script>
        <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/function.js"></script>
    </div>
</body>

</html>