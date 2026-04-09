@extends('layouts.app')

@section('main_content')
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">PHP & Laravel 指令速查表</h1>
        <p class="text-gray-500">開發時最常用的終端機指令與語法整理</p>
    </div>

    <div class="mb-10">
        <div class="flex items-center mb-4">
            <span class="bg-gray-100 text-gray-600 p-2 rounded-lg mr-3">🔍</span>
            <input type="text" id="searchInput" placeholder="搜尋指令..." class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">搜尋</button>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition" onclick="window.location.href='/cheatsheets/create'">新增指令</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach ($allCheats as $cheat)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">💻</span>
                <h2 class="text-xl font-bold">{{ $cheat->category }}</h2>
            </div>
            <ul class="space-y-3">
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-pink-600">{{ $cheat->commandName }}</code>
                    <p class="text-xs text-gray-500 mt-1">{{ $cheat->description }}</p>
                </li>
            </ul>
            <div class="flex items-center mb-4">
                <a href="{{ route('cheatsheets.show', $cheat->id) }}" target="_blank"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    Details..    </a>
            </div>            
        </div>
    @endforeach

    </div>

    <div class="mt-10 text-center text-gray-400 text-sm">
        提示：按下 <kbd class="bg-gray-200 px-2 py-1 rounded shadow-inner text-gray-600">Ctrl + F</kbd> 可以在此頁面快速搜尋指令。
    </div>
@endsection