<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Cheatsheets extends Model
{
    // 白名單
    // 將你允許透過 create() 或 update() 寫入的欄位名稱放進這個陣列
    // protected $fillable = [];
    //黑名單
    // 讓所有欄位都能寫入 (空陣列代表沒有被保護的欄位)
    protected $guarded = [];
}
