<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Inbox</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">

    <script type="module" src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --bg: #fffaf5;
            --text: #1f2937;
            --muted: #6b7280;
            --card: rgba(255,255,255,0.96);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.1);
        }

        body {
            background: linear-gradient(135deg, rgba(255,107,53,0.08), rgba(255,255,255,0.95));
            color: var(--text);
        }

        .dashboard-content {
            padding-top: 24px;
        }

        .chat-container {
            display: flex;
            height: 80vh;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            background: var(--card);
        }

        .chat-sidebar {
            width: 30%;
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,248,243,0.95));
            border-right: 1px solid rgba(15,23,42,0.08);
            overflow-y: auto;
            padding: 16px;
        }

        .chat-sidebar h2 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--navy);
        }

        .chat-contact {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 14px;
            background: #fff;
            cursor: pointer;
            transition: 0.2s;
            margin-bottom: 10px;
            border: 1px solid rgba(15,23,42,0.06);
        }

        .chat-contact:hover {
            background: rgba(255,107,53,0.08);
            transform: translateY(-1px);
        }

        .chat-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-header {
            padding: 15px 18px;
            background: linear-gradient(90deg, rgba(255,107,53,0.1), rgba(255,255,255,0.95));
            border-bottom: 1px solid rgba(15,23,42,0.08);
            font-weight: 700;
            color: var(--navy);
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            background: linear-gradient(180deg, rgba(255,250,245,0.9), rgba(255,255,255,0.95));
            overflow-y: auto;
        }

        .message {
            max-width: 70%;
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .received {
            background: rgba(255,107,53,0.1);
            border-top-left-radius: 4px;
        }

        .sent {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: #fff;
            margin-left: auto;
            border-top-right-radius: 4px;
        }

        .message-time {
            font-size: 10px;
            opacity: 0.7;
            margin-top: 4px;
            text-align: right;
        }

        .chat-input {
            padding: 12px;
            background: #fff;
            border-top: 1px solid rgba(15,23,42,0.08);
        }

        .chat-input form {
            display: flex;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            border-radius: 999px;
            border: 1px solid rgba(15,23,42,0.12);
            padding: 10px 15px;
            outline: none;
        }

        .chat-input input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.18);
        }

        .chat-input button {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 8px 18px;
            cursor: pointer;
        }

        .chat-input button:hover {
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

    @include('app.sidebar_menu')

    <div class="main-wrapper" id="mainWrapper">

        @include('app.header')

        <main class="dashboard-content">
            <div class="container-fluid">

                <div class="mb-3">
                    <h1 class="h3 font-bold">Message Inbox</h1>
                    <p class="text-muted text-sm">Chat with users in real time</p>
                </div>

                <div class="chat-container">

                    <!-- Sidebar -->
                    <div class="chat-sidebar">
                        <h2>Users List</h2>

                        <div class="space-y-2">
                            @foreach ($all_users as $each_user)
                            <div class="chat-contact d-flex justify-between align-center"
                                onclick="selectUser({{ $each_user->id }}, '{{ $each_user->name }}')">

                                <div style="display:flex; align-items:center; gap:10px;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($each_user->name) }}"
                                        class="chat-avatar">
                                    <span>{{ $each_user->name }}</span>
                                </div>

                                <!-- Hardcoded message count -->
                                <span style="
                                        background:#ef4444;
                                        color:white;
                                        font-size:12px;
                                        padding:2px 8px;
                                        border-radius:999px;
                                    " id="messageCount{{ $each_user->id }}" class="message-count" hidden>0</span>

                                </span>

                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="chat-main">

                        <!-- Header -->
                        <div class="chat-header" id="chatHeader">
                            Chat with Users
                        </div>

                        <!-- Messages -->
                        <div class="chat-messages" id="chatBox">
                            <div id="emptyState" style="text-align:center; color:#9ca3af; margin-top:50px;">
                                No messages yet 👋
                            </div>
                        </div>

                        <!-- Input -->
                        <div class="chat-input">
                            <form onsubmit="sendMessage(event)">
                                <input type="text" id="messageInput" placeholder="Type your message...">
                                <button type="submit">Send</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/pusher-js@8/dist/web/pusher.min.js"></script>
    <script type="module">
        import Echo from 'https://cdn.jsdelivr.net/npm/laravel-echo@1.18.0/dist/echo.js';

        if (performance.getEntriesByType("navigation")[0].type === "reload") {
            localStorage.removeItem('selectedChatBoxUserId');
        }

        // Tell Echo to use the Pusher client
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: '{{ env("REVERB_APP_KEY") }}',       // your app key
            wsHost: window.location.hostname,
            wsPort: {{ env("REVERB_PORT", 8080) }},   // REVERB_PORT from .env
            wssPort: {{ env("REVERB_PORT", 8080) }},
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
    });

        const userId = {{ auth() -> id() }};
        let receiverId = null;
        let messageCount = 0;

        function selectUser(id, name) {
            receiverId = id;
            document.getElementById('chatHeader').innerText = "Chat with " + name;

            localStorage.setItem('selectedChatBoxUserId', id);
            document.getElementById('chatBox').innerHTML = '';

            markAsRead();
            getChatHistory(userId, id);
        }

        function sendMessage(e) {
            e.preventDefault();
            if (!receiverId) { alert("Select a user first"); return; }

            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            if (!message) return;

            fetch('{{ url('/app/send-message') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message, receiver_id: receiverId })
            });

            appendMessage(message, 'sent');
            input.value = '';
        }

        function markAsRead() {
            if (!receiverId) return;

            fetch('{{ url('/app/mark-as-read') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ sender_id: receiverId, receiver_id: userId })
            });

            messageCount = 0;
            const countElem = document.getElementById('messageCount' + receiverId);
            if (countElem) {
                countElem.innerText = messageCount;
                countElem.hidden = true;
            }
        }

        function getChatHistory(userId1, userId2) {
            fetch('{{ url('/app/chat-history') }}?sender_id=' + encodeURIComponent(userId1) + '&receiver_id=' + encodeURIComponent(userId2))
                .then(response => response.json())
                .then(data => {
                    const box = document.getElementById('chatBox');
                    box.innerHTML = '';
                    data.chat_history.forEach(msg => {
                        const type = msg.sender_id === userId ? 'sent' : 'received';
                        appendMessage(msg.message, type);
                    });
                });
        }

        function appendMessage(message, type) {
            const box = document.getElementById('chatBox');
            box.innerHTML += `
            <div class="message ${type}">
                ${message}
                <div class="message-time">now</div>
            </div>
        `;
            box.scrollTop = box.scrollHeight;
        }

        // Listen on private channel
        console.log("sending on channel: " + `chat.${receiverId}`);
        window.Echo.private(`chat.${userId}`)
            .listen('MessageSent', (e) => {
                if (e.message.sender_id === userId) return;

                var selectedUserId = localStorage.getItem('selectedChatBoxUserId');

                if (selectedUserId != e.message.sender_id) {
                    // Optionally, you can show a notification here for new messages from other users
                    console.log("New message from user " + e.message.sender_id);
                    messageCount++;

                    const countElem = document.getElementById('messageCount' + e.message.sender_id);
                    if (countElem) {
                        countElem.innerText = messageCount;
                        countElem.hidden = false;
                    }
                } else {
                    appendMessage(e.message.message, 'received');
                    markAsRead();
                    getChatHistory(userId, e.message.sender_id);
                }
            });

        // Make functions accessible globally
        window.selectUser = selectUser;
        window.sendMessage = sendMessage;
    </script>
</body>

</html>