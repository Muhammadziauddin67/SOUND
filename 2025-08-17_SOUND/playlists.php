<?php
session_start();
include('dbconnection.php'); // Your database connection

// Ensure no output happens before session_start()
// The "Please log in to view your playlists." message should now be dynamic
// and appear only if the user is not logged in after session starts.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Playlists</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>
<style>
    /* Styles for Playlist Cover Images */
.playlist-card {
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-bottom: 20px;
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
}

.playlist-card:hover {
    transform: translateY(-5px);
}

.playlist-card a {
    text-decoration: none;
    /* color: inherit; - Removed specific color, will inherit */
}

.playlist-cover-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 10px;
}

.playlist-card h5 {
    font-size: 1.1em;
    margin-top: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Styles for the options icon */
.playlist-card-options {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10;
}

.playlist-options-icon {
    cursor: pointer;
    font-size: 1.2em;
    padding: 5px;
}

.playlist-options-menu {
    position: absolute;
    top: 30px;
    right: 0;
    /* background-color: unset; - Removed specific color, will inherit or be transparent */
    border: 1px solid; /* Border will use inherited or default color */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    min-width: 120px;
    z-index: 100;
    display: flex;
    flex-direction: column;
}

.playlist-options-menu a {
    padding: 8px 12px;
    text-decoration: none;
    display: block;
}

/* No playlists message */
#noPlaylistsMessage {
    text-align: center;
    margin-top: 30px;
    font-size: 1.1em;
}
</style>
<body>
    <?php include('navbar.php'); // Include your navbar ?>
    <?php include('sidebar.php'); // Include your sidebar ?>
    <?php include('Chatbot/chat.php'); ?>
    <div class="main-container">
        <h2>My Playlists</h2>
        <button id="createNewPlaylistBtn" class="btn btn-primary mb-3">Create New Playlist</button>
        <div id="playlistsContainer" class="row">
            <?php
            // The session_start() and dbconnection.php include calls from here are moved to the top.
            // Remove them from here to avoid redundancy and the "headers already sent" error.

            if (!isset($_SESSION['user_id'])) {
                echo "<p>Please log in to view your playlists.</p>";
            } else {
                $userId = $_SESSION['user_id'];
                $playlistsQuery = $con->prepare("SELECT p.playlist_id, p.playlist_name, p.cover_image_path,
                                                    (SELECT sd.img_path FROM playlist_songs ps JOIN songs_data sd ON ps.song_id = sd.song_id WHERE ps.playlist_id = p.playlist_id ORDER BY ps.added_at DESC LIMIT 1) AS last_song_image
                                                    FROM playlists p
                                                    WHERE p.user_id = ? ORDER BY p.created_at DESC");
                $playlistsQuery->bind_param("i", $userId);
                $playlistsQuery->execute();
                $playlistsResult = $playlistsQuery->get_result();

                if ($playlistsResult->num_rows > 0) {
                    while ($playlist = $playlistsResult->fetch_assoc()) {
                        $imagePath = !empty($playlist['cover_image_path']) ? $playlist['cover_image_path'] : ($playlist['last_song_image'] ?: 'assets/default-playlist.PNG');
                        ?>
                        <div class="col-md-3 mb-4">
                            <div class="playlist-card" data-playlist-id="<?php echo $playlist['playlist_id']; ?>">
                                <a href="playlist_details.php?playlist_id=<?php echo $playlist['playlist_id']; ?>">
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $playlist['playlist_name']; ?> Cover" class="playlist-cover-image">
                                    <h5><?php echo $playlist['playlist_name']; ?></h5>
                                </a>
                                <div class="playlist-card-options">
                                    <i class="fas fa-ellipsis-v playlist-options-icon"></i>
                                    <div class="playlist-options-menu" style="display: none;">
                                        <a href="#" class="edit-playlist-btn">Edit Name</a>
                                        <a href="#" class="change-cover-btn">Change Cover</a>
                                        <a href="#" class="delete-playlist-btn">Delete Playlist</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><p id="noPlaylistsMessage">No playlists added yet. Create one to get started! 🎶</p></div>';
                }
                $playlistsQuery->close();
            }
            $con->close();
            ?>
        </div>
    </div>

    <div id="createPlaylistModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h4>Create New Playlist</h4>
            <input type="text" id="newPlaylistName" placeholder="Playlist Name">
            <button id="submitCreatePlaylist">Create</button>
        </div>
    </div>

    <div id="editPlaylistModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h4>Edit Playlist</h4>
            <input type="hidden" id="editPlaylistId">
            <input type="text" id="editPlaylistName" placeholder="New Playlist Name">
            <button id="submitEditPlaylist">Save</button>
        </div>
    </div>

    <div id="changeCoverModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h4>Change Playlist Cover</h4>
            <input type="hidden" id="changeCoverPlaylistId">
            <input type="file" id="coverImageUpload" accept="image/*">
            <p>OR</p>
            <input type="text" id="coverImageUrl" placeholder="Image URL">
            <button id="submitChangeCover">Upload/Set Cover</button>
        </div>
    </div>

    <?php include('music_bar.php'); // Include your music bar, ensure path is correct! ?>
    <script src="script2.js"></script>
    <script>
        // Additional JavaScript for playlists page
        document.addEventListener('DOMContentLoaded', () => {
            const createNewPlaylistBtn = document.getElementById('createNewPlaylistBtn');
            const createPlaylistModal = document.getElementById('createPlaylistModal');
            const newPlaylistNameInput = document.getElementById('newPlaylistName');
            const submitCreatePlaylistBtn = document.getElementById('submitCreatePlaylist');
            const noPlaylistsMessage = document.getElementById('noPlaylistsMessage');

            createNewPlaylistBtn.addEventListener('click', () => {
                createPlaylistModal.style.display = 'block';
            });

            submitCreatePlaylistBtn.addEventListener('click', () => {
                const playlistName = newPlaylistNameInput.value.trim();
                if (playlistName) {
                    fetch('create_playlist.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `playlist_name=${encodeURIComponent(playlistName)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            createPlaylistModal.style.display = 'none';
                            newPlaylistNameInput.value = '';
                            // Optionally, dynamically add the new playlist card or refresh the page
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error creating playlist:', error));
                } else {
                    alert('Please enter a playlist name.');
                }
            });

            // Close modals
            document.querySelectorAll('.close-modal').forEach(closeBtn => {
                closeBtn.addEventListener('click', function() {
                    this.closest('.modal').style.display = 'none';
                });
            });

            window.addEventListener('click', function(event) {
                if (event.target === createPlaylistModal) {
                    createPlaylistModal.style.display = 'none';
                }
                // Add similar logic for other modals
            });

            // Playlist card options menu
            document.querySelectorAll('.playlist-options-icon').forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const menu = this.nextElementSibling;
                    document.querySelectorAll('.playlist-options-menu').forEach(m => {
                        if (m !== menu) m.style.display = 'none';
                    });
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';

                    const playlistCard = this.closest('.playlist-card');
                    const playlistId = playlistCard.dataset.playlistId;

                    // Attach event listeners to menu options
                    playlistCard.querySelector('.edit-playlist-btn').onclick = (e) => {
                        e.preventDefault();
                        const currentName = playlistCard.querySelector('h5').textContent;
                        document.getElementById('editPlaylistId').value = playlistId;
                        document.getElementById('editPlaylistName').value = currentName;
                        document.getElementById('editPlaylistModal').style.display = 'block';
                        menu.style.display = 'none';
                    };

                    playlistCard.querySelector('.change-cover-btn').onclick = (e) => {
                        e.preventDefault();
                        document.getElementById('changeCoverPlaylistId').value = playlistId;
                        document.getElementById('changeCoverModal').style.display = 'block';
                        menu.style.display = 'none';
                    };

                    playlistCard.querySelector('.delete-playlist-btn').onclick = (e) => {
                        e.preventDefault();
                        if (confirm('Are you sure you want to delete this playlist? This action cannot be undone.')) {
                            deletePlaylist(playlistId);
                        }
                        menu.style.display = 'none';
                    };
                });
            });

            // Submit Edit Playlist Name
            document.getElementById('submitEditPlaylist').addEventListener('click', () => {
                const playlistId = document.getElementById('editPlaylistId').value;
                const newName = document.getElementById('editPlaylistName').value.trim();
                if (newName) {
                    fetch('edit_playlist.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `playlist_id=${playlistId}&playlist_name=${encodeURIComponent(newName)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.success) {
                            location.reload();
                        }
                        document.getElementById('editPlaylistModal').style.display = 'none';
                    })
                    .catch(error => console.error('Error editing playlist:', error));
                } else {
                    alert('Playlist name cannot be empty.');
                }
            });

            // Submit Change Cover
            document.getElementById('submitChangeCover').addEventListener('click', () => {
                const playlistId = document.getElementById('changeCoverPlaylistId').value;
                const fileInput = document.getElementById('coverImageUpload');
                const imageUrl = document.getElementById('coverImageUrl').value.trim();
                const formData = new FormData();
                formData.append('playlist_id', playlistId);

                if (fileInput.files.length > 0) {
                    formData.append('cover_image', fileInput.files[0]);
                } else if (imageUrl) {
                    formData.append('cover_image_url', imageUrl);
                } else {
                    alert('Please select an image file or enter an image URL.');
                    return;
                }

                fetch('change_playlist_cover.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                    document.getElementById('changeCoverModal').style.display = 'none';
                })
                .catch(error => console.error('Error changing cover:', error));
            });

            function deletePlaylist(playlistId) {
                fetch('delete_playlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `playlist_id=${playlistId}`
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error deleting playlist:', error));
            }

            // Close all dropdowns when clicking anywhere outside
            document.addEventListener('click', (event) => {
                document.querySelectorAll('.playlist-options-menu').forEach(menu => {
                    if (!menu.contains(event.target) && !event.target.classList.contains('playlist-options-icon')) {
                        menu.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>