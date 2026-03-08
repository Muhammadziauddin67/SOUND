<!-- Chatbot Button and Overlay Snippet -->
<style>
  /* Floating Chatbot Button */
  #chatbotButton {
    position: fixed;
    bottom: 100px;
    right: 20px;
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    color: white;
    font-size: 28px;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(37, 117, 252, 0.8);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease, transform 0.3s ease;
  }
  #chatbotButton:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    transform: scale(1.1);
  }

  /* Chatbot Overlay */
  #chatbotOverlay {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.7);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    overflow: auto;
    animation: fadeIn 0.4s ease forwards;
  }

  /* Chatbot Container */
  #chatbotContainer {
    background: linear-gradient(135deg, #1e1e2f, #3a3a5a);
    max-width: 450px;
    width: 90%;
    margin: 60px auto;
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(37, 117, 252, 0.7);
    padding: 25px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    position: relative;
    color: #eee;
    animation: slideIn 0.4s ease forwards;
  }

  /* Close Button */
  #chatbotCloseBtn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    font-size: 32px;
    font-weight: bold;
    color: #bbb;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  #chatbotCloseBtn:hover {
    color: #fff;
  }

  /* Chat messages */
  .message {
    margin: 10px 0;
    line-height: 1.4;
  }
  .user {
    text-align: right;
    color: #4fc3f7;
    font-weight: 600;
  }
  .bot {
    text-align: left;
    color: #81d4fa;
    font-weight: 600;
  }

  /* Input and send button */
  input[type="text"] {
    width: 75%;
    padding: 12px 15px;
    font-size: 16px;
    border-radius: 25px;
    border: none;
    outline: none;
    margin-right: 10px;
    box-shadow: inset 0 0 8px rgba(255,255,255,0.2);
    background: #2a2a4a;
    color: #eee;
    transition: box-shadow 0.3s ease;
  }
  input[type="text"]:focus {
    box-shadow: 0 0 12px #4fc3f7;
  }
  button.sendBtn {
    padding: 12px 20px;
    border-radius: 25px;
    border: none;
    background: #4fc3f7;
    color: #1e1e2f;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  button.sendBtn:hover {
    background: #81d4fa;
  }

    /* Button for Go to Song */
  .go-to-song-btn {
    display: inline-block;
    margin-top: 8px;
    padding: 8px 14px;
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    border-radius: 20px;
    text-decoration: none;
    transition: 0.3s;
  }
  .go-to-song-btn:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
  }

  /* Thinking animation */
  @keyframes ellipsis {
    0% { content: ''; }
    25% { content: '.'; }
    50% { content: '..'; }
    75% { content: '...'; }
    100% { content: ''; }
  }
  .thinking::after {
    content: '';
    animation: ellipsis 1.5s infinite;
    display: inline-block;
    width: 1em;
    text-align: left;
  }

  /* Fade in overlay */
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  /* Slide in chatbot container */
  @keyframes slideIn {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  /* Responsive adjustments */
  @media (max-width: 480px) {
    #chatbotContainer {
      max-width: 95%;
      margin: 40px 10px;
      padding: 15px;
    }
    input[type="text"] {
      width: 65%;
      padding: 10px 12px;
      font-size: 14px;
    }
    button.sendBtn {
      padding: 10px 15px;
      font-size: 14px;
    }
  }
</style>

<!-- Chatbot Button -->
<button id="chatbotButton" aria-label="Open Chatbot">&#127911;</button>

<!-- Chatbot Overlay -->
<div id="chatbotOverlay" role="dialog" aria-modal="true" aria-labelledby="chatbotTitle">
  <div id="chatbotContainer">
    <button id="chatbotCloseBtn" aria-label="Close Chatbot">&times;</button>
    <h2 id="chatbotTitle">🎤 Ask SOUND AI</h2>
    <div id="chatArea" style="height: 300px; overflow-y: auto; border-radius: 8px; background: #1e1e2f; box-shadow: inset 0 0 10px rgba(255,255,255,0.1); padding: 10px; color: #eee;"></div>
    <div style="margin-top: 10px;">
      <input type="text" id="userInput" placeholder="Type your request..." aria-label="Chat input" autocomplete="off" />
      <button class="sendBtn" onclick="sendMessage()">Send</button>
    </div>
  </div>
</div>

<script>
  const chatbotButton = document.getElementById('chatbotButton');
  const chatbotOverlay = document.getElementById('chatbotOverlay');
  const chatbotCloseBtn = document.getElementById('chatbotCloseBtn');
  const chatArea = document.getElementById('chatArea');
  const userInput = document.getElementById('userInput');

  chatbotButton.addEventListener('click', () => {
    chatbotOverlay.style.display = 'block';
    userInput.focus();
  });

  chatbotCloseBtn.addEventListener('click', () => {
    chatbotOverlay.style.display = 'none';
    chatArea.innerHTML = ''; // Clear chat on close if desired
    userInput.value = '';
  });

  function sendMessage() {
    const message = userInput.value.trim();
    if (message === '') return;

    chatArea.innerHTML += `<div class='message user'><b>You:</b> ${message}</div>`;
    userInput.value = '';
    chatArea.scrollTop = chatArea.scrollHeight;

    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'message bot thinking';
    loadingDiv.innerHTML = '<b>MusicBot:</b> <span style="color: #81d4fa;">Thinking</span>';
    chatArea.appendChild(loadingDiv);
    chatArea.scrollTop = chatArea.scrollHeight;

    fetch('Chatbot/handle_chat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data => {
      chatArea.removeChild(loadingDiv);

      if (data.response) {
        // if backend also returns link, render button
        let replyHtml = `<div class='message bot'><b>MusicBot:</b> ${data.response}</div>`;

        if (data.song_link) {
          replyHtml += `
            <div class="message bot">
              <a href="${data.song_link}" class="go-to-song-btn" target="_blank">🎵 Go to Song</a>
            </div>`;
        }

        chatArea.innerHTML += replyHtml;
      } else {
        chatArea.innerHTML += `<div class='message bot' style='color:red;'><b>Error:</b> ${data.error || 'Unknown error'}</div>`;
      }
      chatArea.scrollTop = chatArea.scrollHeight;
    })
    .catch(err => {
      chatArea.removeChild(loadingDiv);
      chatArea.innerHTML += `<div class='message bot' style='color:red;'><b>Error:</b> ${err.message}</div>`;
      chatArea.scrollTop = chatArea.scrollHeight;
    });
  }
</script>

