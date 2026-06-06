<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #89CFF0, #4682B4); /* Light to dark blue gradient */
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            text-align: center;
            max-width: 600px;
        }
        h1 {
            font-size: 96px;
            margin: 0;
            color: #ffffff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }
        p {
            font-size: 20px;
            margin: 20px 0;
            color: #e0f7fa;
        }
        a {
            text-decoration: none;
            font-size: 18px;
            background: #5DADE2;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            transition: background 0.3s ease;
        }
        a:hover {
            background: #3498DB;
        }
        img {
            max-width: 70%;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Uh-oh! This page has disappeared into the blue sky...</p>
        <img src="/lost_girl.png" alt="Lost Anime Character">
        <p>Let’s get you back to safety.</p>
        <a href="/">Return to Homepage</a>
    </div>

    <!-- Background Music -->
    <audio autoplay loop>
        <source src="/audio/soothing-anime-music.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</body>
</html>
