<?php
// Include the configuration file
include('_config.php');

// Check if the 'id' parameter exists in the query string
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the 'id' from the query string

    // Updated API endpoint with the provided ID
    $apiUrl = "https://api.hipanime.ct.ws/getEpisode/$id";

    // Initialize a cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $apiUrl); // Set the API URL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Set content type to JSON
    ]);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for errors in the cURL request
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
        curl_close($curl);
        exit;
    }

    // Close the cURL session
    curl_close($curl);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if decoding was successful and if 'video' exists
    if (isset($data['video'])) {
        $videoLink = $data['video'];

        // Output the HTML structure with embedded video
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Video Player</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    overflow: hidden; /* Prevent scrollbars on the body */
                }
                iframe {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: none; /* Remove borders */
                }
            </style>
        </head>
        <body>
            <iframe src='$videoLink' allowfullscreen></iframe>
        </body>
        </html>";
    } else {
        echo "Error: Unable to fetch video link from API response.";
    }
} else {
    echo "Error: 'id' parameter is missing in the query string.";
}
?>
