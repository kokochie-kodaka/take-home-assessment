<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '招待状下書き管理')</title>
    <style>
        :root {
            --bg: #f4f1ec;
            --card: #fff;
            --text: #222;
            --muted: #666;
            --line: #ddd4c8;
            --accent: #2f5d50;
            --danger: #a33;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Hiragino Sans", "Noto Sans JP", sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }
        header {
            background: var(--accent);
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a { color: #fff; }
        main { max-width: 880px; margin: 24px auto; padding: 0 16px; }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 16px 18px;
            margin-bottom: 14px;
        }
        .muted { color: var(--muted); font-size: 0.9rem; }
        .flash {
            background: #e8f5ef;
            border: 1px solid #b7dcc9;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 14px;
        }
        .error {
            background: #fdecec;
            border: 1px solid #f0c2c2;
            color: var(--danger);
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 14px;
        }
        label { display: block; font-weight: 600; margin: 10px 0 4px; }
        input, textarea, select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid var(--line);
            border-radius: 6px;
            font: inherit;
        }
        button, .btn {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            border: 0;
            border-radius: 6px;
            padding: 8px 14px;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }
        .btn-secondary { background: #6b7280; }
        .btn-danger { background: var(--danger); }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid var(--line); padding: 10px 6px; text-align: left; vertical-align: top; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .comments { margin-top: 6px; font-size: 0.85rem; color: var(--muted); }
    </style>
</head>
<body>
    <header>
        <div>招待状下書き管理（課題用アプリ）</div>
        @auth
            <div>
                {{ auth()->user()->name }} /
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" style="background:transparent;border:0;color:#fff;text-decoration:underline;cursor:pointer;padding:0;">ログアウト</button>
                </form>
            </div>
        @endauth
    </header>
    <main>
        @if (session('status'))
            <div class="flash">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="error">
                <ul style="margin:0;padding-left:1.2em;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
