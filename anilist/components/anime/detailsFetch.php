            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover"
                                style="background-image: url('<?=$getAnime['image']?>')"></div>
                        </div>
                        <div class="anis-content">
                            <div class="anisc-poster">
                                <div class="film-poster">
                                    <img src="<?=$cdn?>/images/no_poster.jpg"
                                        data-src="<?=$getAnime['image']?>"
                                        class="lazyload film-poster-img">
                                </div>
                            </div>
                            
                            <div class="anisc-detail">
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
                                                itemtype="http://schema.org/ListItem"
                                                class="breadcrumb-item dynamic-name" data-jname="<?=$title['romaji']?>"
                                                aria-current="page">
                                                <a itemprop="item" href="/anime?id=<?=$id?>"><span itemprop="name"><?=$title['romaji']?></span></a>
                                                <meta itemprop="position" content="3">
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <h2 class="film-name dynamic-name" data-jname="<?=$title['romaji']?>"><?=$title['romaji']?></h2>
                                <div class="film-stats">
                                    <div class="tac tick-item tick-quality">HD</div>
                                    <div class="tac tick-item tick-dub"><?=strtoupper($getAnime['subOrDub'])?></div>
                                    <span class="dot"></span>
                                    <span class="item"><?=$getAnime['type']?></span>
                                    <div class="clearfix"></div>
                                </div>
  
                       <?php
if (count($getAnime['episodes']) > 0) {
    $lastEpisode = end($getAnime['episodes']);
?>

<div class="film-buttons">
    <?php
    foreach (array_slice($episodelist, 0, 1) as $episode1) {
        ?>
        <a href="<?= $websiteUrl ?>/watch/<?= $lastEpisode['id'] ?>" class="btn btn-radius btn-primary btn-play">
            <i class="fas fa-play mr-2"></i>Watch now
        </a>
    <?php
    }

    if (isset($_COOKIE['userID'])) {
        $watchLater = mysqli_query($conn, "SELECT * FROM `watch_later` WHERE (user_id,anime_id) = ('$user_id','$url')");
        $watchLater = mysqli_fetch_assoc($watchLater);
        $anime_id = isset($watchLater['anime_id']) ? $watchLater['anime_id'] : null;

        if ($anime_id === null) {
            ?>
            <a id="addToList" class="btn btn-radius btn-light" animeId="<?= $url ?>">
                &nbsp;<i class='fas fa-plus mr-2'></i> Add to List&nbsp;
            </a>
        <?php
        } elseif ($anime_id === $url) {
            ?>
            <a id="addToList" class="btn btn-radius btn-light" animeId="<?= $url ?>">
                &nbsp;<i class='fas fa-minus mr-2'></i> Remove &nbsp;
            </a>
        <?php
        }
    }

    if (!isset($_COOKIE['userID'])) {
        ?>
        <a href="<?= $websiteUrl ?>/user/login?animeId=<?= $url ?>" class="btn btn-radius btn-light">
            &nbsp;<i class='fas fa-plus mr-2'></i>&nbsp;Add to List&nbsp;
        </a>
    <?php
    }
    ?>
</div>

<?php
}
?>

<!-- Move the JavaScript part outside the PHP block -->
<script>
    let btn = document.querySelector('#addToList');
    btn.addEventListener("click", () => {
        let btnValue = btn.getAttribute('animeId');
        $.post('../user/ajax/watchlist.php', {
            btnValue: btnValue
        }, (response) => {
            btn.innerHTML = response;
        });
    });
</script>

                                <div class="film-description m-hide">
                                    <div class="text"><?=$getAnime['description']?></div>
                                </div>
                                <div class="film-text m-hide">StreamAble is a site to watch online anime like <strong><?=$title['romaji']?></strong> online, or you can even watch <strong><?=$title['romaji']?></strong> in HD quality</div>
                                <div class="share-buttons share-buttons-min mt-3">
                                <div class="share-buttons-block" style="padding-bottom: 0 !important;">
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
                            <div class="anisc-info-wrap">
                                <div class="anisc-info">
                                    <div class="item item-title w-hide">
                                        <span class="item-head">Overview:</span>
                                        <div class="text"><?=$getAnime['description']?></div>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Other names:</span> <span class="name"><?php echo implode(",",$getAnime['synonyms']) ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Aired:</span> 
                                        <span class="name"><?php $startDate = $getAnime['startDate'];
                                        $monthNum  = $startDate['month'];
                                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                        echo $monthName = $dateObj->format('F'); echo " ";
                                        echo $startDate['day']; echo ", "; echo $startDate['year'];
                                        ?> to 
                                        <?php $endDate = $getAnime['endDate'];
                                        if ($endDate['year'] == null){
                                            echo "?"; }
                                        else {
                                                $monthNum  = $endDate['month'];
                                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                        echo $monthName = $dateObj->format('F'); echo " ";
                                        echo $endDate['day']; echo ", "; echo $endDate['year'];
                                            }
                                       
                                        ?>
                                        </span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Episodes:</span> <span class="name"><?php echo count($getAnime['episodes'])?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Premiered:</span> <span class="name"><?=$getAnime['season']?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Duration:</span> <span class="name"><?=$getAnime['duration']?>m</span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Status:</span> <a href="<?php if ($getAnime['status'] == "Completed") {echo "/status/completed";} else {echo "/status/ongoing";}?>"><span class="name"><?=$getAnime['status']?></span></a>
                                    </div>
                                    <div class="item item-list">
                                        <span class="item-head">Genres:</span> <?php foreach($getAnime['genres'] as $genre) { ?><a href="<?=$websiteUrl?>/genre/<?php $genreUrl = strtolower($genre); echo str_replace(" ","+", $genreUrl);?>"><?=$genre?></a><?php } ?>
                                    </div>
                                    <div class="film-text w-hide">StreamAble is a site to watch online anime like <strong><?=$title['romaji']?></strong> online, or you can even watch <strong><?=$title['romaji']?></strong> in HD quality</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>