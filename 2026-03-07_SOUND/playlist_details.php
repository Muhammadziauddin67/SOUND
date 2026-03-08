<?php
session_start(); // <-- KEEP THIS ONE (Line 2)
?>
<?php
include ('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Playlist Details</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
     <!-- Including jQuery is required. -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <style>
        /* Basic styling for draggable list */
        #sortable-songs { list-style-type: none; margin: 0; padding: 0; width: 100%; }
        #sortable-songs li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 50px; background: #f9f9f9; border: 1px solid #ddd; display: flex; align-items: center; justify-content: space-between;}
        #sortable-songs li i.handle { cursor: grab; margin-right: 10px; }
        .song-details-in-queue { flex-grow: 1; }
        .remove-song-btn { margin-left: 10px; cursor: pointer; color: red; }
        .playlist-playback-controls button { margin-right: 10px; }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <?php include('sidebar.php'); ?>
    <?php include('Chatbot/chat.php'); ?>
           <div class="main-container-playlist-details">
        <?php

        $playlistId = $_GET['playlist_id'] ?? null;
        $playlistName = "Playlist Not Found";
        $playlistCover = "assets/default-playlist.PNG";
        $songsInPlaylist = [];

        if (!isset($_SESSION['user_id'])) {
            echo "<p>Please log in to view playlist details.</p>";
        } elseif (!$playlistId) {
            echo "<p>Invalid playlist ID.</p>";
        } else {
            $userId = $_SESSION['user_id'];

            // Fetch playlist details
            $playlistStmt = $con->prepare("SELECT playlist_name, cover_image_path FROM playlists WHERE playlist_id = ? AND user_id = ?");
            $playlistStmt->bind_param("ii", $playlistId, $userId);
            $playlistStmt->execute();
            $playlistResult = $playlistStmt->get_result();
            if ($playlistRow = $playlistResult->fetch_assoc()) {
                $playlistName = htmlspecialchars($playlistRow['playlist_name']);
                $playlistCover = !empty($playlistRow['cover_image_path']) ? htmlspecialchars($playlistRow['cover_image_path']) : 'assets/default-playlist.PNG';
            }
            $playlistStmt->close();

            // Fetch songs in the playlist
            $songsStmt = $con->prepare("SELECT ps.song_id, ps.song_order, sd.song_title, sd.artist_name, sd.img_path, sd.audio_path, sd.youtube_url
                                        FROM playlist_songs ps
                                        JOIN songs_data sd ON ps.song_id = sd.song_id
                                        WHERE ps.playlist_id = ? ORDER BY ps.song_order ASC");
            $songsStmt->bind_param("i", $playlistId);
            $songsStmt->execute();
            $songsResult = $songsStmt->get_result();
            while ($row = $songsResult->fetch_assoc()) {
                $songsInPlaylist[] = $row;
            }
            $songsStmt->close();
        }
        $con->close();
        ?>

        <div class="playlist-header" style="display: flex; align-items: center; margin-bottom: 20px;">
            <img src="<?php echo $playlistCover; ?>" alt="<?php echo $playlistName; ?> Cover" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; margin-right: 20px;">
            <div>
                <h2><?php echo $playlistName; ?></h2>
                <p>Total Songs: <?php echo count($songsInPlaylist); ?></p>
                <div class="playlist-playback-controls">
                    <button id="playAllBtn" class="btn btn-success"><i class="fas fa-play"></i> Play All</button>
                    <button id="toggleReplayBtn" class="btn btn-secondary"><i class="fas fa-redo-alt"></i> Toggle Replay</button>
                </div>
            </div>
        </div>

        <h3>Song Queue</h3>
        <?php if (empty($songsInPlaylist)): ?>
            <p>No songs in this playlist yet. Add some from the home page!</p>
        <?php else: ?>
            <ul id="sortable-songs">
                <?php foreach ($songsInPlaylist as $song): ?>
                    <li data-song-id="<?php echo $song['song_id']; ?>" data-song-order="<?php echo $song['song_order']; ?>"
                        data-audio="<?php echo htmlspecialchars($song['audio_path']); ?>"
                        data-title="<?php echo htmlspecialchars($song['song_title']); ?>"
                        data-artist="<?php echo htmlspecialchars($song['artist_name']); ?>"
                        data-image="<?php echo htmlspecialchars($song['img_path']); ?>"
                        data-video="<?php echo htmlspecialchars($song['youtube_url']); ?>">
                        <i class="fas fa-grip-vertical handle"></i>
                        <img src="<?php echo htmlspecialchars($song['img_path']); ?>" alt="Song Image" style="width: 40px; height: 40px; margin-right: 10px; border-radius: 4px;">
                        <div class="song-details-in-queue">
                            <strong><?php echo htmlspecialchars($song['song_title']); ?></strong> - <?php echo htmlspecialchars($song['artist_name']); ?>
                        </div>
                        <button class="play-single-song-btn" data-song-id="<?php echo $song['song_id']; ?>"><i class="fas fa-play"></i></button>
                        <button class="remove-song-btn" data-song-id="<?php echo $song['song_id']; ?>"><i class="fas fa-trash"></i></button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
                </div>


    <?php include('music_bar.php'); ?>
    <script src="script2.js?v=<?php echo time(); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const playlistId = <?php echo json_encode($playlistId); ?>;
            const sortableList = $('#sortable-songs');
            const playAllBtn = document.getElementById('playAllBtn');
            const toggleReplayBtn = document.getElementById('toggleReplayBtn');
            let replayMode = false; // Initial state

            // Make songs sortable
            if (sortableList.length) { // Check if the element exists
                sortableList.sortable({
                    handle: '.handle',
                    axis: 'y',
                    update: function(event, ui) {
                        const newOrder = $(this).sortable('toArray', {attribute: 'data-song-id'});
                        updateSongOrder(newOrder, playlistId);
                    }
                });
                sortableList.disableSelection(); // Prevents text selection during drag
            }

            // Update song order in database
            function updateSongOrder(newOrder, playlistId) {
                fetch('update_song_order.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ playlist_id: playlistId, song_ids: newOrder })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Song order updated successfully.');
                    } else {
                        console.error('Error updating song order:', data.message);
                    }
                })
                .catch(error => console.error('Network error updating song order:', error));
            }

            // Remove song from playlist
            document.querySelectorAll('.remove-song-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const songId = this.dataset.songId;
                    if (confirm('Are you sure you want to remove this song from the playlist?')) {
                        removeSongFromPlaylist(playlistId, songId, this.closest('li'));
                    }
                });
            });

            function removeSongFromPlaylist(playlistId, songId, listItem) {
                fetch('remove_song_from_playlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `playlist_id=${playlistId}&song_id=${songId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        listItem.remove(); // Remove from UI
                        // You might need to re-index songList in the music bar if currently playing from this playlist
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error removing song:', error));
            }

            // Play single song from queue
            document.querySelectorAll('.play-single-song-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const listItem = this.closest('li');
                    const audioUrl = listItem.dataset.audio;
                    const title = listItem.dataset.title;
                    const artist = listItem.dataset.artist;
                    const image = listItem.dataset.image;
                    const video = listItem.dataset.video;
                    const songId = listItem.dataset.songId;

                    // This calls the global playSong function (from script2.js)
                    // Make sure that function can accept these parameters and updates the music bar.
                    // It's crucial to correctly initialize `songList` in script2.js if you want full control.
                    window.playSong(songId, audioUrl, title, artist, image); // Using the global playSong

                    // Set the music bar's internal song list to this playlist for accurate next/prev
                    updateMusicBarSongList(Array.from(sortableList.children).map(li => ({
                        audioUrl: li.dataset.audio,
                        songTitle: li.dataset.title,
                        songArtist: li.dataset.artist,
                        songImg: li.dataset.image,
                        videoUrl: li.dataset.video,
                        button: null // Not a specific play button element, adjust if needed
                    })), Array.from(sortableList.children).indexOf(listItem));
                });
            });

            // "Play All" button functionality
            if (playAllBtn) {
                playAllBtn.addEventListener('click', () => {
                    const songs = Array.from(sortableList.children).map(li => ({
                        audioUrl: li.dataset.audio,
                        songTitle: li.dataset.title,
                        songArtist: li.dataset.artist,
                        songImg: li.dataset.image,
                        videoUrl: li.dataset.video,
                        button: null // No specific button to highlight for "Play All"
                    }));

                    if (songs.length > 0) {
                        // Pass the playlist's songs to the music bar's global control
                        updateMusicBarSongList(songs, 0); // Start from the first song (index 0)
                        window.playSong(songs[0].songId, songs[0].audioUrl, songs[0].songTitle, songs[0].songArtist, songs[0].songImg);
                    } else {
                        alert('This playlist is empty. Add some songs first!');
                    }
                });
            }

            // Toggle Replay Button
            if (toggleReplayBtn) {
                toggleReplayBtn.addEventListener('click', () => {
                    replayMode = !replayMode;
                    toggleReplayBtn.classList.toggle('active', replayMode); // Add/remove an 'active' class for styling
                    toggleReplayBtn.innerHTML = replayMode ? '<i class="fas fa-redo-alt"></i> Replay ON' : '<i class="fas fa-redo-alt"></i> Toggle Replay';
                    // Update global music player's replay state
                    if (window.setReplayMode) { // Assuming you add a function to script2.js
                        window.setReplayMode(replayMode);
                    }
                    alert(`Playlist Replay Mode: ${replayMode ? 'ON' : 'OFF'}`);
                });
            }

            // Function to update the music bar's internal song list and current index
            // This needs to be exposed globally from script2.js or passed explicitly.
            function updateMusicBarSongList(newSongList, startIndex) {
                if (window.setMusicBarPlaylist) { // Assuming setMusicBarPlaylist is exposed in script2.js
                    window.setMusicBarPlaylist(newSongList, startIndex);
                } else {
                    console.warn("setMusicBarPlaylist function not found in global scope. Music bar playback might not be fully controlled.");
                    // Fallback for direct audio player control if needed
                    const audioPlayer = document.getElementById("audio-player");
                    const playPauseIcon = document.getElementById("playPauseIcon");
                    if (audioPlayer && playPauseIcon && newSongList.length > 0) {
                        audioPlayer.src = newSongList[startIndex].audioUrl;
                        audioPlayer.load();
                        audioPlayer.play().catch(e => console.error("Playback failed:", e));
                        document.getElementById("current-song").innerText = newSongList[startIndex].songTitle;
                        document.getElementById("current-artist").innerText = newSongList[startIndex].songArtist;
                        document.getElementById("song-image").src = newSongList[startIndex].songImg;
                        playPauseIcon.classList.replace("fa-play", "fa-pause");
                    }
                }
            }
        });
    </script>
</body>
</html>