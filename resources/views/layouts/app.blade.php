<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;700&display=swap');
        body { font-family: 'Noto Sans TC', sans-serif; }
        .done-text { text-decoration: line-through; color: #9ca3af; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <span class="text-xl font-bold text-indigo-600">🚀 My Laravel Todo</span>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4">
        @yield('main_content')
    </main>
</body>
</html>