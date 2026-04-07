<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Todo extends Model
{
        // 將你允許透過 create() 或 update() 寫入的欄位名稱放進這個陣列
        protected $fillable = [
            'title',
            'is_done',
        ];
}
