<?php 
require('_config.php');

// Extract ID from the "search" query parameter
if (isset($_GET['search'])) {
    $id = $_GET['search'];

    // Ensure it's a numeric ID
    if (!is_numeric($id)) {
        die("Error: Invalid anime ID.");
    }
} else {
    die("Error: No search ID provided.");
}

// API URL
$api_url = "$ani/anime/$id";

// Fetch data from API
$info = curl_init();
curl_setopt($info, CURLOPT_URL, $api_url);
curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($info);
curl_close($info);

// Handle API errors
if (!$response) {
    die("Error: Failed to fetch data from API.");
}

// Decode JSON response
$ani_info = json_decode($response, true);

// Validate API response
if (!$ani_info || !isset($ani_info['cover_image'])) {
    die("Error: Invalid API response.");
}

// Extract required data
$cover = $ani_info['cover_image'];
$title_romaji = $ani_info['title_romaji'] ?? 'Unknown Title';
$title_english = $ani_info['title_english'] ?? 'Unknown Title';
$description = $ani_info['description'] ?? 'No description available.';
$type = $ani_info['type'] ?? 'Unknown';
$total_episodes = $ani_info['total_episodes'] ?? 'Null';
$year = $ani_info['year'] ?? 'Unknown';
$genres = $ani_info['genres'] ?? [];
$episodelist = $ani_info['episode_id'] ?? [];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Watch <?= htmlspecialchars($title_romaji) ?> - Hipanime</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars(substr($description, 0, 90)) ?>... Read More on Hipanime.">

    <link rel="shortcut icon" href="<?=$websiteUrl?>/favicon.ico" type="image/x-icon">

    <!-- Theme CSS -->
    <style>
    :root {
        --theme-color: <?= $themeColor ?>;
        --theme-color-light: rgba(<?= hexdec(substr($themeColor,1,2)) ?>, <?= hexdec(substr($themeColor,3,2)) ?>, <?= hexdec(substr($themeColor,5,2)) ?>, 0.2);
        --text-color: #333;
        --bg-color: #fefefe;
        --card-bg: #ffffff;
        --hover-glow: 0 0 15px var(--theme-color);
        --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        margin: 0;
        font-family: var(--font-family);
        background: var(--bg-color);
        color: var(--text-color);
    }

    #wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0;
    }

    /* Full-width banner */
    .animec_detail-stage {
        position: relative;
        width: 100%;
        min-height: 500px;
        background: linear-gradient(to bottom, var(--theme-color-light), rgba(255,255,255,0.8)), url('<?=$cover?>') center/cover no-repeat;
        display: flex;
        align-items: flex-end;
        padding: 40px 20px;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.1);
    }

    .animec-detail {
        max-width: 800px;
        color: #222;
    }

    .anime-name {
        font-size: 2.5em;
        margin: 0 0 10px;
        font-weight: 700;
        color: var(--theme-color);
        text-shadow: 0 0 10px var(--theme-color-light);
    }

    .anime-stats {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .tick-item {
        background: var(--theme-color-light);
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 0.85em;
        font-weight: 600;
        color: var(--theme-color);
        box-shadow: var(--hover-glow);
        transition: all 0.3s ease;
    }

    .tick-item:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px var(--theme-color);
    }

    .anime-buttons {
        display: flex;
        gap: 15px;
        margin: 20px 0;
    }

    .anime-btn, .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 30px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .anime-btn-primary, .btn-primary {
        background-color: var(--theme-color);
        color: #fff;
        box-shadow: var(--hover-glow);
    }

    .anime-btn-primary:hover, .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 0 25px var(--theme-color);
    }

    .anime-description {
        margin-top: 20px;
        font-size: 1em;
        line-height: 1.6em;
        background: rgba(255,255,255,0.8);
        padding: 15px 20px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .animec-info-wrap {
        margin-top: 30px;
    }

    .animec-info .item {
        margin-bottom: 12px;
        font-size: 0.95em;
    }

    .item-head {
        font-weight: 600;
        color: var(--theme-color);
        margin-right: 5px;
    }

    .item-list a {
        display: inline-block;
        background: var(--theme-color-light);
        color: var(--theme-color);
        padding: 4px 10px;
        border-radius: 10px;
        margin: 2px 5px 2px 0;
        text-decoration: none;
        font-size: 0.85em;
        transition: all 0.3s ease;
    }

    .item-list a:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px var(--theme-color);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .animec_detail-stage {
            flex-direction: column;
            padding: 20px 15px;
        }
        .anime-name {
            font-size: 2em;
        }
        .anime-buttons {
            flex-direction: column;
            gap: 10px;
        }
    }

    /* Minimal embedded FontAwesome icons */
    [class^="fas"], [class*=" fas"] {
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        display: inline-block;
        text-decoration: inherit;
    }
    .fa-play:before { content: "\f04b"; }
    .fa-bookmark:before { content: "\f02e"; }
    </style>
</head>
<body data-page="movie_info">
    <div id="wrapper" data-page="page_home">
        <?php include('./_php/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" date-page="movie_info" data-id="<?=$url?>">
            <div id="ani_detail">
                <div class="animec_detail-stage">
                    <div class="animec-detail">
                        <h2 class="anime-name dynamic-name" data-jname="<?=$title_romaji?>"><?=$title_romaji?></h2>
                        <div class="anime-stats">
                            <div class="tick-item tick-quality">HD</div>
                            <div class="tick-item tick-dub">
                                <?php echo "SUB/DUB"; ?>
                            </div>
                            <span class="dot"></span>
                            <span class="item"><?=$type?></span>
                            <span class="dot"></span>
                            <span class="item"><?=$total_episodes?></span>
                        </div>

                        <?php if(count($ani_info['episode_id']) > 0) { ?>
                        <div class="anime-buttons">
                            <a href="/watch/" class="anime-btn anime-btn-primary anime-btn-play"><i class="fas fa-play"></i> Watch now</a>
                            <button onclick="saveToPlaylist('Anime List', '<?=$title_romaji?>', 'https://<?$websiteUrl?>/anime/<?=$id?>', 'https://ik.imagekit.io/<?=$imgk?>/tr:w-100,tr:f-webp/<?=$cover?>');checkIfBookmarked('Anime List', '<?=$ani_info['name']?>')" id="save-to-playlist-button" class="btn btn-primary"><i class="fas fa-bookmark"></i> Watch later</button>
                        </div>
                        <?php } ?>

                        <div class="anime-description m-hide">
                            <div class="text"><?=$ani_info['synopsis']?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <?php include('./_php/recent-releases.php'); ?>
            </div>
        </div>
        <?php include('_php/footer.php'); ?>
    </div>
</body>
</html>