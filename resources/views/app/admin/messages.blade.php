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
            --card: rgba(255, 255, 255, 0.82);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255, 107, 53, 0.18), transparent 22%),
                radial-gradient(circle at top right, rgba(56, 189, 248, 0.16), transparent 24%),
                var(--bg);
            color: var(--text);
        }

        .dashboard-content {
            padding: 24px 0 40px;
        }

        .container-fluid {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .page-intro {
            margin-bottom: 22px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 107, 53, 0.12);
            color: var(--accent-dark);
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .page-intro h1 {
            margin: 0 0 6px;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            letter-spacing: -0.03em;
            color: var(--navy);
        }

        .page-intro p {
            margin: 0;
            color: var(--muted);
        }

        .chat-container {
            display: flex;
            height: 80vh;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            background: linear-gradient(180deg, rgba(255,255,255,0.82), rgba(255,248,243,0.94));
            backdrop-filter: blur(10px);
        }

        .chat-sidebar {
            width: 32%;
            background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(255,248,243,0.98));
            border-right: 1px solid rgba(15,23,42,0.08);
            overflow-y: auto;
            padding: 18px;
        }

        .chat-sidebar h2 {
            font-size: 1rem;
            font-weight: 800;
            margin: 0 0 16px;
            color: var(--navy);
        }

        .chat-contact {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px;
            border-radius: 18px;
            background: white;
            cursor: pointer;
            transition: 0.2s ease;
            margin-bottom: 10px;
            border: 1px solid rgba(15,23,42,0.06);
        }

        .chat-contact:hover {
            background: rgba(255, 107, 53, 0.08);
            transform: translateY(-1px);
        }

        .chat-contact .user-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .chat-contact .user-meta span {
            color: var(--navy);
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255, 107, 53, 0.2);
            flex-shrink: 0;
        }

        .message-count {
            min-width: 24px;
            height: 24px;
            display: inline-grid;
            place-items: center;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: white;
            font-size: 11px;
            padding: 0 7px;
            border-radius: 999px;
            font-weight: 700;
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-header {
            padding: 16px 20px;
            background: linear-gradient(90deg, rgba(255,107,53,0.12), rgba(255,255,255,0.96));
            border-bottom: 1px solid rgba(15,23,42,0.08);
            font-weight: 800;
            color: var(--navy);
        }

        .chat-messages {
            flex: 1;
            padding: 22px;
            background: linear-gradient(180deg, rgba(255,250,245,0.95), rgba(255,255,255,0.98));
            overflow-y: auto;
        }

        .message {
            max-width: 72%;
            padding: 12px 14px;
            border-radius: 18px;
            font-size: 14px;
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .received {
            background: rgba(255, 107, 53, 0.1);
            color: var(--text);
            border-top-left-radius: 6px;
        }

        .sent {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: white;
            margin-left: auto;
            border-top-right-radius: 6px;
        }

        .message-time {
            font-size: 10px;
            opacity: 0.78;
            margin-top: 4px;
            text-align: right;
        }

        .chat-input {
            padding: 14px;
            background: rgba(255,255,255,0.96);
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
            padding: 11px 15px;
            outline: none;
            font: inherit;
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
            padding: 10px 18px;
            cursor: pointer;
            font-weight: 700;
            box-shadow: 0 12px 24px rgba(255, 107, 53, 0.2);
        }

        .chat-input button:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 900px) {
            .chat-container {
                flex-direction: column;
                height: auto;
            }

            .chat-sidebar {
                width: 100%;
                max-height: 320px;
                border-right: none;
                border-bottom: 1px solid rgba(15,23,42,0.08);
            }
        }
    </style>
</head>

<body>

    @include('app.sidebar_menu')

    <div class="main-wrapper" id="mainWrapper">

        @include('app.header')

        <main class="dashboard-content">
            <div class="container-fluid">

                <div class="page-intro">
                    <div class="eyebrow">💬 Smart conversations, faster replies</div>
                    <h1>Message Inbox</h1>
                    <p>Chat with users in real time and keep every conversation looking polished and on-brand.</p>
                </div>

                <div class="chat-container">

                    <!-- Sidebar -->
                    <div class="chat-sidebar">
                        <h2>Users List</h2>

                        <div class="space-y-2">
                            @foreach ($all_users as $each_user)
                            <div class="chat-contact"
                                onclick="selectUser({{ $each_user->id }}, '{{ $each_user->name }}')">

                                <div class="user-meta">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($each_user->name) }}"
                                        class="chat-avatar">
                                    <span>{{ $each_user->name }}</span>
                                </div>

                                <span id="messageCount{{ $each_user->id }}" class="message-count" hidden>0</span>
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