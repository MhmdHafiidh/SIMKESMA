@extends('layouts.sbadmin2')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (User List) -->
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card user-card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Chat</h6>
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="list-group list-group-flush" id="users-list" style="max-height: 500px; overflow-y: auto;">
                    @foreach ($users as $user)
                    <a href="#"
                       class="list-group-item list-group-item-action user-item py-3 d-flex align-items-center"
                       data-user-id="{{ $user->id }}"
                       onclick="selectUser({{ $user->id }}, '{{ $user->name }}')">

                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $user->name }}</h6>
                            <small class="text-muted">Terakhir dilihat baru saja</small>
                        </div>
                        <span class="unread-badge badge badge-danger" data-user-id="{{ $user->id }}" style="display:none;">0</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Chat Section -->
        <div class="col-md-8 col-lg-9">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h6 id="chat-title">Pilih User untuk Memulai Chat</h6>
                    <div>
                        <button class="btn btn-light btn-sm" id="refresh-chat" onclick="refreshChat()" style="display:none;">
                            <i class="fas fa-sync"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" id="clear-chat" onclick="clearChat()" style="display:none;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div id="chat-box" class="chat-box p-4" style="height: 500px; overflow-y: auto;">
                    <div id="no-chat-selected" class="text-center text-muted">
                        <i class="fas fa-comments fa-4x mb-3"></i>
                        <p>Pilih User untuk Melihat Pesan</p>
                    </div>
                </div>
                <div class="card-footer">
                    <form id="chat-form" enctype="multipart/form-data" class="d-flex align-items-center">
                        @csrf
                        <input type="hidden" id="receiver_id" name="receiver_id">
                        <textarea class="form-control mr-2" id="message" placeholder="Tulis pesan..." rows="1" disabled></textarea>
                        <label class="btn btn-outline-secondary m-0">
                            <input type="file" id="image" name="image" accept="image/*" hidden disabled>
                            <i class="fas fa-image"></i>
                        </label>
                        <button class="btn btn-primary" type="button" onclick="sendMessage()" disabled>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</div>

<style>
    /* General */
    body {
        font-family: 'Poppins', sans-serif;
    }
    .bg-gradient-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    /* Chat Sidebar */
    .user-card {
        border-radius: 15px;
    }
    .user-item:hover {
        background-color: #f3f4f6;
        border-left: 3px solid #6a11cb;
    }

    /* Chat Box */
    .chat-box {
        background: #f4f6f9;
        border-radius: 10px;
        overflow-y: auto;
        height: 500px;
    }

    /* Messages */
    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 15px;
        position: relative;
        animation: fadeIn 0.3s ease-in-out;
    }
    .message.sent {
        background-color: #6a11cb;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 0;
    }
    .message.received {
        background-color: #e2e8f0;
        align-self: flex-start;
        border-bottom-left-radius: 0;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.user-item').forEach(el => el.classList.remove('active'));
                item.classList.add('active');
            });
        });
    });
</script>
@endsection
