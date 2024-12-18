@extends('layouts.sbadmin2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Users</div>
                <ul class="list-group list-group-flush" id="users-list">
                    @foreach ($users as $user)
                        <li class="list-group-item list-group-item-action" 
                            onclick="selectUser({{ $user->id }}, '{{ $user->name }}')">
                            {{ $user->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="chat-header">Select a user to start chatting</div>
                <div id="chat-box" class="card-body chat-container" style="height: 400px; overflow-y: auto;">
                    <!-- Messages will be dynamically added here -->
                </div>
                <div class="card-footer">
                    <form id="chat-form" enctype="multipart/form-data">
                        <input type="hidden" id="receiver_id" name="receiver_id">
                        <div class="input-group">
                            <textarea class="form-control" id="message" name="message" placeholder="Write a message..." rows="1"></textarea>
                            <div class="input-group-append">
                                <label class="btn btn-outline-secondary">
                                    <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                                    <i class="fa fa-image"></i>
                                </label>
                                <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
    }
    .message {
        max-width: 70%;
        margin-bottom: 10px;
        clear: both;
        position: relative;
        padding: 10px;
        border-radius: 10px;
    }
    .message.sent {
        align-self: flex-end;
        background-color: #007bff;
        color: white;
        margin-left: auto;
    }
    .message.received {
        align-self: flex-start;
        background-color: #f1f0f0;
        color: black;
        margin-right: auto;
    }
    .message-sender {
        font-size: 0.8em;
        margin-bottom: 5px;
        opacity: 0.7;
    }
    .message-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 10px;
        margin-top: 5px;
    }
</style>

<script>
    let selectedUser = null;
    const currentUserId = {{ auth()->id() }};

    function selectUser(id, name) {
        selectedUser = id;
        document.getElementById('receiver_id').value = id;
        document.getElementById('chat-header').textContent = `Chatting with ${name}`;
        fetchMessages(id);
    }

    function fetchMessages(id) {
        fetch(`/chat/messages/${id}`)
            .then(response => response.json())
            .then(messages => {
                const chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';
                messages.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    
                    // Determine if message is sent or received
                    const isSentMessage = msg.sender_id === currentUserId;
                    messageDiv.classList.add('message', isSentMessage ? 'sent' : 'received');
                    
                    // Create message content
                    let messageContent = '';
                    if (!isSentMessage) {
                        messageContent += `<div class="message-sender">${msg.sender_name}</div>`;
                    }
                    
                    if (msg.message) {
                        messageContent += `<div class="message-text">${msg.message}</div>`;
                    }
                    
                    if (msg.image_path) {
                        messageContent += `<img src="/storage/${msg.image_path}" class="message-image">`;
                    }
                    
                    messageContent += `<div class="message-time text-muted" style="font-size: 0.7em; margin-top: 5px;">
                        ${new Date(msg.created_at).toLocaleString()}
                    </div>`;

                    messageDiv.innerHTML = messageContent;
                    chatBox.appendChild(messageDiv);
                });

                // Scroll to bottom
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    function sendMessage() {
        const formData = new FormData(document.getElementById('chat-form'));
        
        if (!formData.get('message') && !formData.get('image').size) {
            alert('Please enter a message or select an image');
            return;
        }

        fetch('/chat/send', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(message => {
            // Clear message and file input
            document.getElementById('message').value = '';
            document.getElementById('image').value = '';
            
            // Refresh messages
            fetchMessages(selectedUser);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send message');
        });
    }

    // Optional: Auto-fetch messages periodically
    function setupMessagePolling() {
        if (selectedUser) {
            fetchMessages(selectedUser);
        }
    }
    setInterval(setupMessagePolling, 10000); // Poll every 10 seconds
</script>
@endsection