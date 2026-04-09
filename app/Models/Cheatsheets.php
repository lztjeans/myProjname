<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 修正 1: 補上正確的引入
use Illuminate\Database\Eloquent\Model;

class Cheatsheets extends Model
{
    use HasFactory; // 修正 2: 確保這行在類別最上方
    // protected $table = 'cheatsheet'; // 如果資料表名稱不是預設的複數形式，取消註解並指定正確的名稱
    // 白名單
    // 將你允許透過 create() 或 update() 寫入的欄位名稱放進這個陣列
    protected $fillable = [
        'category', 
        'commandName', 
        'description', 
        'creater', 
        'updater' // 確保你要更新的欄位都在這
    ];
    //黑名單
    // 讓所有欄位都能寫入 (空陣列代表沒有被保護的欄位)
    // protected $guarded = [];
}
