@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

<div class="confirm-container">
    <h2 class="confirm-title">Confirm</h2>
    
    <form action="/thanks" method="post">
        @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>
                    {{ $contact['first_name'] }} {{ $contact['last_name'] }}
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ $contact['email'] }}
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ $contact['tell'] }}
                    <input type="hidden" name="tell" value="{{ $contact['tell'] }}">
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ $contact['address'] }}
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    {{ $contact['building'] }}
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    {{ $contact['category_content'] }}
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    {{ $contact['detail'] }}
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                </td>
            </tr>
        </table>

        <div class="form-button">
            <button type="submit" class="submit-btn">送信</button>
            <button type="button" class="back-link" onclick="history.back()">修正</button>
        </div>
    </form>
</div>
@endsection