<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title>JavaScript Greeting with Speech Recognition</title>
  <style>
    canvas {
      border: 1px solid #000;
      border-radius: 10rem;
    }

    #nameInput {
      margin-top: 20px;
      padding: 5px;
      font-size: 16px;
    }

    #searchInput {
      margin-top: 20px;
      padding: 5px;
      font-size: 16px;
    }
  </style>
</head>

<body style="text-align:center;">
  <canvas id="faceCanvas" width="200" height="200"></canvas>
  <div id="nameInputContainer" style="display: none;">
    <label for="nameInput">Enter your name:</label>
    <input type="text" id="nameInput" name="nameInput">
    <button onclick="submitName()">Save my name</button>
  </div>
  <div id="searchInputContainer" style="display: none;">
    <label for="searchInput">Enter your question:</label>
    <input type="text" id="searchInput" name="searchInput">
    <button onclick="submitSearch()">Search</button>
  </div>

  <script>
    // Get the canvas element
    const canvas = document.getElementById('faceCanvas');
    const context = canvas.getContext('2d');

    // Variables to track blinking state and mouth animation
    let blink = false;
    let mouthAnimation = 0; // variable to control mouth animation
    let blinkInterval;
    let mouthInterval;

    // Function to draw a face
    function drawFace() {
      // Draw head
      context.beginPath();
      context.arc(100, 100, 80, 0, 2 * Math.PI);
      context.fillStyle = '#FCC';
      context.fill();
      context.stroke();

      // Draw eyes
      drawEye(70, 70);
      drawEye(130, 70);

      // Draw mouth
      context.beginPath();
      context.arc(100, 120, 35 + mouthAnimation, 0, Math.PI, false);
      context.lineTo(65, 120);
      context.quadraticCurveTo(100, 150, 135, 120);

      // Complete the upper lip
      context.moveTo(65, 120);
      context.quadraticCurveTo(100, 110, 135, 120);

      context.fillStyle = '#FCC';
      context.fill();
      context.stroke();
    }

    // Function to draw an eye
    function drawEye(x, y) {
      context.beginPath();
      context.arc(x, y, 10, 0, 2 * Math.PI);
      context.fillStyle = blink ? '#FCC' : '#000';
      context.fill();
    }

    // Function to handle blinking eyes
    function blinkEyes() {
      blink = true;
      drawFace();
      setTimeout(() => {
        blink = false;
        drawFace();
      }, 200); // Adjust the blinking speed (200 milliseconds in this example)
    }

    // Function to animate the mouth
    function animateMouth() {
      // Toggle between 0 and 5 for subtle mouth movement
      mouthAnimation = (mouthAnimation === 0) ? 5 : 0;
      drawFace();
    }

    // Set intervals for blinking eyes and mouth animation
    blinkInterval = setInterval(blinkEyes, 3000); // Blink the eyes every 3 seconds
    mouthInterval = setInterval(animateMouth, 200); // Animate the mouth every 2 seconds

    // Call the drawFace function
    drawFace();

    // Play an initial greeting using Text-to-Speech on screen load
    window.onload = function() {
      const greetingMessage = "Hey, My Name is GSI-30/FBD, and developed by Navix, I don't know your name, so I'll call you user. If you want to share your name with me, you can fill your name here.";
      const greetingUtterance = new SpeechSynthesisUtterance(greetingMessage);
      window.speechSynthesis.speak(greetingUtterance);

      // Display the name input field after the completion of the initial greeting
      setTimeout(() => {
        document.getElementById('nameInputContainer').style.display = 'block';
      }, 10000); // Wait for 5 seconds (adjust as needed)
    };

    // Function to handle name submission
    function submitName() {
      const userInput = document.getElementById('nameInput').value;
      if (userInput) {
        const welcomeMessage = `Welcome & Thanks, ${userInput}! Let me know first how can I help you? Please enter your question...`;
        const welcomeUtterance = new SpeechSynthesisUtterance(welcomeMessage);
        window.speechSynthesis.speak(welcomeUtterance);
        // Optionally, you can hide the name input field after submission
        document.getElementById('nameInputContainer').style.display = 'none';

        // Display the search input field after submitting the name
        setTimeout(() => {
          document.getElementById('searchInputContainer').style.display = 'block';
        }, 5000); // Wait for 2 seconds (adjust as needed)
      }
    }

    // Function to handle search submission
    function submitSearch() {
      const searchInput = document.getElementById('searchInput').value;
      if (searchInput) {
        const searchMessage = `Search results for ${searchInput} are here, you can read any articale. Thanks.`;
        const searchUtterance = new SpeechSynthesisUtterance(searchMessage);
        window.speechSynthesis.speak(searchUtterance);

        // Open a new tab in the background with the Google search results
        const searchUrl = `https://www.google.com/search?q=${encodeURIComponent(searchInput)}`;
        window.open(searchUrl, '_blank');

        // Optionally, you can hide the search input field after submission
        document.getElementById('searchInputContainer').style.display = 'none';
      }
    }
  </script>
</body>

</html>