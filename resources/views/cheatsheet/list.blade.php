@extends('layouts.app')

@section('main_content')
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">PHP & Laravel 指令速查表</h1>
        <p class="text-gray-500">開發時最常用的終端機指令與語法整理</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">💻</span>
                <h2 class="text-xl font-bold">Artisan 指令</h2>
            </div>
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('detail', 1) }}" target="_blank"
                        class="hover:text-indigo-600 hover:underline transition">
                        <code class="bg-gray-100 px-2 py-1 rounded text-sm text-pink-600">php artisan serve</code>

                    </a>
                    <p class="text-xs text-gray-500 mt-1">啟動本地開發伺服器</p>

                </li>
                <li>
                    <code
                        class="bg-gray-100 px-2 py-1 rounded text-sm text-pink-600">php artisan make:controller Name</code>
                    <p class="text-xs text-gray-500 mt-1">快速建立控制器</p>
                </li>
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-pink-600">php artisan migrate</code>
                    <p class="text-xs text-gray-500 mt-1">執行資料庫遷移（建表）</p>
                </li>
            </ul>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">📦</span>
                <h2 class="text-xl font-bold">Composer</h2>
            </div>
            <ul class="space-y-3">
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-green-600">composer require [package]</code>
                    <p class="text-xs text-gray-500 mt-1">安裝新的擴充套件</p>
                </li>
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-green-600">composer install</code>
                    <p class="text-xs text-gray-500 mt-1">根據 lock 檔安裝所有套件</p>
                </li>
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-green-600">composer dump-autoload</code>
                    <p class="text-xs text-gray-500 mt-1">重新讀取類別對應（解決找不到類別問題）</p>
                </li>
            </ul>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">📖</span>
                <h2 class="text-xl font-bold">Swagger API</h2>
            </div>
            <ul class="space-y-3">
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-blue-600">php artisan l5-swagger:generate</code>
                    <p class="text-xs text-gray-500 mt-1">重新產生 Swagger JSON 文檔</p>
                </li>
                <li>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-blue-600">/api/documentation</code>
                    <p class="text-xs text-gray-500 mt-1">瀏覽器訪問文檔的預設路徑</p>
                </li>
            </ul>
        </div>

    </div>

    <div class="mt-10 text-center text-gray-400 text-sm">
        提示：按下 <kbd class="bg-gray-200 px-2 py-1 rounded shadow-inner text-gray-600">Ctrl + F</kbd> 可以在此頁面快速搜尋指令。
    </div>
@endsection