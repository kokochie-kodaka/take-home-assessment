@extends('layouts.app')

@section('title', '招待状一覧')

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
            <div>
                <h1 style="margin:0;">招待状一覧</h1>
                <p class="muted" style="margin:6px 0 0;">自分の招待状とゲストコメントを表示します。</p>
            </div>
            <a class="btn" href="{{ route('invitations.create') }}">新規作成</a>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル / コメント</th>
                    <th>宛先</th>
                    <th>状態</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invitations as $invitation)
                    <tr>
                        <td>{{ $invitation->id }}</td>
                        <td>
                            <strong>{{ $invitation->title }}</strong>
                            {{-- BUG-2 再現用: ループ内で関連を都度参照 --}}
                            <div class="comments">
                                コメント {{ $invitation->guestComments->count() }}件:
                                @foreach ($invitation->guestComments as $comment)
                                    <div>・{{ $comment->author_name }}: {{ $comment->body }}</div>
                                @endforeach
                            </div>
                        </td>
                        <td>{{ $invitation->guest_email }}</td>
                        <td>{{ $invitation->status }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary" href="{{ route('invitations.edit', $invitation) }}">編集</a>
                                <form method="POST" action="{{ route('invitations.destroy', $invitation) }}" onsubmit="return confirm('削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
