<?php

// Extract the ID from the URL's query parameters

$id = $_GET['id'] ?? null;

if (!$id) {

    die("Error: No Anime ID provided in the URL.");

}

// API endpoint with the ID as a query parameter

$api_url = "https://ani-api-hipanime.vercel.app/meta/anilist/info?id=" . urlencode($id);

// Initialize cURL for the POST request

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url); // Set the URL

curl_setopt($ch, CURLOPT_POST, true);    // Use POST method

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute the POST request

$response = curl_exec($ch);

// Handle any cURL errors

if ($response === false) {

    die("Error: Failed to fetch data from the API. cURL Error: " . curl_error($ch));

}

curl_close($ch);

// Decode the JSON response from the API

$data = json_decode($response, true);

// Check if the API returned valid data

if (!$data || !isset($data['results'])) {

    die("Error: Anime details not found.");

}

$anime = $data['results'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($anime['title']['romaji'] ?? 'Anime Details') ?></title>

    <style>

        /* Scoped styling for the anime details container */

        .container {

            font-family: 'Poppins', Arial, sans-serif;

            width: 90%;

            max-width: 800px;

            background: #161b22;

            border-radius: 10px;

            padding: 20px;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);

            text-align: center;

            border: 1px solid #1f2937;

            margin: 20px auto;

        }
.container card{

            width: 70%;

            max-width: 500px;

            border-radius: 10px;

            margin-bottom: 20px;


        }

        .container img {

            width: 70%;
            max-width: 500px;
            border-radius: 10px;

            margin-bottom: 20px;

            border: 2px solid #264d73;

        }

        .container h1 {

            font-size: 28px;

            margin-bottom: 10px;

            color: #42a5f5;

        }

        .container .meta {

            font-size: 14px;

            color: #c7d3dd;

            margin-bottom: 20px;

        }

        .container .meta span {

            display: inline-block;

            margin-right: 15px;

            background: #1e293b;

            padding: 5px 10px;

            border-radius: 5px;

            border: 1px solid #264d73;

        }

        .container .buttons button {

            background-color: #1e88e5;

            border: none;

            color: #ffffff;

            padding: 10px 20px;

            border-radius: 20px;

            cursor: pointer;

            margin: 10px 5px;

            transition: background-color 0.3s ease;

        }

        .container .buttons button:hover {

            background-color: #1565c0;

        }

        .container .description {

            max-height: 150px;

            overflow-y: auto;

            background: #1e293b;

            padding: 15px;

            border-radius: 10px;

            margin-bottom: 20px;

            text-align: left;

            font-size: 14px;

            line-height: 1.6;

            border: 1px solid #264d73;

        }

        .container .description::-webkit-scrollbar {

            width: 8px;

        }

        .container .description::-webkit-scrollbar-thumb {

            background-color: #264d73;

            border-radius: 10px;

        }

        .container .extra-meta {

            font-size: 14px;

            color: #c7d3dd;

            margin-top: 20px;

            text-align: left;

        }

        .container .extra-meta span {

            display: block;

            margin-bottom: 5px;

            padding: 5px 0;

        }

        .container .extra-meta span strong {

            color: #42a5f5;

        }

    </style>

</head>

<body>

    <div class="container">

        <?php if ($anime && isset($anime['title'])): ?>

            <!-- Cover Image -->

            <div class="card">

                <img src="<?= htmlspecialchars($anime['coverImage']['extraLarge'] ?? '') ?>" alt="<?= htmlspecialchars($anime['title']['romaji'] ?? '') ?>">

            </div>

            

            <!-- Title -->

            <h1><?= htmlspecialchars($anime['title']['romaji'] ?? 'Unknown Title') ?></h1>

            <h2><?= htmlspecialchars($anime['title']['english'] ?? '') ?></h2>

            <h3><?= htmlspecialchars($anime['title']['native'] ?? '') ?></h3>

            <!-- Meta Details -->

            <div class="meta">

                <span>Type: <?= htmlspecialchars($anime['type'] ?? 'N/A') ?></span>

                <span>Episodes: <?= htmlspecialchars($anime['episodes'] ?? 'N/A') ?></span>

                <span>Season: <?= htmlspecialchars($anime['season'] ?? 'N/A') ?> <?= htmlspecialchars($anime['seasonYear'] ?? 'N/A') ?></span>

                <span>Status: <?= htmlspecialchars($anime['status'] ?? 'N/A') ?></span>

            </div>

            <!-- Buttons -->

            <div class="buttons">

                <button>Watch Now</button>

                <button>Add to List</button>

            </div>

            <!-- Description -->

            <div class="description">

                <?= htmlspecialchars(strip_tags($anime['description'] ?? 'Description not available')) ?>

            </div>

            <!-- Additional Data -->

            <div class="extra-meta">

                <span><strong>Start Date:</strong> <?= htmlspecialchars($anime['startDate']['year'] ?? 'N/A') ?>-<?= htmlspecialchars($anime['startDate']['month'] ?? '00') ?>-<?= htmlspecialchars($anime['startDate']['day'] ?? '00') ?></span>

                <span><strong>End Date:</strong> <?= htmlspecialchars($anime['endDate']['year'] ?? 'N/A') ?>-<?= htmlspecialchars($anime['endDate']['month'] ?? '00') ?>-<?= htmlspecialchars($anime['endDate']['day'] ?? '00') ?></span>

                <span><strong>Genres:</strong> <?= htmlspecialchars(implode(', ', $anime['genres'] ?? [])) ?></span>

                <span><strong>Average Score:</strong> <?= htmlspecialchars($anime['averageScore'] ?? 'N/A') ?></span>

            </div>

        <?php else: ?>

            <p>Anime details not found.</p>

        <?php endif; ?>

    </div>

</body>

</html>

