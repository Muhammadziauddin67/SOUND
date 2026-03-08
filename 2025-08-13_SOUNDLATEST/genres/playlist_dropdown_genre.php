<?php
require '../dbconnection.php';

if (!isset($_GET['song_id'])) {
    echo "No song selected.";
    exit;
}

$song_id = intval($_GET['song_id']);
$result = $con->query("SELECT * FROM playlists");

echo '<form action="playlist_action_genre.php" method="POST">';
echo '<input type="hidden" name="song_id" value="'.$song_id.'">';
echo '<label>Select Playlist:</label><br>';
echo '<select name="playlist_id" required style="width:100%;padding:8px;">';
echo '<option value="">-- Select Playlist --</option>';
while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['playlist_id'].'">';
    echo '🎵 ' . $row['playlist_name'];
    echo '</option>';
}
echo '</select><br><br>';
echo '<button type="submit" style="padding:10px 20px;">Add to Playlist</button>';
echo '</form>';
?>

