
@extends('layouts.app') @section('main_content')
    <h2>這是首頁的特有內容</h2>
    <h1>使用者名稱：{{ $name }}</h1>
    <p>目前的等級：{{ $role }}</p>
    @if($role == '管理員')
        <button>進入後台</button>
    @else
        <p>你沒有權限訪問後台。</p>
    @endif
    <ul>
        @foreach($skills as $skill)
            <li>技能項目：{{ $skill }}</li>
        @endforeach
    </ul>
@endsection