<section class="block_area block_area_category">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-4">
            <h2 class="cat-heading">Recommendations</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tab-content">
        <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
            <div class="film_list-wrap">
                <?php 
                // Retrieve the anime ID from the current page URL
                $id = $_GET['id'] ?? null;

                if (!$id) {
                    echo "<p>Error: Anime ID not found in the URL.</p>";
                } else {
                    // API URL with query parameter
                    $apiUrl = "https://ani-api-hipanime.vercel.app/meta/anilist/info?id=" . urlencode($id);

                    // Initialize cURL for POST request
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $apiUrl); // Set the API URL with query parameter
                    curl_setopt($ch, CURLOPT_POST, true); // Use POST method
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

                    $response = curl_exec($ch);

                    // Handle cURL errors
                    if ($response === false) {
                        echo "<p>Error fetching recommendations: " . curl_error($ch) . "</p>";
                    } else {
                        // Decode the API response
                        $data = json_decode($response, true);

                        // Check if recommendations are available
                        if (isset($data['results']['recommendations'])) {
                            foreach ($data['results']['recommendations'] as $recommended) {
                                $title = $recommended['title'];
                                $image = $recommended['coverImage']['large'] ?? ''; // Get the 'large' cover image
                                $animeId = $recommended['id'];
                ?>
                <div class="flw-item">
                    <div class="film-poster">
                        <img class="film-poster-img lazyload"
                            data-src="<?= htmlspecialchars($image) ?>"
                            src="<?= htmlspecialchars($image) ?>"
                            alt="Watch <?= htmlspecialchars($title['romaji']) ?> free online Hipanime">
                        <a class="film-poster-ahref"
                            href="/anilist/anime?id=<?= htmlspecialchars($animeId) ?>"
                            title="<?= htmlspecialchars($title['romaji']) ?>"
                            data-jname="<?= htmlspecialchars($title['romaji']) ?>"><i class="fas fa-play"></i></a>
                    </div>
                    <div class="film-detail">
                        <h3 class="film-name">
                            <?= htmlspecialchars($title['romaji'] ?? 'Unknown Title') ?>
                        </h3>
                        <p class="film-subtitle">
                            <?= htmlspecialchars($title['english'] ?? 'No English Title') ?>
                        </p>
                    </div>
                </div>
                <?php 
                            }
                        } else { 
                ?>
                <p>No recommendations available at the moment.</p>
                <?php 
                        }
                    }

                    curl_close($ch); // Close the cURL session
                }
                ?>
            </div>
        </div>
    </div>
</section>
