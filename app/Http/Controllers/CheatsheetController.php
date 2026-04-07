<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cheatsheets;
use OpenApi\Attributes as OA;
use Illuminate\Support\Facades\Auth; // 記得引入 Auth 門面

class CheatsheetController extends BaseController
{
    #[OA\Get(
        path: '/cheatsheets/list',
        summary: '取得所有指令清單',
        tags: ['Cheatsheets'],
        responses: [
            new OA\Response(response: 200, description: '成功回傳清單')
        ]
    )]
    public function index()
    {
        $cheats = Cheatsheets::orderBy('created_at', 'desc')->get();
        return view('cheatsheet.list', ['allCheats' => $cheats]);
    }

    #[OA\Post(
        path: '/cheatsheets/create',
        summary: '新增一筆指令',
        tags: ['Cheatsheets'],
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
        $todo = CheatSheets::create([
            'title' => $request->title,
            'is_done' => false
        ]);
        return response()->json($todo);
    }

    #[OA\Patch(
        path: '/cheatsheets/{cheatsheet}',
        summary: '更新指令',
        tags: ['Cheatsheets'],
        parameters: [
            new OA\Parameter(
                name: 'cheatsheet',
                in: 'path',
                description: '指令的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '狀態更新成功'),
            new OA\Response(response: 404, description: '找不到該項目')
        ]
    )]
    public function update(CheatSheets $cheat)
    {
        $cheat->update(['is_done' => !$cheat->is_done]);
        return response()->json([
            'is_done' => $cheat->is_done
        ]);
    }

    #[OA\Delete(
        path: '/api/cheatsheets/{id}/{creater}', // 1. 路徑需包含所有參數
        summary: '刪除指定的指令',
        tags: ['Cheatsheets'],
        parameters: [
            new OA\Parameter(
                name: 'id', // 2. 與路徑中的 {id} 對應
                in: 'path',
                description: '指令的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
            new OA\Parameter(
                name: 'creater', // 3. 與路徑中的 {creater} 對應
                in: 'path',
                description: '建立者名稱',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '刪除成功'),
            new OA\Response(response: 404, description: '找不到該項目'),
            new OA\Response(response: 403, description: '權限不足')
        ]
    )]
    public function destroy($id, $creater) // 4. 參數需與路徑變數名稱一致
    {
        // 5. 根據 ID 與 建立者 進行邏輯判斷（安全性檢查）
        $cheat = Cheatsheets::where('id', $id)
            ->where('creater', $creater)
            ->first();

        if (!$cheat) {
            return response()->json(['message' => '找不到該項目或無權限'], 404);
        }

        $cheat->delete();
        return response()->json(['success' => true]);
    }

/**/


    #[OA\Delete(
        path: '/api/cheatsheets/{id}', // 1. 路徑變簡潔了，只需要 ID
        summary: '刪除指定的指令',
        tags: ['Cheatsheets'],
        security: [['sanctum' => []]], // 2. 在 Swagger 標註這需要身份驗證
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                description: '指令的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '刪除成功'),
            new OA\Response(response: 403, description: '權限不足：你不是建立者'),
            new OA\Response(response: 404, description: '找不到該項目')
        ]
    )]
    public function deleteById($id)
    {
        // 3. 從登入資訊取得當前使用者名稱
        $currentUserName = Auth::user()->name; 

        // 4. 查詢該 ID，且建立者必須是目前登入的人
        $cheat = Cheatsheets::where('id', $id)
                            ->where('creater', $currentUserName)
                            ->first();

        if (!$cheat) {
            // 為了安全，通常不告訴駭客是因為「找不到」還是「沒權限」
            return response()->json(['message' => '找不到該項目或您無權刪除'], 404);
        }

        $cheat->delete();
        return response()->json(['success' => true]);
    }

/** */

#[OA\Delete(
        path: '/api/cheatsheetsHeader/{id}',
        summary: '刪除指定的指令',
        tags: ['Cheatsheets'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                description: '指令的 ID',
                required: true,
                schema: new OA\Schema(type: 'integer')
            ),
            // --- 關鍵：將參數定義在 Header ---
            new OA\Parameter(
                name: 'X-Creater-Name', // 建議使用 X- 開頭的自定義 Header 名稱
                in: 'header',
                description: '建立者名稱',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: '刪除成功'),
            new OA\Response(response: 400, description: '缺少必要的 Header'),
            new OA\Response(response: 404, description: '找不到該項目')
        ]
    )]
    public function destroy_header(Request $request, $id)
    {
        // 2. 從 Header 取得資料
        $creater = $request->header('X-Creater-Name');

        if (!$creater) {
            return response()->json(['message' => 'Header 中缺少 X-Creater-Name'], 400);
        }

        // 3. 執行邏輯比對
        $cheat = Cheatsheets::where('id', $id)
                            ->where('creater', $creater)
                            ->first();

        if (!$cheat) {
            return response()->json(['message' => '找不到項目或無權限'], 404);
        }

        $cheat->delete();
        return response()->json(['success' => true]);
    }
/**
 $.ajax({
    url: '/api/cheatsheets/' + id,
    type: 'POST',
    data: { _method: 'DELETE' },
    headers: {
        'X-Creater-Name': 'JohnDoe' // 在這裡手動加入 Header
    },
    success: function(res) {
        console.log('刪除成功');
    }
});
 * 
 */


    #[OA\Get(
        path: '/cheatsheets/{cheatsheet}',
        summary: '取得單一指令細節',
        tags: ['Cheatsheets'],
        parameters: [
            new OA\Parameter(name: 'cheatsheet', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: '成功'),
            new OA\Response(response: 404, description: '找不到項目')
        ]
    )]
    public function find(Cheatsheets $cheat)
    {
        // 回傳一個名為 cheatsheet.detail.blade.php 的視圖，並傳入該筆資料
        return view('cheatsheet.detail', ['cheatsheet' => $cheat]);
    }
}
