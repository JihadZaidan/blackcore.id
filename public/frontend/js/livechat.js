// This code assumes you're using jQuery

$(function() {
    // Function to add a new message to the chat
    function addMessage(content, isReverse = false) {
        var messageHtml = `
            <div class="media media-chat ${isReverse ? 'media-chat-reverse' : ''}">
                <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                <div class="media-body">
                    <p>${content}</p>
                </div>
            </div>
        `;
        $('#chat-content').append(messageHtml);
        $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
    }

    // Event listener for the send button
    $('.publisher-btn.text-info').click(function(e) {
        e.preventDefault();
        var message = $('.publisher-input').val().trim();
        if (message) {
            addMessage(message, true);
            $('.publisher-input').val('');
            
            // Simulate a response (you would replace this with actual server communication)
            setTimeout(function() {
                addMessage("This is a simulated response.");
            }, 1000);
        }
    });

    // Event listener for the enter key in the input field
    $('.publisher-input').keypress(function(e) {
        if (e.which == 13) {
            $('.publisher-btn.text-info').click();
            return false;
        }
    });
});