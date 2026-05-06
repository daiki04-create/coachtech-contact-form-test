@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Login</h2>
    
    <div class="login-card">
        <form action="/login" method="post">
            @csrf
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech1106">
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="button-container">
                <button type="submit" class="login-btn">ログイン</button>
            </div>
        </form>
    </div>
    
    <div class="auth-link">
        <a href="/register">登録はこちら</a>
    </div>
</div>
@endsection