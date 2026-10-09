@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="card">
        <h1>ログイン</h1>
        <p class="muted">テスト用アカウント（パスワードはいずれも <code>password</code>）</p>
        <ul class="muted">
            <li>alice@example.com</li>
            <li>bob@example.com</li>
        </ul>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email', 'alice@example.com') }}" required>

            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" value="password" required>

            <div style="margin-top:16px;">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection
