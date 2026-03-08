<?php
require '../dbconnection.php';
require '../Gemini/gemini.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$userQuestion = strtolower(trim($input['message'] ?? ''));

$genres = ['romantic', 'relaxing', 'sad', 'happy', 'instrumental', 'party', 'alternative', 'pop', 'punk', 'rap', 'jazz'];
$genre = null;

$artists = ['arijit singh', 'atif aslam', 'the weeknd', 'taylor swift', 'shreya ghoshal', 'ali zafar', 'dua lipa'];
$matchedArtist = null;
foreach ($artists as $artist) {
    if (strpos($userQuestion, strtolower($artist)) !== false) {
        $matchedArtist = $artist;
        break;
    }
}

foreach ($genres as $g) {
    if (strpos($userQuestion, strtolower($g)) !== false) {
        $genre = $g;
        break;
    }
}

$songs = [];
if ($matchedArtist) {
    $songsText = "Here are some songs by $matchedArtist:\n";
    $stmt = $con->prepare("SELECT song_id, song_title, artist_name FROM songs_data WHERE artist_name LIKE ?");
    $like = "%$matchedArtist%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
        $songsText .= "- 🎵 '{$row['song_title']}' by {$row['artist_name']}\n";
    }
    $stmt->close();
} elseif ($genre) {
    $songsText = "Here are some $genre songs:\n";
    $stmt = $con->prepare("SELECT song_id, song_title, artist_name FROM songs_data WHERE genre LIKE ?");
    $like = "%$genre%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
        $songsText .= "- 🎵 '{$row['song_title']}' by {$row['artist_name']}\n";
    }
    $stmt->close();
} else {
    $songsText = "Here are some random songs:\n";
    $result = $con->query("SELECT song_id, song_title, artist_name FROM songs_data ORDER BY RAND() LIMIT 5");
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
        $songsText .= "- 🎵 '{$row['song_title']}' by {$row['artist_name']}\n";
    }
}

$prompt = <<<EOD
User asked: "$userQuestion"

$songsText

You are MusicBot. Suggest or recommend songs or artists based only on this list above. Keep it short and friendly.
EOD;

$reply = generateDescription($prompt);

// take first song for button link
$song_link = null;
if (!empty($songs)) {
    $firstSong = $songs[0]; 
    $song_link = "http://localhost:82/SOUND%20LATEST/newsongs.php?song_id=" . $firstSong['song_id'];
}

echo json_encode([
    'response' => $reply,
    'song_link' => $song_link
]);
?>
