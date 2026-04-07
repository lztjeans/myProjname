@extends('layouts.app')

@section('main_content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">待辦事項管理</h1>

        <form id="add-todo-form" class="flex gap-2 mb-8">
            <input type="text" id="todo-title"
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="今天想挑戰什麼？" required>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                新增
            </button>
        </form>

        <div class="overflow-x-auto">
            @if (count($allTodos) == 0)
                <div class="bg-blue-50 p-4 rounded-lg text-blue-800 text-center">
                    🎉 太棒了！所有任務都處理完了。
                </div>
            @endif
            <table class="w-full text-left" id="todo-table">
                <thead>
                    <tr class="text-gray-400 text-sm uppercase tracking-wider border-b">
                        <th class="pb-3 px-2">任務內容</th>
                        <th class="pb-3 px-2">狀態</th>
                        <th class="pb-3 px-2">建立時間</th>
                        <th class="pb-3 px-2">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($allTodos as $todo)
                        <tr id="todo-row-{{ $todo->id }}" class="hover:bg-gray-50 transition">
                            <td class="todo-title py-4 px-2 {{ $todo->is_done ? 'done-text' : 'text-gray-700' }}">
                                <a href="{{ route('todos.show', $todo->id) }}" target="_blank"
                                    class="hover:text-indigo-600 hover:underline transition">
                                    {{ $todo->title }}
                                </a>
                            </td>
                            <td class="todo-status py-4 px-2 text-sm">
                                @if($todo->is_done)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">已完成</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">進行中</span>
                                @endif
                            </td>
                            <td class="todo-cretime py-4 px-4 text-sm text-gray-500">
                                {{ $todo->created_at->format('Y-m-d H:i') }}
                            <td class="py-4 px-2 space-x-2">
                                <button class="btn-update text-indigo-600 hover:text-indigo-800 text-sm font-medium"
                                    data-id="{{ $todo->id }}">
                                    {{ $todo->is_done ? '重啟' : '完成' }}
                                </button>
                                <button class="btn-delete text-red-500 hover:text-red-700 text-sm font-medium"
                                    data-id="{{ $todo->id }}">
                                    刪除
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-2 text-center text-gray-500">
                                暫無待辦事項
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function () {
        // 全域設定 AJAX 標頭，這樣就不必每次手動送 token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // --- 1. 更新狀態 (PATCH) ---
        $(document).on('click', '.btn-update', function () {
            let id = $(this).data('id');
            let $btn = $(this);
            let $row = $('#todo-row-' + id);

            $.ajax({
                url: '/todos/' + id,
                type: 'POST',
                data: { _method: 'PATCH' },
                success: function (res) {
                    // 動態更新 UI
                    $btn.text(res.is_done ? '重啟' : '完成');
                    $row.find('.todo-status').text(res.is_done ? '✅ 已完成' : '⏳ 進行中');
                    $row.find('.todo-title').toggleClass('done', res.is_done);
                    refreshPage()
                }
            });
        });

        // --- 2. 刪除任務 (DELETE) ---
        $(document).on('click', '.btn-delete', function () {
            if (!confirm('確定刪除嗎？')) return;

            let id = $(this).data('id');
            let $row = $('#todo-row-' + id);

            $.ajax({
                url: '/todos/' + id,
                type: 'POST',
                data: { _method: 'DELETE' },
                success: function () {
                    $row.fadeOut(300, function () { $(this).remove(); });
                    refreshPage()
                }
            });
        });

        // --- 3. 新增任務 (POST) ---
        $('#add-todo-form').on('submit', function (e) {
            e.preventDefault();
            let title = $('#todo-title').val();

            $.ajax({
                url: '/todos',
                type: 'POST',
                data: { title: title },
                success: function (res) {
                    // 這裡為了簡單直接重新整理頁面，或者你可以用 jQuery 動態 append 一個 <tr>
                    refreshPage()
                }
            });
        });
    });
    function refreshPage() {
        location.reload();
    }
</script>

<!-- <table>
    <thead>
        <tr>
            <th>編號</th>
            <th>任務名稱</th>
            <th>狀態</th>
            <th>建立時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTodos as $todo)
        <tr>
            <td>{{ $todo->id }}</td>
            <td class="{{ $todo->is_done ? 'done' : '' }}">
                {{ $todo->title }}
            </td>
            <td>
                {{ $todo->is_done ? '✅ 已完成' : '⏳ 進行中' }}
            </td>
            <td>{{ $todo->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    @if($allTodos->isEmpty())
        <p>目前沒有任何任務，快去新增一個吧！</p>
    @endif -->