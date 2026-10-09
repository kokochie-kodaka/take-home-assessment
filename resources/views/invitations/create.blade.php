@extends('layouts.app')

@section('title', '招待状作成')

@section('content')
    <div class="card">
        <h1>招待状作成</h1>
        <form method="POST" action="{{ route('invitations.store') }}">
            @csrf
            <label for="title">タイトル</label>
            <input id="title" name="title" value="{{ old('title') }}">

            <label for="guest_email">ゲストメール</label>
            <input id="guest_email" name="guest_email" value="{{ old('guest_email') }}">

            <label for="body">本文</label>
            <textarea id="body" name="body" rows="5">{{ old('body') }}</textarea>

            <label for="status">状態</label>
            <select id="status" name="status">
                <option value="draft">draft</option>
                <option value="published">published</option>
            </select>

            <div style="margin-top:16px;" class="actions">
                <button type="submit">保存</button>
                <a class="btn btn-secondary" href="{{ route('invitations.index') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
