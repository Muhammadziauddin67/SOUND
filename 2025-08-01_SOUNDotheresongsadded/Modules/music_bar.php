<div class="music-bar">
    <input type="range" id="progress-bar" value="0" min="0" step="0.1">

    <div class="song-info">
        <img id="song-image" src="assets/default-song.PNG" alt="Song Image" class="song-image">
        <span id="current-song">No Song Playing</span>
        <br>
        <span id="current-artist" class="artist-name"></span>
        </div>

    <div class="music-controls">
        <div class="control-row-1">
            <button id="prev" class="control-btn"><i class="fas fa-backward"></i></button>
            <button id="playPause" class="control-btn"><i id="playPauseIcon" class="fas fa-play"></i></button>
            <button id="next" class="control-btn"><i class="fas fa-forward"></i></button>
        </div>
        <div class="control-row-2">
            <button id="rewind" class="control-btn"><i class="fas fa-undo"></i></button>
            <button id="switchToVideo" class="control-btn" title="Switch to video"><i class="fas fa-video"></i></button>
            <button id="switchToAudio" class="control-btn" title="Switch to audio"><i class="fas fa-music"></i></button>
        </div>
    </div>

    <div class="volume-section">
        <i id="volume-icon" class="fas fa-volume-up"></i>
        <div class="volume-control">
            <input type="range" id="volume-bar" value="100" min="0" max="100" step="1">
        </div>
    </div>
</div>
<audio id="audio-player">
        <source id="audio-source" src="" type="audio/mpeg">
        Your browser does not support the audio element.
</audio>
<div id="youtubeModal" class="modal">
  <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <iframe id="youtubePlayer"   frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>