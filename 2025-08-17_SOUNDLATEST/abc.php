<?php
$directory = 'assets/songs/image/'; // Specify the directory containing the songs
$songs = glob($directory . '*.jpeg'); // Get all .mp3 files in the directory

foreach ($songs as $song) {
    $songName = basename($song, '.jpeg'); // Get the song name without the extension
    echo "$directory$songName.jpeg<br>"; // Output the full path with .mp3 extension
}

?>









<?php
// Assume $con is your database connection
$sql = "SELECT * FROM songsdata";
$result = $con->query($sql);
?>

<div class="featured-container">
    <h3 class="featured-heading">Featured Songs</h3>
    <div class="featured-songs">
        <div class="song-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data for each song
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="song-bar">
                        <img src="<?php echo $row["img_path"]; ?>" alt="Song Image" class="song-image">
                        <div class="song-details">
                            <span class="song-name"><?php echo $row["title"]; ?></span>
                            <span class="artist-name"><?php echo $row["artist"]; ?></span>
                        </div>
                        <a href="play_song.php?song_id=<?php echo $row['id']; ?>" class="play-icon" 
                        data-audio="<?php echo $row['audio_url']; ?>" 
            data-title="<?php echo $row['title']; ?>" 
            data-artist="<?php echo $row['artist']; ?>" 
            data-image="<?php echo $row['img_path']; ?>"
            data-video="<?php echo $row['video_url']; ?>">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No songs found.</p>";
            }
            ?>
        </div>
    </div>
</div>
