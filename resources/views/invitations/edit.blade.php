@extends('layouts.app')

@section('title', '招待状編集')

@section('content')
    <div class="card">
        <h1>招待状編集 #{{ $invitation->id }}</h1>
        <p class="muted">所有者 user_id: {{ $invitation->user_id }}（ログイン中: {{ auth()->id() }}）</p>
        <form method="POST" action="{{ route('invitations.update', $invitation) }}">
            @csrf
            @method('PUT')
            <label for="title">タイトル</label>
            <input id="title" name="title" value="{{ old('title', $invitation->title) }}">

            <label for="guest_email">ゲストメール</label>
            <input id="guest_email" name="guest_email" value="{{ old('guest_email', $invitation->guest_email) }}">

            <label for="body">本文</label>
            <textarea id="body" name="body" rows="5">{{ old('body', $invitation->body) }}</textarea>

            <label for="status">状態</label>
            <select id="status" name="status">
                <option value="draft" @selected(old('status', $invitation->status) === 'draft')>draft</option>
                <option value="published" @selected(old('status', $invitation->status) === 'published')>published</option>
            </select>

            <div style="margin-top:16px;" class="actions">
                <button type="submit">更新</button>
                <a class="btn btn-secondary" href="{{ route('invitations.index') }}">戻る</a>
            </div>
        </form>
    </div>
@endsection
