<?php
require('./_config.php');
session_start();




$parts = parse_url($_SERVER['REQUEST_URI']);
$page_url = explode('/', $parts['path']);
$url = $page_url[count($page_url) - 1];
//$url = "naruto-episode-2";
$animeID = explode('-episode-', $url);

$animeID = $animeID[0];
$slug = explode('-', $animeID);
$dub = "";
if (end($slug) == 'dub') {
    $dub = "dub";
} else {
    $dub = "sub";
}
;

$getEpisode = file_get_contents("$api/getEpisode/$url");
$getEpisode = json_decode($getEpisode, true);
if (isset($getEpisode['error'])) {
    echo '<script>alert("There is no DUB Episode for the following anime");</script>';
    echo '<script>window.location.href = "/home";</script>';
    exit();
};





$pageID = $url;

$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$pageUrl = $CurPageURL;

//check for count
$query = mysqli_query($conn, "SELECT * FROM `pageview` WHERE pageID = '$pageID'");
$rows = mysqli_fetch_array($query);
$counter = $rows['totalview'];

$id = $rows['id'];
if (empty($counter)) {
    $counter = 1;
    mysqli_query($conn, "INSERT INTO `pageview` (pageID,totalview,like_count,dislike_count,animeID) VALUES('$pageID','$counter','1','0','$animeID')");
    header('Location: //' . $pageUrl);
}
;



$anime = $getEpisode['anime_info'];
$EPISODE_NUMBER = $getEpisode['ep_num'];
$download = str_replace("Gogoanime", "$websiteTitle", $getEpisode['ep_download']);
$streamingLink = str_replace("Gogoanime", $websiteTitle, $getEpisode['animeNameWithEP']);





$streamingID = $streamingLink = $download;
$streamingID = parse_url($streamingID);
parse_str($streamingID['query'], $streamingPID);
$streamingID = $streamingPID['id'];
$animeTitle = $streamingPID['title'];

$getAnime = file_get_contents("$api/getAnime/$anime");
$getAnime = json_decode($getAnime, true);

$animeSearch = trim($anime, "-dub");

$episodelist = $getAnime['episode_id'];
$firstEpID = $episodelist[0];
$firstEpID = $firstEpID['episodeId'];


$ANIME_RELEASED = $getAnime['released'];
$ANIME_name = $getAnime['name'];
$ANIME_NAME = rtrim($getAnime['name']);
$ANIME_IMAGE = $getAnime['imageUrl'];
$ANIME_TYPE = $getAnime['type'];


// Remove "-tv" from the end of $animeID if it's present
$animeID = str_replace('-tv', '', $animeID);

$getId = file_get_contents("$ani/meta/anilist/$animeID");
$getId = json_decode($getId, true);
$results = $getId['results'];
$firstResult = reset($results); 
$animeId = $firstResult['id'];


$getDetails = file_get_contents("$ani/meta/anilist/info/$animeId");
$getDetails = json_decode($getDetails, true);
$title = $getDetails['title'];





//increase counters by 1 on page load
$counter = $counter + 1;
mysqli_query($conn, "UPDATE `pageview` SET totalview ='$counter' WHERE pageID = '$pageID'");
$like_count = $rows['like_count'];
$dislike_count = $rows['dislike_count'];
$totalVotes = $like_count + $dislike_count;

if (isset($_COOKIE['userID'])) {
    $userID = $_COOKIE['userID'];

    $user_history = mysqli_query($conn, "SELECT * FROM `user_history` WHERE (user_id,anime_id) = ('$userID', '$url')");
    $user_history = mysqli_fetch_assoc($user_history);
    $user_history_anime_id = $user_history['anime_id'];
    $user_history_id = $user_history['id'];
    //echo  $user_history_id ;

    if (empty($user_history_anime_id)) {
        mysqli_query($conn, "INSERT INTO `user_history` (user_id,anime_id,anime_title,anime_ep,anime_image,anime_release,dubOrSub,anime_type)
        VALUES('$userID','$url','$ANIME_name','$EPISODE_NUMBER','$ANIME_IMAGE','$ANIME_RELEASED','$dub','$ANIME_TYPE')");
    } elseif ($user_history_anime_id == $url) {
        mysqli_query($conn, "DELETE FROM `user_history` WHERE id = '$user_history_id'");
        mysqli_query($conn, "INSERT INTO `user_history` (user_id,anime_id,anime_title,anime_ep,anime_image,anime_release,dubOrSub,anime_type)
        VALUES('$userID','$url','$ANIME_name','$EPISODE_NUMBER','$ANIME_IMAGE','$ANIME_RELEASED','$dub','$ANIME_TYPE')");
    }

}
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <title>Watch
        <?= $getEpisode['animeNameWithEP'] ?>on
        <?= $websiteTitle ?>
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="Watch <?= $getEpisode['animeNameWithEP'] ?>on <?= $websiteTitle ?>">
    <meta name="description" content="<?= substr($getAnime['synopsis'], 0, 150) ?> ... at <?= $websiteUrl ?>">
    <meta name="keywords"
        content="<?= $websiteTitle ?>, <?= $getEpisode['animeNameWithEP'] ?>,<?= $getAnime['othername'] ?><?= $getAnime['name'] ?>, watch anime online, free anime, anime stream, anime hd, english sub">
    <meta name="charset" content="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="robots" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Language" content="en">
    <meta property="og:title" content="Watch <?= $getEpisode['animeNameWithEP'] ?>on <?= $websiteTitle ?>">
    <meta property="og:description" content="<?= substr($getAnime['synopsis'], 0, 150) ?> ... at <?= $websiteUrl ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= $websiteTitle ?>">
    <meta property="og:url" content="<?= $websiteUrl ?>/anime/<?= $url ?>">
    <meta itemprop="image" content="<?= $getAnime['imageUrl'] ?>">
    <meta property="og:image" content="<?= $getAnime['imageUrl'] ?>">
    <meta property="twitter:title" content="Watch <?= $getEpisode['animeNameWithEP'] ?>on <?= $websiteTitle ?>">
    <meta property="twitter:description" content="<?= substr($getAnime['synopsis'], 0, 150) ?> ... at <?= $websiteUrl ?>">
    <meta property="twitter:url" content="<?= $websiteUrl ?>/anime/<?= $url ?>">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63430163bc99824a"></script>
    <meta name="theme-color" content="#202125">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        type="text/css">
    <link rel="shortcut icon" href="<?= $websiteUrl ?>/streamable.ico?v=<?= $version ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= $websiteUrl ?>/streamable.ico?v=<?= $version ?>" />
    <link rel="stylesheet" href="<?= $websiteUrl ?>/files/css/style.css?v=<?= $version ?>">
    <link rel="stylesheet" href="<?= $websiteUrl ?>/files/css/min.css?v=<?= $version ?>">
    
 
    
  
 
    <style> img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] { display: none;} </style>
    
    
</head>

<body data-page="movie_watch">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="movie_watch">
        <?php include('./_php/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" date-page="movie_watch" data-id="">
            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover"
                                style="background-image: url('<?= $websiteUrl ?>/files/images/banner.webp')">
                            </div>
                        </div>
                        <div class="anis-watch-wrap">
                            <div class="prebreadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                                            <a itemprop="item" href="/home"><span itemprop="name">Home</span></a>
                                            <meta itemprop="position" content="1">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item">
                                            <a itemprop="item" href="/anime"><span itemprop="name">Anime</span></a>
                                            <meta itemprop="position" content="2">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item"
                                            aria-current="page">
                                            <a itemprop="item" href="/anime/<?= $anime ?>"><span
                                                    itemprop="name"><?= $getAnime['name'] ?></span></a>
                                            <meta itemprop="position" content="3">
                                        </li>
                                        <li itemprop="itemListElement" itemscope=""
                                            itemtype="http://schema.org/ListItem" class="breadcrumb-item"
                                            aria-current="page">
                                            <a itemprop="item" href="<?= $websiteUrl ?>/watch/<?= $url ?>"><span
                                                    itemprop="name">Episode <?= $getEpisode['ep_num'] ?></span></a>
                                            <meta itemprop="position" content="4">
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            
                            <div class="anis-watch anis-watch-tv">
                                <div class="watch-player">
                                    <div class="player-frame">
                                        <div class="loading-relative loading-box" id="embed-loading">
                                            <div class="loading">
                                                <div class="span1"></div>
                                                <div class="span2"></div>
                                                <div class="span3"></div>
                                            </div>
                                        </div>
                                        
<iframe name="iframe-to-load" id="iframeid" src="https://6anime.org/stream/plyr.php?slug=<?= $url ?>&server=main" frameborder="0" scrolling="no" allow="accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture" allowfullscreen="true" webkitallowfullscreen="true"></iframe>

<script>
window.addEventListener("message", function(event) {
  if (event.data === "iframeLoaded") {
    setTimeout(function() {
      var iframe = document.getElementById("iframeid");
      var iframeWindow = iframe.contentWindow || iframe.contentDocument.defaultView;
      var playButton = iframeWindow.document.querySelector(".plyr__control.plyr__control--overlaid[aria-label='Play']");
      if (playButton) {
        playButton.click();
      }
    }, 5000); // 10 seconds delay
  }
});
</script>


     


<script>

document.addEventListener("fullscreenchange", function() {
  if (document.fullscreenElement) {
    screen.orientation.lock("landscape-primary");
  } else {
    screen.orientation.unlock();
  }
});

var video = document.querySelector("iframe-to-load").contentWindow.document.querySelector("video");
video.addEventListener("ended", function() {
  document.exitFullscreen();
  screen.orientation.unlock();
});
</script>
                                    </div>
                                    
                                    <div class="player-controls">
                                        <div class="pc-item pc-resize">
                                            <a href="javascript:;" id="media-resize" class="btn btn-sm"><i
                                                    class="fas fa-expand mr-1"></i>Expand</a>
                                        </div>
                                        <div class="pc-item pc-toggle pc-light">
                                            <div id="turn-off-light" class="toggle-basic">
                                                <span class="tb-name"><i class="fas fa-lightbulb mr-2"></i>Light</span>
                                                <span class="tb-result"></span>
                                            </div>
                                        </div>
                                        <div class="pc-item pc-download">
                                            <a class="btn btn-sm pc-download" href="<?= $download ?>" target="_blank"><i
                                                    class="fas fa-download mr-2"></i>Download</a>
                                                    <a onclick='reload()' class="btn btn-sm pc-download"><i class="fas fa-refresh mr-2"></i>Refresh</a>
                                                    
                                                    <a id="subdub" class="btn btn-sm pc-download">SUB <i class="fas fa-exchange-alt"></i> DUB</a>
                                        </div>
                                        <script>function reload() {
                document.getElementById('iframeid').src += '';
            }</script>
                                        
                                         
<style>
    .highlight-icon:hover {
        background-color: pink;
    }
</style>

<div class="pc-right">
    <?php if ($getEpisode['prevEpText'] != "") { ?>
        <div class="pc-item pc-control block-prev">
            <a class="btn btn-sm btn-prev" href="/watch<?= $getEpisode['prevEpLink'] ?>">
                <i class="fas fa-backward mr-2"></i><span class="highlight-icon">Prev</span>
            </a>
        </div>&nbsp;
    <?php } ?>

    <?php if ($getEpisode['nextEpText'] != "") { ?>
        <div class="pc-item pc-control block-next">
            <a class="btn btn-sm btn-next" href="/watch<?= $getEpisode['nextEpLink'] ?>">
                <i class="fas fa-forward ml-2"></i><span class="highlight-icon">Next</span>
            </a>
        </div>
    <?php } ?>

    <div class="pc-item pc-download" style="display:none;">
        <a class="btn btn-sm pc-download"><i class="fas fa-download mr-2"></i>Download</a>
        <a onclick='reload()' class="btn btn-sm pc-download"><i class="fas fa-refresh mr-2"></i>Refresh</a>
        <a id="subdub" class="btn btn-sm pc-download">Sub <i class="fas fa-exchange-alt"></i> Dub</a>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".btn-prev").click(function(e) {
            e.preventDefault();
            window.location.href = $(this).attr("href");
        });

        $(".btn-next").click(function(e) {
            e.preventDefault();
            window.location.href = $(this).attr("href");
        });
    });
    const button = document.querySelector('#subdub');
button.addEventListener('click', () => {
  let currentURL = window.location.href;
  console.log('Current URL:', currentURL);
  if (currentURL.includes('dub-episode')) {
    let newURL = currentURL.replace('-dub', '');
    console.log('New URL:', newURL);
    window.location.href = newURL;
  } else {
    let newURL = currentURL.replace('-episode', '-dub-episode');
    console.log('New URL:', newURL);
    window.location.href = newURL;
  }
});
</script>

                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                               <div class="player-servers">
    <div id="servers-content">
        <div class="ps_-status">
            <div class="content">
                <div class="server-notice"><strong>Currently watching <b>Episode
                                <?= htmlspecialchars($getEpisode['ep_num']) ?>
                            </b></strong> Switch to alternate
                    servers in case of error.</div>
            </div>
        </div>
        <div class="ps_-block ps_-block-sub servers-mixed">
            <div class="ps__-title"><i class="fas fa-server mr-2"></i>SERVERS:</div>
            <div class="ps__-list">
                <div class="item">
                    <a id="server1" 
                        href="https://6anime.org/stream/plyr.php?slug=<?= htmlspecialchars($url) ?>&server=main"
                        target="iframe-to-load" class="btn btn-server active">Server 1</a>
                </div>
                <div class="item">
                    <a id="server2"
                        href="https://6anime.org/stream/play.php?slug=<?= htmlspecialchars($url) ?>"
                        target="iframe-to-load" class="btn btn-server">Server 2</a>
                </div>
                <div class="item">
                    <a id="server3"
                        href="https://gotaku1.com/streaming.php?id=<?= htmlspecialchars($streamingID) ?>"
                        target="iframe-to-load" class="btn btn-server">Server 3 </a>
                </div>
                <div class="item">
                    <a id="server4"
                        href="https://player.anikatsu.me/index.php?id=<?= htmlspecialchars($url) ?>"
                        target="iframe-to-load" class="btn btn-server">Server 4 </a>
                </div>
                <div class="item">
                    <a id="server5"
                        href="https://6anime.org/stream/nspl.php?slug=<?= htmlspecialchars($url) ?>&server=main"
                        target="iframe-to-load" class="btn btn-server">Server 5 </a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="source-guide"></div>
        </div>
    </div>
</div>

<?php
// Assuming $getDetails contains the data with nextAiringEpisode information
if (isset($getDetails['nextAiringEpisode'])) {
    $getDetail = $getDetails['nextAiringEpisode'];

    // Convert the airing time to a human-readable format
    $airingTime = $getDetail['airingTime'];

    // Calculate the time until airing in days, hours, and minutes
    $timeUntilAiring = $getDetail['timeUntilAiring'];
    $days = floor($timeUntilAiring / (60 * 60 * 24));
    $hours = floor(($timeUntilAiring % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($timeUntilAiring % (60 * 60)) / 60);

    // Format the next airing episode
    $nextAiringEpisodeFormatted = sprintf("%dd %dh %dm", $days, $hours, $minutes);
?>

<div class="schedule-alert">
    <div class="alert small">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        <span class="icon-16 mr-1">🚀</span> Estimated that the next episode will be airing in
        <span><?php echo htmlspecialchars($nextAiringEpisodeFormatted); ?></span>
    </div>
</div>

<?php
}
?>
<style>
/* This is your existing CSS code */

/* Additional media screen styles for smartphone */
@media (max-width: 767px) {
  .os-list .os-item {
    width: calc(50% - 1rem); /* Two items per row */
  }
  .other-season {
  background-color: #14151a;
}
}

</style>
<?php
$json = file_get_contents("$ani/meta/anilist/info/$animeId");
$json = json_decode($json, true);

// Function to check if the type is valid (not MANGA, ONA, or OVA)
function isValidType($type) {
    $invalidTypes = array("MANGA", "NOVEL", "ONA","MUSIC", "OVA");
    return !in_array($type, $invalidTypes);
}

$filteredRecommendations = array_slice(array_filter($json['relations'], function ($recommended) {
    return isValidType($recommended['type']);
}), 0, 20);

// Check if there are any recommendations before displaying the content
if (!empty($filteredRecommendations)) {
?>

    <div class="other-season">
        <?php
        // Check if there are any recommendations before displaying the title
        if (!empty($filteredRecommendations)) {
        ?>
            <div class="os-title">Watch more seasons of this anime</div>
        <?php
        }
        ?>
        <div class="os-list">
            <?php
            // Variable to track the first iteration
            $firstIteration = true;

            foreach ($filteredRecommendations as $recommended) {
                $title = $recommended['title'];
                // Add the "active" class to the first result
                $activeClass = ($firstIteration) ? "" : "";
                $firstIteration = false;
            ?>
                <a href="<?=$websiteUrl?>/anilist/anime?id=<?=$recommended['id']?>" class="os-item <?=$activeClass?>" title="<?=$title['romaji']; ?>">
                    <div class="title"><?=$title['romaji']; ?></div>
                    <div class="season-poster" style="background-image: url(<?=$recommended['image']?>);"></div>
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div id="episodes-content">
    <div class="seasons-block seasons-block-max">
        <div id="detail-ss-list" class="detail-seasons">
            <div class="detail-infor-content">
                <div style="min-height:43px;" class="ss-choice">
                    <div class="ssc-list">
                        <div id="ssc-list" class="ssc-button">
                            <div class="ssc-label">List of episodes:</div>
                        </div>
                    </div>
                  
                    <div class="clearfix"></div>
                      <div class="ssc-quick" style="margin-bottom: -3.50px;">
    <div class="sscq-icon"><i class="fas fa-search"></i></div>
    <input id="search-ep" class="form-control" type="text"
        placeholder="Search EP #" autocomplete="off">
</div>

                </div>
                

                <div id="episodes-page-1" class="ss-list ss-list-min" data-page="1" style="display:block;">
                    <?php foreach ($episodelist as $episodelist) {
                        $isActive = ($getEpisode['ep_num'] === $episodelist['episodeNum']) ? 'active' : '';
                    ?>
                    <a title="Episode <?= $episodelist['episodeNum'] ?>"
                        class="ssl-item ep-item <?= $isActive ?>"
                        href="/watch/<?= $episodelist['episodeId'] ?>">
                        <div class="ssli-order" title=""><?= $episodelist['episodeNum'] ?></div>
                        <div class="ssli-detail">
                            <div class="ep-name dynamic-name" data-jname="" title=""></div>
                        </div>
                        <div class="ssli-btn">
                            <div class="btn btn-circle"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>

    // Add event listener for search input
    document.getElementById("search-ep").addEventListener("input", function() {
        var input = this.value.toLowerCase();
        var episodes = document.getElementsByClassName("ep-item");

        for (var i = 0; i < episodes.length; i++) {
            var episodeNum = episodes[i].getElementsByClassName("ssli-order")[0].innerText.toLowerCase();
            var episodeName = episodes[i].getElementsByClassName("ep-name")[0].innerText.toLowerCase();

            if (episodeNum.includes(input) || episodeName.includes(input)) {
                episodes[i].style.display = "block";
            } else {
                episodes[i].style.display = "none";
            }
        }
    });
</script>

                            </div>
                            <div class="anis-watch-detail">
                                <div class="anis-content">
                                    <div class="anisc-poster">
                                        <div class="film-poster">
                                            <img src="<?= $getAnime['imageUrl'] ?>" data-src="<?= $getAnime['imageUrl'] ?>"
                                                class="film-poster-img ls-is-cached lazyloaded"
                                                alt="<?= $getAnime['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="anisc-detail">
                                        <h2 class="film-name">
                                            <a class="text-white dynamic-name"
                                                title="<?= $getAnime['name'] ?>" data-jname="<?= $getAnime['name'] ?>"
                                                style="opacity: 1;"><?= $getAnime['name'] ?></a>
                                        </h2>
                                        <div class="film-stats">
                                            <div class="tac tick-item tick-quality">HD</div>
                                            <div class="tac tick-item tick-dub"><?= strtoupper($dub) ?></div>
                                            <div class="tac tick-item tick-view">
                                                <?php if ($counter) {
                                                    echo "<i class='fas fa-eye mr-1'></i>" . $counter;
                                                }
                                                ; ?>
                                            </div>
                                            <span class="dot"></span>
                                            <span class="item">
                                                <?= $getAnime['status'] ?>
                                            </span>
                                            <span class="dot"></span>
                                            <span class="item">
                                                <?= $getAnime['released'] ?>
                                            </span>
                                            <span class="dot"></span>
                                            <span class="item">
                                                <?= $getAnime['othername'] ?>
                                            </span>
                                            <span class="dot"></span>
                                            <span class="item">
                                                <?= $getAnime['type'] ?>
                                            </span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="film-description m-hide">
                                            <div class="text">
                                                <?= $getAnime['synopsis'] ?>
                                            </div>
                                        </div>
                                        <div class="film-text m-hide mb-3">
                                            <?= $websiteTitle ?> is a site to watch online anime like
                                            <strong>
                                                <?= $getAnime['name'] ?>
                                            </strong> online, or you can even watch
                                            <strong>
                                                <?= $getAnime['name'] ?>
                                            </strong> in HD quality
                                        </div>
                                        <div class="block"><a href="/anime/<?= $anime ?>" class="btn btn-xs btn-light"> View detail</a></div>

                                        <?php
                                        $likeClass = "far";
                                        if (isset($_COOKIE['like_' . $id])) {
                                            $likeClass = "fas";
                                        }

                                        $dislikeClass = "far";
                                        if (isset($_COOKIE['dislike_' . $id])) {
                                            $dislikeClass = "fas";
                                        }
                                        ?>
                                        <div class="dt-rate">
                                            <div id="vote-info">
                                                <div class="block-rating">
                                                    <div class="rating-result">
                                                        <div class="rr-mark float-left">
                                                            <strong><i class="fas fa-star text-warning mr-2"></i><span
                                                                    id="ratingAnime"><?= round((10 * $like_count + 5 * $dislike_count) / ($like_count + $dislike_count), 2) ?></span></strong>
                                                            <small id="votedCount">(
                                                                <?php
                                                                if (isset($totalVotes)) {
                                                                    echo $totalVotes;
                                                                } ?> Voted)
                                                            </small>
                                                        </div>
                                                        <div class="rr-title float-right">Vote now</div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="description">What do you think about this anime?</div>
                                                    <div class="button-rate">
                                                        <button type="button"
                                                            onclick="setLikeDislike('dislike','<?= $id ?>')"
                                                            class="btn btn-emo rate-bad btn-vote" style="width:50%"
                                                            data-mark="dislike"><i id="dislike"
                                                                class="<?php echo $dislikeClass ?> far fa-frown">
                                                            </i><span id="dislikeMsg"
                                                                class="ml-2">Boring</span></button>
                                                        <button onclick="setLikeDislike('like','<?= $id ?>')"
                                                            type="button" class="btn btn-emo rate-good btn-vote"
                                                            style="width:50%"><i id="like"
                                                                class="<?php echo $likeClass ?> far fa-grin-stars"> </i><span
                                                                id="likeMsg" class="ml-2">Amazing</span></button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="share-buttons share-buttons-detail">
                <div class="container">
                    <div class="share-buttons-block">
                        <div class="share-icon"></div>
                        <div class="sbb-title">
                            <span>Share Anime</span>
                            <p class="mb-0">to your friends</p>
                        </div>
                        <div class="addthis_inline_share_toolbox"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
<div class="mba-block" style="display: block; text-align: center; margin: 1rem 0;"><a href="https://mangareader.to" target="_blank" rel="nofollow"><img style="width: 728px; height: auto; max-width: 100%;" src="https://file.imgprox.net/728x90" alt="Mangareader"></a></div>
            <div class="container">
                <div id="main-content">
                    <section class="block_area block_area-comment">
                        <div class="block_area-header block_area-header-tabs">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">Comments</h2>
                            </div>
                            <div class="float-left bah-setting">

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <?php include('./_php/disqus.php'); ?>
                        </div>
                    </section>

                     <?php

if (substr($anime, -4) === '-dub') {
    include('./_php/recent-releases.php');
} else {
    include('./anilist/components/recommended.php');
}
?>


                    <div class="clearfix"></div>
                </div>
                <?php include('./_php/sidenav.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php include('./_php/footer.php'); ?>
        <div id="mask-overlay"></div>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js?v=<?=$version?>"></script>
                <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.min.js"></script>
        <script type="text/javascript"
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/app.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/comman.js?v=<?=$version?>"></script>
        <script type="text/javascript" src="<?=$websiteUrl?>/files/js/movie.js?v=<?=$version?>"></script>
        <link rel="stylesheet" href="<?=$websiteUrl?>/files/css/jquery-ui.css?v=<?=$version?>">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?v=<?=$version?>"></script>
        
        <script type="text/javascript">
            $(".btn-server").click(function () {
                $(".btn-server").removeClass("active");
                $(this).closest(".btn-server").addClass("active");
            });
        </script>
        <script type="text/javascript">
            if ('<?= $likeClass ?>' === 'fas') {
                document.getElementById('likeMsg').innerHTML = "Amazing"
            }
            if ('<?= $dislikeClass ?>' === 'fas') {
                document.getElementById('dislikeMsg').innerHTML = "Boring"
            }

            function setLikeDislike(type, id) {
                jQuery.ajax({
                    url: '<?= $websiteUrl ?>/setLikeDislike.php',
                    type: 'post',
                    data: 'type=' + type + '&id=' + id,
                    success: function (result) {
                        result = jQuery.parseJSON(result);
                        if (result.opertion == 'like') {
                            jQuery('#like').removeClass('far');
                            jQuery('#like').addClass('fas');
                            jQuery('#dislike').addClass('far');
                            jQuery('#dislike').removeClass('fas');
                            jQuery('#likeMsg').html("Amazing")
                            jQuery('#dislikeMsg').html("Boring")
                        }
                        if (result.opertion == 'unlike') {
                            jQuery('#like').addClass('far');
                            jQuery('#like').removeClass('fas');
                            jQuery('#likeMsg').html("Amazing")
                        }

                        if (result.opertion == 'dislike') {
                            jQuery('#dislike').removeClass('far');
                            jQuery('#dislike').addClass('fas');
                            jQuery('#like').addClass('far');
                            jQuery('#like').removeClass('fas');
                            jQuery('#dislikeMsg').html("Boring")
                            jQuery('#likeMsg').html("Amazing")
                        }
                        if (result.opertion == 'undislike') {
                            jQuery('#dislike').addClass('far');
                            jQuery('#dislike').removeClass('fas');
                            jQuery('#dislikeMsg').html("Boring")
                        }


                        jQuery('#votedCount').html(
                            `(${parseInt(result.like_count) + parseInt(result.dislike_count)} Voted)`
                        );
                        jQuery('#ratingAnime').html(((parseInt(result.like_count) *
                            10 + parseInt(result.dislike_count) * 5) / (
                                parseInt(result.like_count) + parseInt(
                                    result.dislike_count))).toFixed(2));
                    }

                });
            }
        </script>
    </div>
</body>

</html>