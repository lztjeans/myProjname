@extends('layouts.app')
@section('main_content')
    <form>
        <div class="mb-10">
            類別： 　　<select name="category" class="font-bold text-gray-800 mb-2">
                <option {{ $cheatsheet->category == 'Artisan 指令' ? 'selected' : '' }}>Artisan 指令</option>
                <option {{ $cheatsheet->category == 'Composer' ? 'selected' : '' }}>Composer</option>
                <option {{ $cheatsheet->category == 'Swagger API' ? 'selected' : '' }}>Swagger API</option>
            </select></p>
            指令名稱： <input name="commandName" value="{{ $cheatsheet->commandName }}" class="text-gray-500" placeholder="指令名稱">
            </p>
            描述： 　　<input name="description" value="{{ $cheatsheet->description }}" class="text-gray-500" placeholder="描述">
            </p>
        </div>
        <div class="mb-10">
            <button type="reset" class="mt-4 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">重置</button>
            <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">儲存修改</button>
            <button type="button" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                onclick="window.history.back()">返回列表</button>
        </div>
    </form>
@endsection