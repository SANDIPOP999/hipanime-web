<?php 
require_once(dirname(__DIR__) . '/_config.php');
 
$getAnime = file_get_contents("$ani/meta/anilist/random-anime");
$getAnime = json_decode($getAnime, true);
$id = $getAnime['id'];
$newURL = "$websiteUrl/anilist/anime?id=$id";
header('Location: '.$newURL);
?>