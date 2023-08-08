<div id="schedule-block">
    <section class="block_area block_area_sidebar block_area-schedule schedule-full">
        <div class="block_area-header">
            <div class="float-left bah-heading mr-4">
                <h2 class="cat-heading">Estimated Schedule</h2>
            </div>
            <div class="float-left bah-time">
                <span class="current-time">
                    <span id="timezone"></span>
                    <span id="current-date"></span>
                    <span id="clock"></span>
                </span>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block_area-content">
            <div class="table_schedule">
                <div class="clearfix"></div>
                <ul class="ulclear table_schedule-list limit-8">
<?php
// ... (previous code)
    // Function to fetch JSON data from a URL
    function fetchJsonData($url) {
        $json = file_get_contents($url);
        return json_decode($json, true);
    }

    // Load the content from the first page
    $pageNum = 1;
    $data1 = fetchJsonData("$ani/meta/anilist/airing-schedule?page=$pageNum");

    // Check if there is a nextPage and load the content from the second page
    if ($data1['hasNextPage']) {
        $pageNum = 2;
        $data2 = fetchJsonData("$ani/meta/anilist/airing-schedule?page=$pageNum");
        $data = array_merge($data1['results'], $data2['results']);
    } else {
        $data = $data1['results'];
    }

    // Load the content from the second file for notYetAired
    $json2 = file_get_contents("$ani/meta/anilist/airing-schedule?notYetAired=true");
    $data2 = json_decode($json2, true);
    $data = array_merge($data, $data2['results']);

    // Get today's date
    $today = (new DateTime("now", new DateTimeZone("GMT-6:00")))->format('Y-m-d');

// Move the <li> tag inside the loop to create a list item for each schedule
foreach ($data as $schedule) {
    // Check if the schedule has "genres" and if "Hentai" is present in the genres
    if (isset($schedule['genres']) && in_array('Hentai', $schedule['genres'])) {
        // Skip this schedule and continue with the next iteration
        continue;
    }

    $title = $schedule['title'];
    $airingDate = (new DateTime("@{$schedule['airingAt']}"))->setTimezone(new DateTimeZone("GMT-6:00"))->format('Y-m-d');
    $dayLabel = (new DateTime("@{$schedule['airingAt']}"))->setTimezone(new DateTimeZone("GMT-6:00"))->format('D M d');
    $airingTime = (new DateTime("@{$schedule['airingAt']}"))->setTimezone(new DateTimeZone("GMT-4:15"))->format("h:i A");

    // Check if the airing date is today or in the future
    if ($airingDate >= $today) {
        ?>
        <li>
            <a href="<?= $websiteUrl ?>/anilist/anime?id=<?= $schedule['id'] ?>" class="tsl-link">
                <div class="time">
                    <?= $airingTime ?>
                </div>
                <div class="film-detail">
                    <h3 class="film-name dynamic-name" data-jname="<?= $title['romaji'] ?>">
                        <?= $title['romaji'] ?>
                    </h3>
                    <div class="category">
                        <?= $dayLabel ?>
                    </div>
                    <div class="fd-play">
                        <button type="button" class="btn btn-sm btn-play">
                            <i class="fas fa-play mr-2"></i> Episode <?= $schedule['episode'] ?>
                        </button>
                    </div>
                </div>
            </a>
        </li>
        <?php
    }
}
?>
</ul>
                <button id="scl-more" class="btn btn-sm btn-block btn-showmore" style="display: none;"></button>
            </div>
        </div>
    </section>
</div>

<!-- Add the required Swiper library -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Add the required jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showTime() {
        var time = new Date();
        var hour = time.getHours();
        var min = time.getMinutes();
        var sec = time.getSeconds();
        var am_pm = "AM";

        if (hour > 12) {
            hour -= 12;
            am_pm = "PM";
        }
        if (hour === 0) {
            hour = 12;
            am_pm = "AM";
        }

        hour = hour < 10 ? "0" + hour : hour;
        min = min < 10 ? "0" + min : min;
        sec = sec < 10 ? "0" + sec : sec;

        var currentTime = hour + ":" + min + ":" + sec + " " + am_pm;
        $('#clock').html(currentTime);
    }

    var date = new Date();
    $('#current-date').text(date.toLocaleDateString());
    var timezone = date.toString().split(" ")[5];
    $('#timezone').text("(" + timezone.slice(0, timezone.length - 2) + ":" + timezone.slice(-2) + ")");

    showTime();

    $("#scl-more").click(function () {
        $(this).parent().find(".limit-8").toggleClass("active");
        $(this).toggleClass("active");
    });

    if ($('.table_schedule-list li').length > 7) {
        $('#scl-more').show();
    }

    var scheduleSw = new Swiper('.table_schedule .swiper-container', {
        slidesPerView: 7,
        spaceBetween: 10,
        navigation: {
            nextEl: '.tsn-next',
            prevEl: '.tsn-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            // Add more breakpoints here as needed
        },
    });

    scheduleSw.slideTo($(".tsd-item").index($(".tsd-item.active")), 1000);
    setTimeout(function () {
        $(".tsd-item.active").click();
    }, 1000);

    $('.day-item').click(function () {
        var tzOffset = new Date().getTimezoneOffset();
        $('.tsd-item').removeClass('active');
        $(this).find('.tsd-item').addClass('active');
        $.get('/ajax/schedule/list?tzOffset=' + tzOffset + '&date=' + $(this).data('date'), function (res) {
            if (res) {
                $('.table_schedule-list').html(res.html);
                if ($('.table_schedule-list li').length > 7) {
                    $('#scl-more').show();
                } else {
                    $('#scl-more').hide();
                }
            }
        });
    });

    setInterval(showTime, 1000);
</script>
