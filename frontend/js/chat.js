// script.js
document.getElementById('send-button').addEventListener('click', function () {
    const messageInput = document.getElementById('message-input');
    const messageText = messageInput.value.trim();

    if (messageText) {
        const chatWindow = document.getElementById('chat-window');

        // Create a new message element
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'sent');
        messageElement.innerHTML = `<p>${messageText}</p><span class="time">${new Date().toLocaleTimeString()}</span>`;

        // Append the message to the chat window
        chatWindow.appendChild(messageElement);

        // Scroll to the bottom of the chat window
        chatWindow.scrollTop = chatWindow.scrollHeight;

        // Clear the input field
        messageInput.value = '';
    }
});
