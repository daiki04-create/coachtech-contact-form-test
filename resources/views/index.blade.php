@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="contact-container">
    <h2 class="contact-title">Contact</h2>
    
    <form action="/confirm" method="post" class="contact-form">
        @csrf
        
        <div class="form-group">
            <div class="form-label">
                <label>お名前<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <div class="input-name">
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 山田">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎">
                </div>
                @error('first_name') <p class="error">{{ $message }}</p> @enderror
                @error('last_name') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>性別<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <div class="input-gender">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>メールアドレス<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>電話番号<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <div class="input-tell">
                    <input type="text" name="tell_1" value="{{ old('tell_1') }}" placeholder="080"> - 
                    <input type="text" name="tell_2" value="{{ old('tell_2') }}" placeholder="1234"> - 
                    <input type="text" name="tell_3" value="{{ old('tell_3') }}" placeholder="5678">
                </div>
                @if($errors->has('tell_1') || $errors->has('tell_2') || $errors->has('tell_3'))
                    <p class="error">電話番号を正しく入力してください</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>住所<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                @error('address') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>建物名</label>
            </div>
            <div class="form-input">
                <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>お問い合わせの種類<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <div class="select-wrapper">
                    <select name="category_id">
                        <option value="" {{ old('category_id') == '' ? 'selected' : '' }} disabled>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category_id') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label>お問い合わせ内容<span class="required">※</span></label>
            </div>
            <div class="form-input">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                @error('detail') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-button">
            <button type="submit" class="submit-btn">確認画面へ</button>
        </div>
    </form>
</div>
@endsection