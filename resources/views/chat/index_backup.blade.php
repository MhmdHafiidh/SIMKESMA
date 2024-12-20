@extends('layouts.sbadmin2')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Chats</h6>
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="list-group list-group-flush" id="users-list">
                    @foreach ($users as $user)
                        <a href="#" class="list-group-item list-group-item-action user-item py-3"
                           data-user-id="{{ $user->id }}"
                           onclick="selectUser({{ $user->id }}, '{{ $user->name }}')">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $user->name }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-circle text-success mr-1" style="font-size: 0.5rem;"></i>
                                </small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" id="chat-header">
                    <span>Select a user to start chatting</span>
                    <div class="header-actions">
                        <button class="btn btn-sm btn-light" id="clear-chat" style="display:none;" onclick="clearChat()">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div id="chat-box" class="card-body chat-container" style="height: 500px; overflow-y: auto; background-color: #f8f9fa;">
                    <div class="text-center text-muted mt-5" id="no-chat-selected">
                        <i class="fas fa-comments fa-4x mb-3 text-secondary"></i>
                        <h4>No Chat Selected</h4>
                        <p>Select a user from the list to start messaging</p>
                    </div>
                </div>
                <div class="card-footer">
                    <form id="chat-form" enctype="multipart/form-data">
                        <input type="hidden" id="receiver_id" name="receiver_id">
                        <div class="input-group">
                            <textarea class="form-control" id="message" name="message" placeholder="Write a message..." rows="1" disabled></textarea>
                            <div class="input-group-append">
                                <label class="btn btn-outline-secondary" disabled>
                                    <input type="file" id="image" name="image" accept="image/*" style="display: none;" disabled>
                                    <i class="fa fa-image"></i>
                                </label>
                                <button type="button" class="btn btn-primary" onclick="sendMessage()" disabled>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
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
        max-width: 75%;
        margin-bottom: 15px;
        clear: both;
        position: relative;
        padding: 10px 15px;
        border-radius: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .message.sent {
        align-self: flex-end;
        background-color: #007bff;
        color: white;
        margin-left: auto;
        border-bottom-right-radius: 5px;
    }
    .message.received {
        align-self: flex-start;
        background-color: #e9ecef;
        color: #212529;
        margin-right: auto;
        border-bottom-left-radius: 5px;
    }
    .message-sender {
        font-size: 0.75em;
        margin-bottom: 5px;
        opacity: 0.8;
    }
    .message-text {
        word-wrap: break-word;
    }
    .message-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 10px;
        margin-top: 5px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .message-image:hover {
        transform: scale(1.05);
    }
    .message-time {
        font-size: 0.6em;
        opacity: 0.7;
        text-align: right;
        margin-top: 5px;
    }
    .user-item:hover {
        background-color: #f1f3f5;
    }
    .user-item.active {
        background-color: #e9ecef;
    }
</style>

<script>
    let selectedUser = null;
    const currentUserId = {{ auth()->id() }};
    let messageTimestamps = {}; // Track last message timestamp for each user

    // Request notification permission
    if ('Notification' in window) {
        Notification.requestPermission();
    }

    function selectUser(id, name) {
        // Reset UI sebelum memuat pesan baru
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = `
            <div class="text-center text-muted mt-5">
                <i class="fas fa-spinner fa-spin fa-3x mb-3 text-secondary"></i>
                <h4>Loading messages...</h4>
            </div>
        `;

        // Reset tombol kirim dan teks area
        const messageInput = document.getElementById('message');
        const imageInput = document.getElementById('image');
        const sendButton = document.querySelector('button[onclick="sendMessage()"]');

        messageInput.disabled = true;
        imageInput.disabled = true;
        sendButton.disabled = true;

        // Atur user ID dan nama
        selectedUser = id;
        document.getElementById('receiver_id').value = id;
        document.getElementById('chat-header').querySelector('span').textContent = `Chatting with ${name}`;

        // Perbarui tampilan user aktif
        document.querySelectorAll('.user-item').forEach(item => item.classList.remove('active'));
        document.querySelector(`.user-item[data-user-id="${id}"]`).classList.add('active');

        // Fetch messages
        fetchMessages(id).then(() => {
            // Aktifkan input setelah pesan dimuat
            messageInput.disabled = false;
            imageInput.disabled = false;
            sendButton.disabled = false;
        });
    }

    async function fetchMessages(id) {
        try {
            const response = await fetch(`/chat/messages/${id}`);
            const messages = await response.json();

            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = ''; // Hapus loader dan pesan lama

            messages.forEach(msg => {
                const messageDiv = createMessageElement(msg);
                chatBox.appendChild(messageDiv);
            });

            // Update timestamp terakhir untuk user
            if (messages.length > 0) {
                messageTimestamps[id] = new Date(messages[messages.length - 1].created_at);
            }

            // Scroll ke bagian bawah
            chatBox.scrollTop = chatBox.scrollHeight;
        } catch (error) {
            console.error('Error fetching messages:', error);
            alert('Failed to load messages. Please try again.');
        }
    }

    function createMessageElement(msg) {
        const messageDiv = document.createElement('div');
        const isSentMessage = msg.sender_id === currentUserId;

        messageDiv.classList.add('message', isSentMessage ? 'sent' : 'received');

        let messageContent = '';
        if (!isSentMessage) {
            messageContent += `<div class="message-sender">${msg.sender_name}</div>`;
        }

        if (msg.message) {
            messageContent += `<div class="message-text">${msg.message}</div>`;
        }

        if (msg.image_path) {
            messageContent += `
                <img src="/storage/${msg.image_path}" class="message-image" onclick="openImageModal('/storage/${msg.image_path}')">
            `;
        }

        messageContent += `
            <div class="message-time">
                ${new Date(msg.created_at).toLocaleString()}
            </div>
        `;

        messageDiv.innerHTML = messageContent;
        return messageDiv;
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
            // Clear inputs
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

    function clearChat() {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = `
            <div class="text-center text-muted mt-5" id="no-chat-selected">
                <i class="fas fa-trash-alt fa-4x mb-3 text-secondary"></i>
                <h4>Chat Cleared</h4>
                <p>All messages have been removed</p>
            </div>
        `;
        document.getElementById('clear-chat').style.display = 'none';
    }

    function openImageModal(imageSrc) {
        // You can implement a modal or lightbox here in future
        window.open(imageSrc, '_blank');
    }

    function checkNewMessages() {
        // Only perform check if a user is selected
        if (selectedUser) {
            fetch(`/chat/messages/${selectedUser}`)
                .then(response => response.json())
                .then(messages => {
                    // Get the last known timestamp for this user
                    const lastTimestamp = messageTimestamps[selectedUser];

                    // Check for new messages after the last known timestamp
                    const newMessages = messages.filter(msg =>
                        (!lastTimestamp || new Date(msg.created_at) > lastTimestamp) &&
                        msg.sender_id !== currentUserId
                    );

                    // Create browser notifications for new messages
                    newMessages.forEach(msg => {
                        if ('Notification' in window && Notification.permission === 'granted') {
                            new Notification(`New message from ${msg.sender_name}`, {
                                body: msg.message || 'Sent an image',
                                icon: '/path/to/default/avatar.png'
                            });
                        }
                    });

                    // If there are new messages, update the view and timestamp
                    if (newMessages.length > 0) {
                        fetchMessages(selectedUser);
                    }
                })
                .catch(error => {
                    console.error('Error checking messages:', error);
                });
        }
    }

    // Check for new messages every 10 seconds
    setInterval(checkNewMessages, 10000);
</script>
@endsection
