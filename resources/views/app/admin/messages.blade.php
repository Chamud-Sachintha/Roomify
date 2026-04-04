<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Inbox</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">

    <script type="module" src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">

    <style>
        /* Layout */
        .chat-container {
            display: flex;
            height: 80vh;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        /* Sidebar */
        .chat-sidebar {
            width: 28%;
            background: #f9fafb;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            padding: 16px;
        }

        .chat-sidebar h2 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .chat-contact {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            transition: 0.2s;
        }

        .chat-contact:hover {
            background: #eef2ff;
        }

        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Chat area */
        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 15px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
        }

        /* Messages */
        .chat-messages {
            flex: 1;
            padding: 20px;
            background: #f3f4f6;
            overflow-y: auto;
        }

        .message {
            max-width: 60%;
            padding: 10px 14px;
            border-radius: 14px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .received {
            background: #e5e7eb;
            border-top-left-radius: 4px;
        }

        .sent {
            background: #4f46e5;
            color: #fff;
            margin-left: auto;
            border-top-right-radius: 4px;
        }

        .message-time {
            font-size: 10px;
            opacity: 0.6;
            margin-top: 4px;
            text-align: right;
        }

        /* Input */
        .chat-input {
            padding: 12px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }

        .chat-input form {
            display: flex;
            gap: 10px;
        }

        .chat-input input {
            flex: 1;
            border-radius: 20px;
            border: 1px solid #d1d5db;
            padding: 10px 15px;
            outline: none;
        }

        .chat-input input:focus {
            border-color: #6366f1;
        }

        .chat-input button {
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 8px 18px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background: #4338ca;
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
                <div class="chat-contact">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" class="chat-avatar">
                    <span>John Doe</span>
                </div>

                <div class="chat-contact">
                    <img src="https://ui-avatars.com/api/?name=Jane+Smith" class="chat-avatar">
                    <span>Jane Smith</span>
                </div>

                <div class="chat-contact">
                    <img src="https://ui-avatars.com/api/?name=Alice+Johnson" class="chat-avatar">
                    <span>Alice Johnson</span>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="chat-main">

            <!-- Header -->
            <div class="chat-header">
                Chat with John Doe
            </div>

            <!-- Messages -->
            <div class="chat-messages" id="chatBox">

                <div class="message received">
                    Hello, how are you?
                    <div class="message-time">10:00 AM</div>
                </div>

                <div class="message sent">
                    I'm good, thanks! How about you?
                    <div class="message-time">10:01 AM</div>
                </div>

            </div>

            <!-- Input -->
            <div class="chat-input">
                <form>
                    <input type="text" placeholder="Type your message...">
                    <button type="submit">Send</button>
                </form>
            </div>

        </div>
    </div>

</div>
</main>

</div>

</body>
</html>