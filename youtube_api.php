<?php
header('Content-Type: application/json');

if (!isset($_GET['url'])) {
    echo json_encode(["error" => "No URL provided"]);
    exit;
}

$youtube_url = escapeshellarg($_GET['url']);

// Get Video URL
$video_command = "/opt/homebrew/bin/yt-dlp -f best --get-url $youtube_url 2>/dev/null";
$video_url = shell_exec($video_command);
$video_url = $video_url ? trim($video_url) : null;

// Get Audio URL
$audio_command = "/opt/homebrew/bin/yt-dlp -f bestaudio --get-url $youtube_url 2>/dev/null";
$audio_url = shell_exec($audio_command);
$audio_url = $audio_url ? trim($audio_url) : null;

// Response JSON
$response = [
    "video_url" => $video_url,
    "audio_url" => $audio_url
];

echo json_encode($response);
?>
