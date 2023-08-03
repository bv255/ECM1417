<?php
// Get the POST data
$data = file_get_contents('php://input');

// Check if any data was received
if (!$data) {
    http_response_code(400); // Bad Request
    exit();
}

// Decode the JSON data received
$scoreData = json_decode($data, true);

// Check if the JSON data is valid
if (!$scoreData || !isset($scoreData['score'])) {
    http_response_code(400); // Bad Request
    exit();
}

// Read existing leaderboard data from the file (if any)
$leaderboardFile = './leaderboard.json';
$leaderboard = [];
if (file_exists($leaderboardFile)) {
    $leaderboard = json_decode(file_get_contents($leaderboardFile), true);
}

// Add the new score to the leaderboard data
$leaderboard[] = ['username' => $scoreData['username'] ,'score' => $scoreData['score']];

// Sort the leaderboard based on scores (highest to lowest)
usort($leaderboard, function ($a, $b) {
    return $b['score'] - $a['score'];
});

// Limit the leaderboard to, for example, the top 10 scores (optional)
$leaderboard = array_slice($leaderboard, 0, 10);

// Save the updated leaderboard back to the file
file_put_contents($leaderboardFile, json_encode($leaderboard, JSON_PRETTY_PRINT));

// Send a success response
http_response_code(200); // OK
?>