@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('header-right')
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="logout-btn">ログアウト</button>
    </form>
@endsection

@section('content')
    <h2 style="text-align: center; margin-bottom: 30px;">Admin</h2>
    
    <form action="/admin/search" method="get" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレス" value="{{ request('keyword') }}">
        
        <select name="gender">
            <option value="all">全て</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit" class="search-btn">検索</button> 
        <button type="submit" formaction="/admin/export" class="export-btn">エクスポート</button>
        <a href="/admin" class="reset-btn">リセット</a>
    </form>

    <table class="admin-table">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
            <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content }}</td>
            <td>
                <a href="#modal-{{ $contact->id }}" class="detail-link">詳細</a>

                <div id="modal-{{ $contact->id }}" class="modal-overlay">
                    <div class="modal-window">
                        <a href="#" class="modal-close">&times;</a>
                        <h2>詳細内容</h2>
                        
                        <table class="modal-table">
                            <tr><th>お名前</th><td>{{ $contact->first_name }} {{ $contact->last_name }}</td></tr>
                            <tr><th>性別</th><td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td></tr>
                            <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
                            <tr><th>電話番号</th><td>{{ $contact->tell }}</td></tr>
                            <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
                            <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
                            <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content }}</td></tr>
                            <tr><th>お問い合わせ内容</th><td>{{ $contact->detail }}</td></tr>
                        </table>
                        
                        <div class="delete-btn-container">
                            <form action="/admin/delete" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="pagination-wrapper">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
@endsection