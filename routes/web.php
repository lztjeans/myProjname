<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello_page');
});
Route::get('/profile', function () {
    return view('user_profile', [
        'name' => '大同',
        'role' => '網頁開發學徒',
        'skills' => ['PHP', 'Laravel', 'Vue'],
    ]);
});




use App\Http\Controllers\CheatsheetController;
Route::get('/cheatsheets/list', [CheatsheetController::class, 'index'])->name('cheatsheets.index');
Route::get('/cheatsheets/list2', [CheatsheetController::class, 'index2'])->name('cheatsheets.index2');
// 1. 新增頁面 (不需要 ID)
Route::get('/cheatsheets/create', [CheatsheetController::class, 'renderEditor'])->name('cheatsheets.create');
// 2. 詳細頁面 (唯讀)
Route::get('/cheatsheets/{cheatsheet}', [CheatsheetController::class, 'renderEditor'])->name('cheatsheets.show');
// 3. 編輯頁面 (可修改)
Route::get('/cheatsheets/{cheatsheet}/edit', [CheatsheetController::class, 'renderEditor'])->name('cheatsheets.edit');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::delete('/api/cheatsheets/{id}', [CheatsheetController::class, 'deleteById']);
// });


use App\Http\Controllers\TodoController;
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');     // 讀取清單
