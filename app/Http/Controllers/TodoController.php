<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class TodoController extends BaseController
{
    #[OA\Get(
        path: '/api/todos',
        summary: '取得所有待辦事項清單',
        tags: ['Todos'],
        responses: [
            new OA\Response(response: 200, description: '成功回傳清單')
        ]
    )]
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todo_list', ['allTodos' => $todos]);
    }


    // public function store_origin(Request $request)
    // {
    //     $request->validate(['title' => 'required|max:255']);
    //     Todo::create([
    //         'title' => $request->title,
    //         'is_done' => false
    //     ]);
    //     return redirect()->back();
    // }
    #[OA\Post(
        path: '/api/todos',
        summary: '新增一筆待辦事項',
        tags: ['Todos'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'title', type: 'string', example: '學習 Laravel Swagger')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: '建立成功'),
            new OA\Response(response: 422, description: '驗證錯誤')
        ]
    )]
    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $todo = Todo::create([
            'title' => $request->title,
            'is_done' => false
        ]);
        return response()->json($todo);
    }

    // U - Update: 切換完成狀態

    // public function update_origin(Todo $todo)
    // {
    //     $todo->update(['is_done' => !$todo->is_done]);
    //     return redirect()->back();
    // }

    #[OA\Patch(
        path: '/api/todos/{todo}',
        summary: '切換待辦事項完成狀態',
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                in: 'path',
                description: '待辦事項的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '狀態更新成功'),
            new OA\Response(response: 404, description: '找不到該項目')
        ]
    )]
    public function update(Todo $todo)
    {
        $todo->update(['is_done' => !$todo->is_done]);
        return response()->json([
            'is_done' => $todo->is_done
        ]);
    }

    // D - Delete: 刪除
    // public function destroy_origin(Todo $todo)
    // {
    //     $todo->delete();
    //     return redirect()->back();
    // }

    #[OA\Delete(
        path: '/api/todos/{todo}',
        summary: '刪除指定的待辦事項',
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(
                name: 'todo',
                in: 'path',
                description: '待辦事項的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '刪除成功'),
            new OA\Response(response: 404, description: '找不到該項目')
        ]
    )]
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['success' => true]);
    }

    #[OA\Get(
        path: '/api/todos/{todo}',
        summary: '取得單一待辦事項細節',
        tags: ['Todos'],
        parameters: [
            new OA\Parameter(name: 'todo', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: '成功'),
            new OA\Response(response: 404, description: '找不到項目')
        ]
    )]
    public function show(Todo $todo)
    {
        // 回傳一個名為 todo_show.blade.php 的視圖，並傳入該筆資料
        return view('todo_show', ['todo' => $todo]);
    }
}
