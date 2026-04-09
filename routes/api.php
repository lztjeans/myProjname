<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;


Route::get('/db-test', function () {
    // 1. 新增資料
    $newTodo = new Todo();
    $newTodo->title = '學習 Laravel 資料庫';
    $newTodo->is_done = false;
    $newTodo->save();

    // 2. 讀取所有資料
    $allTodos = Todo::all();
    return $allTodos; // 瀏覽器會顯示 JSON 格式的資料
});

use App\Http\Controllers\CheatsheetController;
// Route::Post('/cheatsheets/create', [CheatsheetController::class, 'store'])->name('create');
// Route::patch('/cheatsheets/{cheatsheet}', [CheatsheetController::class, 'update'])->name('update');
// 新增
Route::post('/cheatsheets', [CheatsheetController::class, 'store']);
// 更新
Route::put('/cheatsheets/{cheatsheet}', [CheatsheetController::class, 'update']);
//刪除
Route::delete('/cheatsheets/{id}/{creater}', [CheatsheetController::class, 'destroy'])->name('delete');


use App\Http\Controllers\TodoController;
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');    // 新增資料
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update'); // 更新狀態
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy'); // 刪除資料
// R - Read (Single): 顯示單一項目的詳細資訊
Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show');

