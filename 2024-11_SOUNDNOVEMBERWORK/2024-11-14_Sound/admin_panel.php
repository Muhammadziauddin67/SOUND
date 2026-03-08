<?php
include ('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sound</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Chart.js -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
 
</head>
<style>
    body, html {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #1f1b24;
    color: #e0e0e0;
}

#wrapper {
    display: flex;
}

/* Sidebar styling */
#sidebar-wrapper {
    min-width: 250px;
    max-width: 250px;
    background-color: #343a40;
    color: white;
    transition: all 0.3s;
    height: 100vh;
    position: relative;
}

#sidebar-wrapper .sidebar-heading {
    font-size: 1.5rem;
    padding: 1rem;
    text-align: center;
    background-color: #6f42c1;
}

#sidebar-wrapper .nav-link {
    padding: 0.75rem 1rem;
    font-size: 1rem;
    color: white;
    display: block;
}

#sidebar-wrapper .nav-link:hover {
    background-color: #495057;
    color: #ffffff;
}

/* Logout Button */
#sidebar-wrapper .nav-link.position-absolute.bottom-0 {
    background-color: #6f42c1;
}

/* Page content */
#page-content-wrapper {
    flex: 1;
    padding-left: 20px;
}

.section-content {
    display: none;
}

.section-content.active {
    display: block;
}

/* Chart styles */
.card {
    border: none;
    border-radius: 8px;
    transition: transform 0.2s;
}

@media (max-width: 768px) {
    #sidebar-wrapper {
        min-width: 0;
        max-width: 0;
        overflow-x: hidden;
    }

    #sidebar-wrapper.toggled {
        min-width: 250px;
        max-width: 250px;
    }

    #menu-toggle {
        display: inline-block;
        background-color: #6f42c1;
        color: #e0e0e0;
    }
}
button{
    background-color: #6f42c1;
    color: #ffffff;
}
button:hover{
    background-color: #8d78b4;
  
}
</style>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-right bg-dark position-relative" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">Admin Panel</div>
            <nav class="nav flex-column">
                <a href="#" class="nav-link text-white" onclick="showSection('dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" class="nav-link text-white" onclick="showSection('manage-users')">
                    <i class="fas fa-users"></i> Manage Users
                </a>
                <a href="#" class="nav-link text-white" onclick="showSection('manage-music')">
                    <i class="fas fa-music"></i> Manage Music
                </a>
                <a href="#" class="nav-link text-white" onclick="showSection('manage-categories')">
                    <i class="fas fa-list-alt"></i> Manage Categories
                </a>
            </nav>
            <a href="index.php" class="nav-link text-white position-absolute bottom-0 w-100 text-center">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
                <button class="btn d-lg-none" id="menu-toggle">Toggle Menu</button>
            </nav>

            <div class="container-fluid mt-4">
                <!-- Dashboard Section -->
                <section id="dashboard" class="section-content active">
                    <h2>Dashboard</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <canvas id="musicChart" height="200"></canvas>
                        </div>
                        <div class="col-md-4">
                            <canvas id="userGrowthChart" height="200"></canvas>
                        </div>
                        <div class="col-md-3">
                            <canvas id="languageChart" height="200"></canvas>
                        </div>
                    </div>
                </section>

                <section id="manage-music" class="section-content">
    <h2>Manage Music</h2>
<!-- Add Song Form --> 
<form id="addSongForm" class="mb-4" method="POST" action="add_song.php" enctype="multipart/form-data">
    <h4>Add Song</h4>
    <input type="text" class="form-control mb-2" placeholder="Song Title" name="song_title" required>
    <input type="text" class="form-control mb-2" placeholder="Artist Name" name="artist_name" required>

    <!-- File upload for image -->
    <input type="file" class="form-control mb-2" name="img_file" accept="image/*" required>
    <!-- File upload for audio -->
    <input type="file" class="form-control mb-2" name="audio_file" accept="audio/*">

    <input type="url" class="form-control mb-2" placeholder="YouTube URL" name="youtube_url">
    <input type="text" class="form-control mb-2" placeholder="Genre" name="genre" required>
    <button type="submit" class="btn btn-primary">Add Song</button>
</form>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Song Title</th>
                <th>Artist</th>
                <th>Youtube Url</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch song data from the database
            $sql = "SELECT * FROM songs_data"; // Replace with your actual songs table
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["song_id"]; ?></td>
                        <td><?php echo $row["song_title"]; ?></td>
                        <td><?php echo $row["artist_name"]; ?></td>
                        <td><?php echo $row["youtube_url"]; ?></td>
                        <td><?php echo $row["genre"]; ?></td>
                        <td>
                            <a href="delete_song.php?id=<?php echo $row['song_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this song?');">Delete</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No songs found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

                


                <section id="manage-categories" class="section-content">
                    <h2>Manage Categories</h2>
                    
                     <!-- Add Artist Form -->
                     <form id="addArtistForm" method="POST" class="mb-4" action="add_artist.php">
    <h4>Add Artist</h4>
    <input type="text" class="form-control mb-2" placeholder="Artist Name" name="artist_name" required>
    <input type="text" class="form-control mb-2" placeholder="assets/artists/(artist language)/artist-img.png" name="img_path" required>
    <input type="text" class="form-control mb-2" placeholder="artistlinkpages/artist-page.php" name="artist_link_page">
    <input type="text" class="form-control mb-2" placeholder="albumlinkpages/album-page.php" name="album_link_page">
    <input type="date" class="form-control mb-2" placeholder="Album Release Year" name="album_release_year" min="1900" max="2099">
    <button type="submit" class="btn btn-primary">Add Artist</button>
</form>

                
                    <!-- Add Album Form -->
                    <form id="addAlbumForm" class="mb-4" method="POST" action="add_album.php">
    <h4>Add Album</h4>
    <input type="text" class="form-control mb-2" placeholder="Album Name" name="album_name" required>
    <input type="text" class="form-control mb-2" placeholder="Artist Name" name="artist_name" required>
    <input type="text" class="form-control mb-2" placeholder="assets/albums/album-img.png" name="img_path" required>
    <input type="number" class="form-control mb-2" placeholder="Rating" name="rating" min="0" max="5">
    <input type="date" class="form-control mb-2" placeholder="Release Year" name="release_year" min="1900" max="2099">
    <input type="text" class="form-control mb-2" placeholder="albumlinkpages/album-page.php" name="album_link_page">
    <button type="submit" class="btn btn-primary">Add Album</button>
</form>

                </section>
                

                <section id="manage-users" class="section-content active">
    <h2>Manage Users</h2>
    <!-- Button to trigger Add User Modal -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="fas fa-user-plus"></i> Add New User
</button>

    <!-- User Table -->
        <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch user data from the database
                        $sql = "SELECT * FROM users";
                        $result = $con->query($sql);

                        
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row["user_id"]; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <td><?php echo $row["role"]; ?></td>
                                    <td><?php echo $row["address"]; ?></td>
                                    <td><?php echo $row["phone"]; ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $row["user_id"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>

                                    </td>
                                </tr>
                            <?php }
                        } else { 
                            ?>
                            <tr>
                                <td colspan="7">No users found</td>
                            </tr>
                        <?php } 
                        
                        ?>
                    </tbody>
                </table>
    

    <!-- Add User Modal -->
    <div class="modal" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user.php" method="POST" id="addUserForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" name="role">
                            <option value="User">User</option>
                            <option value="Editor">Editor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Edit User Modal -->

    
    <div class="modal" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="editPhone" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole">
                            <option value="User">User</option>
                            <option value="Editor">Editor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

</section>

                

                
                
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showSection(sectionId) {
    const sections = document.querySelectorAll('.section-content');
    sections.forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
}

$('#menu-toggle').click(function() {
    $('#sidebar-wrapper').toggleClass('toggled');
});

document.addEventListener('DOMContentLoaded', () => {
    showSection('dashboard');
});


// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Chart 1: Bar Chart for Total Music Files
    const ctxMusic = document.getElementById('musicChart').getContext('2d');

fetch('get_chart_data.php')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.genre);
        const musicData = data.map(item => item.total);

        new Chart(ctxMusic, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Music Files',
                    data: musicData,
                    backgroundColor: '#6f42c1'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Music Files by Genre',
                        color: '#ffffff',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching chart data:', error));


    // Chart 2: Line Chart for User Growth
    const ctxUserGrowth = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctxUserGrowth, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'User Growth',
                data: [0, 2, 3, 5, 10],
                borderColor: '#42a5f5',
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'User Growth Over Months',
                    color: '#ffffff', // Set title text color here
                    font: {
                    size: 18 // Adjust title font size if needed
                   }
                }
            }
        }
    });
      // Chart 3: Doughnut Chart for Language Distribution
      const ctxLanguage = document.getElementById('languageChart').getContext('2d');
      new Chart(ctxLanguage, {
          type: 'doughnut',
          data: {
              labels: ['English', 'Spanish', 'Hindi', 'Urdu', 'Japanese', 'German'],
              datasets: [{
                  label: 'Language Distribution',

                  data: [9, 9, 9, 9, 9, 9],  // Example data for each language
                  backgroundColor: ['#42a5f5', '#66bb6a', '#ffca28', '#ef5350', '#ab47bc', '#29b6f6']
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  },
                  title: {
                      display: true,
                      text: 'Content by Language',
                      color: '#ffffff', // Set title text color here
                      font: {
                      size: 18 // Adjust title font size if needed
                     }
                  }
              }
          }
      });
});

    </script>
</body>
</html>
