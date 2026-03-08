<?php
session_start();
?>
<?php
include ('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
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


    .page-wrapper {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 2rem;
    }

    .content-grid {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
    }

    .content-column {
      flex: 1;
      min-width: 300px;
      background: rgba(255, 255, 255, 0.06);
      border-radius: 20px;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
      padding: 2rem;
      transition: 0.3s;
    }

    .content-column:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 35px rgba(0, 0, 0, 0.5);
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      border-bottom: 2px solid rgba(255, 255, 255, 0.2);
      padding-bottom: 0.5rem;
    }

    .spotify-container iframe,
    .video-container iframe {
      width: 100%;
      height: 300px;
      border: none;
      border-radius: 15px;
      margin-bottom: 1rem;
      transition: transform 0.2s ease;
    }

    .spotify-container iframe:hover,
    .video-container iframe:hover {
      transform: scale(1.015);
    }

    @media (max-width: 768px) {
      .spotify-container iframe,
      .video-container iframe {
        height: 220px;
      }

      .content-column {
        padding: 1.2rem;
      }

      .section-title {
        font-size: 1.3rem;
      }
    }

    @media (max-width: 480px) {
      .spotify-container iframe,
      .video-container iframe {
        height: 180px;
      }

      .section-title {
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>
<?php include('Modules/navbar_sidebar.php'); ?>
<?php include('Chatbot/chat.php'); ?>
  <div class="page-wrapper">
    <div class="content-grid">

      <!-- Spotify Section -->
      <div class="content-column">
        <h4 class="section-title text-success">🎧 Spotify Top Songs</h4>
        <div class="spotify-container">
          <iframe src="https://open.spotify.com/embed/track/7qiZfU4dY1lWllzX7mPBI3?utm_source=generator"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
          <iframe src="https://open.spotify.com/embed/track/3KkXRkHbMCARz0aVfEt68P?utm_source=generator"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
          <iframe src="https://open.spotify.com/embed/track/0VjIjW4GlUZAMYd2vXMi3b?utm_source=generator"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/3sK8wGT43QFpWrvNQsrQya?utm_source=generator" 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/2CGNAOSuO1MEFCbBRgUzjd?utm_source=generator&theme=0"
             allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
             <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/2RkZ5LkEzeHGRsmDqKwmaJ?utm_source=generator"
             allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
             <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/04emojnbYkrRmv5qtJcgVP?utm_source=generator" 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/42UBPzRMh5yyz0EDPr6fr1?utm_source=generator"
             allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
             <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/0FTmksd2dxiE5e3rWyJXs6?utm_source=generator"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/0nj9Bq5sHDiTxSHunhgkFb?utm_source=generator"
             allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
      </div>

      <!-- YouTube Section -->
      <div class="content-column">
        <h4 class="section-title text-danger">🎬 YouTube Music Videos</h4>
        <div class="video-container">
          <iframe
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
          <iframe
            src="https://www.youtube.com/embed/60ItHLz5WEA"
            allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
          <iframe src="https://www.youtube.com/embed/u2ah9tWTkmk?si=PJPdzyurf3hZLJTo"
            allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <iframe src="https://www.youtube.com/embed/U8QhB8_0t2g?si=WdzW_hyO6nF4YIEL"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        <iframe
            src="https://www.youtube.com/embed/videoseries?list=PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI"
            allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
          <iframe src="https://www.youtube.com/embed/CXBFU97X61I?si=3TWYs1jQ2TUSWSOr"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/egemoVK0IKY?si=Jq--H_5tRhzr7sr7"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/kPa7bsKwL-c?si=r29RtkWgMfS3UoJQ"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/sNY_2TEmzho?si=VgfU2mmqslg4omjA"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        <iframe src="https://www.youtube.com/embed/sNY_2TEmzho?si=RupbbffwFLNPAj7f"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
    <!-- JavaScript -->
    <script src="script2.js?v=<?php echo time(); ?>"></script>
</body>
</html>
