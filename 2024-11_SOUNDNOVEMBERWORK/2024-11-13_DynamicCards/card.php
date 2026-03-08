<?php
include ("dbconnection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Top Albums for October</title>
</head>
<style>
   * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    width: 80%;
    max-width: 800px;
    padding: 14px;
    background-color: #333;
    border-radius: 12px;
    color: #fff;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    font-size: 1.5em;
}

.album-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px; /* Increased spacing between cards */
    justify-content: center; /* Center align the grid */
}

.album-card {
    display: flex;
    align-items: center;
    padding: 15px;
    background-color: #444;
    border-radius: 8px;
    transition: transform 0.3s ease;
    width: 300px;
    margin: auto; /* Center each card */
}

.album-card:hover {
    transform: scale(1.05);
}

.album-card img {
    width: 70%; /* Image width increased to 70% */
    max-width: 120px; /* Ensuring the image doesn't exceed 120px width */
    border-radius: 8px;
    margin-right: 15px;
}

.album-card p {
    font-size: 1em;
    margin: 0;
}

.album-card p span {
    display: block;
    font-size: 0.85em;
    color: #aaa;
    margin-top: 5px;
}

/* Responsive Design */
@media (max-width: 600px) {
    .album-grid {
        grid-template-columns: 1fr;
        gap: 20px; /* Adjusted spacing for single-column layout */
    }

    .album-card {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .album-card img {
        width: 50%; /* Image width set to 50% on smaller screens */
        margin: 0 auto 15px; /* Centered image with bottom margin */
    }

    .album-card p {
        margin: 0;
    }
}


</style>
<body>
<div class="container">
        <h2>Top Albums for October</h2>
        <div class="album-grid">
            <?php
            // Fetch all albums
            $sql = "SELECT * FROM albums";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="album-card">';
                    echo '<img src="' . $row["img_path"] . '" alt="' . $row["title"] . '">';
                    echo '<p>' . $row["title"] . '<br><span>' . $row["artist"] . '</span></p>';
                    echo '</div>';
                }
            } else {
                echo "No albums found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
