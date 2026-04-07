@extends('layouts.app')

@section('main_content')
<div class="bg-white rounded-xl shadow-md p-8 max-w-2xl mx-auto">
    <a href="{{ route('todos.index') }}" class="text-indigo-600 mb-4 inline-block">← 返回列表</a>
    
    <h1 class="text-3xl font-bold mb-4">{{ $todo->title }}</h1>
    
    <div class="space-y-4 border-t pt-4 text-gray-600">
        <p><strong>狀態：</strong> {{ $todo->is_done ? '✅ 已完成' : '⏳ 進行中' }}</p>
        <p><strong>建立時間：</strong> {{ $todo->created_at->format('Y-m-d H:i:s') }}</p>
        <p><strong>最後更新：</strong> {{ $todo->updated_at->diffForHumans() }}</p>
    </div>
</div>
@endsection