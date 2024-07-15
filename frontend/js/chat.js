// script.js
document.getElementById('send-button').addEventListener('click', function () {
    const messageInput = document.getElementById('message-input');
    const messageText = messageInput.value.trim();

    if (messageText) {
        const chatWindow = document.getElementById('chat-window');

     
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'sent');
        messageElement.innerHTML = `<p>${messageText}</p><span class="time">${new Date().toLocaleTimeString()}</span>`;

        chatWindow.appendChild(messageElement);

 
        chatWindow.scrollTop = chatWindow.scrollHeight;

  
        messageInput.value = '';
    }
});
