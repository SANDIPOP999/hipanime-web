<div class="swiper-wrapper">

    <?php
    include __DIR__ . '_config.php';

    $url = "https://hip-api-consu-api.vercel.app/meta/banners";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!$data || !is_array($data)) {
        echo "<p>Error fetching spotlight data. Please try again later.</p>";
        exit;
    }

    foreach ($data as $key => $spotlight) {
        $title = $spotlight['title'] ?? "Unknown Title";
        $bannerImage = $spotlight['cover_image'] ?? "default.jpg";
        $id = $spotlight['mal_id'] ?? "#";
    ?>

    <div class="swiper-slide">
        <div class="deslide-item">
            <div class="deslide-cover">
                <div class="deslide-cover-img">
                    <img class="film-poster-img lazyload"
                        data-src="https://ik.imagekit.io/hipanime/<?= $bannerImage ?>"
                        alt="Watch <?= htmlspecialchars($title) ?> free online on Hipanime">
                </div>
            </div>
            <div class="deslide-item-content">
                <div class="desi-sub-text">#<?= $key + 1 ?> Spotlight</div>
                <div class="desi-head-title dynamic-name" data-jname="<?= htmlspecialchars($title) ?>">
                    <?= htmlspecialchars($title) ?>
                </div>
                <div class="desi-buttons">
                    <a class="btn btn-secondary btn-radius" 
                       href="<?=$websiteUrl?>/anime/<?=$id?>">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                        <i class="fas fa-angle-right ml-2"></i>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php } ?>

</div>
