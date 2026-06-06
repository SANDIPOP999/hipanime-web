<?php 
require __DIR__ . '_config.php';
 
$keyword = $_GET['keyword'];
$keyword = str_replace(' ', '%20', $keyword);
$page = $_GET['page']; 
if ($page == ""){
    $page = 1;
}
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>List All Anime with keyword on Hipanime</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="title" content="List All Anime with keyword on Hipanime">
    <meta name="description" content="Popular Anime in HD with No Ads. Watch anime online">
    <meta name="keywords" content="Hipanime, watch anime online, free anime, anime stream, anime hd, english sub, kissanime, gogoanime, animeultima, 9anime, 123animes, Hipanime, vidstreaming, gogo-stream, animekisa, zoro.to, gogoanime.run, animefrenzy, animekisa">
    <meta name="charset" content="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Language" content="en">
    <meta property="og:title" content="List All Anime with keyword on Hipanime">
    <meta property="og:description" content="List All Anime with keyword on Hipanime in HD with No Ads. Watch anime online">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Hipanime">
    <meta itemprop="image" content="<?=$cdn?>/images/banner.webp">
    <meta property="og:image" content="<?=$cdn?>/images/banner.webp">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="twitter:card" content="summary">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" type="text/css">
    <link rel="shortcut icon" href="<?=$websiteUrl?>/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=$cdn?>/css/style.css">
    <link rel="stylesheet" href="<?=$cdn?>/css/min.css">
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
    <script></script>
</head>

<body data-page="page_anime">
    <div id="sidebar_menu_bg"></div>
    <div id="wrapper" data-page="page_home">
        <?php include('./_php/header.php'); ?>
        <div class="clearfix"></div>
        <div id="main-wrapper">
            <div class="container">
                <div id="main-content">
                    <section class="block_area block_area_category">
                        <div class="block_area-header">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">RESULT ANIME SEARCH</h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                                <div class="film_list-wrap">

                                <?php 
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "$api/search?query=$keyword");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                                $response = curl_exec($ch);
                                $results = json_decode($response, true);
                                curl_close($ch);

                                foreach((array) $results as $search) { 
                                    // Extract only "G", "R", or "PG-13" from the rating
                                    preg_match('/^(G|R|PG-13)/', $search['rating'], $matches);
                                    $mainRating = isset($matches[1]) ? $matches[1] : "N/A"; // Default if not found
                                ?>
                                    <div class="flw-item">
                                        <div class="film-poster">
                                            <div class="tick ltr">
                                                <div class="tick-item-sub tick-eps amp-algn" style="background-color: #ff4c4c; color: white;">
                                                    <?= $mainRating ?>
                                                </div> <!-- Shows Rating in Red -->
                                            </div>
                                            <div class="tick rtl"></div>
                                            <img class="film-poster-img lazyload"
                                                data-src="https://ik.imagekit.io/<?=$imgk?>/tr:f-webp/<?=$search['cover_image']?>"
                                                src="https://ik.imagekit.io/<?=$imgk?>/tr:f-webp/<?=$cdn?>/images/no_poster.jpg"
                                                alt="<?=$search['title']?>">
                                            <a class="film-poster-ahref"
                                                href="/anime/<?=$search['mal_id']?>"
                                                title="<?=$search['title']?>"
                                                data-jname="<?=$search['title']?>"><i class="fas fa-play"></i></a>
                                        </div>
                                        <div class="film-detail">
                                            <h3 class="film-name">
                                                <a href="/anime/<?=$search['mal_id']?>"
                                                   title="<?=$search['title']?>"
                                                   data-jname="<?=$search['title']?>"><?=$search['title']?></a>
                                            </h3>
                                            <div class="description"></div>
                                            <div class="fd-infor">
                                                <span class="fdi-item" ><?=$search['type']  ?> <?=$search['duration']?></span> <!-- "HD" in Red -->
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>

                                <?php 
                                if (empty($results)) { ?>
                                    <div class="tab-content">
                                        <style>
                                            .marginLeft{
                                                margin-left:10px;
                                            }
                                            @media screen and (max-width: 576px) {
                                                .marginLeft { margin-left:40px; }
                                            }
                                        </style>
                                        <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                                            <div class="marginLeft">
                                                No result for <?=$keyword?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pagination">
                                    <nav>
                                        <ul class="ulclear az-list">
                                        <?php 
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, "$api/search?query=$keyword");
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                        curl_setopt($ch, CURLOPT_HEADER, FALSE);
                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                                        $searchPage = curl_exec($ch);
                                        curl_close($ch);

                                        $searchPage = json_decode($searchPage, true);
                                        if (!empty($searchPage['pagination'])) { ?>
                                            <?=$searchPage['pagination'];?>
                                        <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
                <?php include('./_php/sidenav.php'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php include('./_php/footer.php'); ?>
        <div id="mask-overlay"></div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$cdn?>/js/video.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
        <script type="text/javascript" src="<?=$cdn?>/js/app.js"></script>
        <script type="text/javascript" src="<?=$cdn?>/js/comman.js"></script>
        <script type="text/javascript" src="<?=$cdn?>/js/movie.js"></script>
        <link rel="stylesheet" href="<?=$cdn?>/css/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="<?=$cdn?>/js/function.js"></script>
    </div>
</body>
</html>