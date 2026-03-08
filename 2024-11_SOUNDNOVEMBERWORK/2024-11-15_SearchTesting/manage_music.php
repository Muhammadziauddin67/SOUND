<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Music - Sound</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Music</h2>
        <form method="POST" enctype="multipart/form-data" class="p-4 bg-light rounded shadow">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="artist" class="form-label">Artist</label>
                <input type="text" class="form-control" id="artist" name="artist" required>
            </div>
            <div class="mb-3">
                <label for="album" class="form-label">Album</label>
                <input type="text" class="form-control" id="album" name="album">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year">
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre">
            </div>
            <div class="mb-3">
                <label for="music_file" class="form-label">Upload Music File</label>
                <input type="file" class="form-control" id="music_file" name="music_file" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Music</button>
        </form>
    </div>
</body>
</html>
