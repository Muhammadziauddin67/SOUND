<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Sound</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Categories</h2>
        <form method="POST" class="p-4 bg-light rounded shadow">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Category Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="year">Year</option>
                    <option value="artist">Artist</option>
                    <option value="album">Album</option>
                    <option value="genre">Genre</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Category</button>
        </form>
    </div>
</body>
</html>
