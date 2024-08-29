<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Website</title>
    <link rel="stylesheet" href="./css/calculator.css">
</head>
<body>
    <div class="container">
        <h1>Quiz Website</h1>
        <div class="main-content">
            <div class="sidebar">
                <h2>Sections</h2>
                <ul>
                    <li><button onclick="showSection('home')">Home</button></li>
                    <li><button onclick="showSection('section1')">Category 1</button></li>
                    <li><button onclick="showSection('section2')">Category 2</button></li>
                    <li><button onclick="showSection('section3')">Category 3</button></li>
                    <li><button onclick="showSection('result')">Results</button></li>
                </ul>
            </div>
            <div class="quiz-content">
                <!-- Home Section -->
                <div class="section" id="home">
                    <h2>Welcome to the Quiz</h2>
                    <p>Select a section to start the quiz:</p>
                    <button onclick="showSection('section1')">Start Quiz</button>
                </div>

                <!-- Section 1 -->
                <div class="section" id="section1">
                    <h2>Category 1</h2>
                    <div class="question">
                        <p>What is the capital of France?</p>
                        <label><input type="radio" name="q1" value="A"> A. Paris</label><br>
                        <label><input type="radio" name="q1" value="B"> B. London</label><br>
                        <label><input type="radio" name="q1" value="C"> C. Rome</label><br>
                        <label><input type="radio" name="q1" value="D"> D. Berlin</label>
                    </div>
                    <button onclick="nextSection('section1', 'section2')">Next</button>
                </div>

                <!-- Section 2 -->
                <div class="section" id="section2">
                    <h2>Category 2</h2>
                    <div class="question">
                        <p>What is 2 + 2?</p>
                        <label><input type="radio" name="q2" value="A"> A. 3</label><br>
                        <label><input type="radio" name="q2" value="B"> B. 4</label><br>
                        <label><input type="radio" name="q2" value="C"> C. 5</label><br>
                        <label><input type="radio" name="q2" value="D"> D. 6</label>
                    </div>
                    <button onclick="previousSection('section2', 'section1')">Previous</button>
                    <button onclick="nextSection('section2', 'section3')">Next</button>
                </div>

                <!-- Section 3 -->
                <div class="section" id="section3">
                    <h2>Category 3</h2>
                    <div class="question">
                        <p>Who wrote 'To Kill a Mockingbird'?</p>
                        <label><input type="radio" name="q3" value="A"> A. Harper Lee</label><br>
                        <label><input type="radio" name="q3" value="B"> B. J.K. Rowling</label><br>
                        <label><input type="radio" name="q3" value="C"> C. Ernest Hemingway</label><br>
                        <label><input type="radio" name="q3" value="D"> D. Mark Twain</label>
                    </div>
                    <button onclick="previousSection('section3', 'section2')">Previous</button>
                    <button onclick="submitQuiz()">Submit</button>
                </div>

                <!-- Result Section -->
                <div class="section" id="result">
                    <h2>Quiz Results</h2>
                    <p id="resultMessage"></p>
                    <button onclick="restartQuiz()">Restart Quiz</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/calculator.js"></script>
</body>
</html>
