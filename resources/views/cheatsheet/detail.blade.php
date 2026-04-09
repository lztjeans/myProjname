@extends('layouts.app')

@section('main_content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">
            {{ $mode === 'create' ? '新增指令' : ($mode === 'edit' ? '編輯指令' : '指令細節') }}
        </h1>{{ $mode }}
        <span class="text-sm text-gray-500 mb-4 block">由 {{ $item->creater }} 建立於 {{ $item->created_at }}</span>
        <span class="text-sm text-gray-500 mb-4 block">ID: {{ $item->id }}</span>

        <div class="mb-4">
            <label>指令分類</label>
            <input type="text" id="category" value="{{ $item->category }}" {{ $mode === 'show' ? 'readonly disabled' : '' }} class="w-full border p-2 bg-gray-100">
        </div>

        <div class="mb-4">
            <label>指令名稱</label>
            <input type="text" id="title" value="{{ $item->commandName }}" {{ $mode === 'show' ? 'readonly disabled' : '' }}
                class="w-full border p-2 {{ $mode === 'show' ? 'bg-gray-100' : '' }}">
        </div>
        <div class="mb-4">
            <label>指令說明</label>
            <textarea id="description" {{ $mode === 'show' ? 'readonly disabled' : '' }}
                class="w-full border p-2 h-32 {{ $mode === 'show' ? 'bg-gray-100' : '' }}">{{ $item->description }}</textarea>

        <div class="mt-6">
            @if($mode === 'show')
                <a href="{{ route('cheatsheets.edit', $item->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">進入編輯模式</a>
            @else
                <button id="submit-btn" class="bg-green-500 text-white px-4 py-2 rounded">
                    {{ $mode === 'create' ? '立即建立' : '儲存修改' }}
                </button>
            @endif
            <a href="{{ route('cheatsheets.index') }}" class="ml-2 text-gray-500">返回列表</a>
        </div>
    </div>
{{-- 在 @endsection 之前加入 --}}
<input type="hidden" id="current-mode" value="{{ $mode }}">
<input type="hidden" id="item-id" value="{{ $item->id }}">

@push('scripts')
    @vite(['resources/js/cheatsheet.js'])
@endpush
@endsection