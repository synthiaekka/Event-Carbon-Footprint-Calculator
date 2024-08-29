document.addEventListener('DOMContentLoaded', () => {
    // Initially show the home section
    showSection('home');
});

function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });

    // Show the specified section
    document.getElementById(sectionId).classList.add('active');
}

function nextSection(currentId, nextId) {
    // Move to the next section
    showSection(nextId);
}

function previousSection(currentId, previousId) {
    // Move to the previous section
    showSection(previousId);
}

function submitQuiz() {
    // Display results (you can enhance this to calculate scores)
    const resultMessage = document.getElementById('resultMessage');
    resultMessage.textContent = 'Thank you for completing the quiz!';
    showSection('result');
}

function restartQuiz() {
    // Restart the quiz from the beginning
    showSection('home');
}
