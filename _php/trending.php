<?php
include('_config.php'); // Import $ani variable

// Define API URL
$apiUrl = "$api/meta/top-airing";

// Prepare cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));

// Send request and get response
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}
curl_close($ch);

// Decode JSON response
$animeData = json_decode($response, true);
?>

<div id="anime-trending">
    <div class="container">
        <section class="block_area block_area_trending">
            <div class="block_area-header">
                <div class="bah-heading">
                    <h2 class="cat-heading">Trending</h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="block_area-content">
                <div class="trending-list" id="trending-home">
                    <div class="swiper-container">
                        <div class="swiper-wrapper" id="animeCards">
                            <!-- Initial Cards Rendered by PHP -->
                            <?php
                            if (!empty($animeData)) {
                                $initialCards = array_slice($animeData, 0, 20); // First 20 cards
                                foreach ($initialCards as $key => $popular) {
                                    $title = $popular['title']; // Fixed title access
                                    $coverImage = $popular['cover_image'];
                                    $id = $popular['mal_id']; // Fixed anime ID access
                            ?>
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <div class="number">
                                                <span><?= $key + 1 ?></span>
                                                <div class="film-title dynamic-name" data-jname="<?= htmlspecialchars($title) ?>">
                                                    <?= htmlspecialchars($title) ?>
                                                </div>
                                            </div>
                                            <a href="<?= $websiteUrl ?>/anime/<?= $id ?>" class="film-poster" title="<?= htmlspecialchars($title) ?>">
                                                <img style="max-width: 200px; height: auto;" class="film-poster-img lazyload"
                                                     data-src="https://ik.imagekit.io/hipanime/tr:w-200,f-webp/<?= $coverImage ?>"
                                                     alt="Watch <?= htmlspecialchars($title) ?> free online on Hipanime">
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>