<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 課題用コントローラです。意図的に問題のある実装を含みます。
 * 候補者の方は CHALLENGE.md を読んで修正してください。
 */
class InvitationController extends Controller
{
    public function index(): View
    {
        // BUG-2: N+1 を誘発しやすい読み方（eager load していない）
        $invitations = Invitation::query()
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('invitations.index', compact('invitations'));
    }

    public function create(): View
    {
        return view('invitations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // BUG-1: バリデーション不足（空文字・不正メール・不正 status を許可してしまう）
        $invitation = new Invitation();
        $invitation->user_id = Auth::id();
        $invitation->title = $request->input('title');
        $invitation->guest_email = $request->input('guest_email');
        $invitation->body = $request->input('body');
        $invitation->status = $request->input('status', 'draft');
        $invitation->save();

        return redirect()
            ->route('invitations.index')
            ->with('status', '招待状を作成しました。');
    }

    public function edit(Invitation $invitation): View
    {
        return view('invitations.edit', compact('invitation'));
    }

    public function update(Request $request, Invitation $invitation): RedirectResponse
    {
        // BUG-3: 所有者チェックなし（他ユーザーの招待状を更新できてしまう）
        $invitation->title = $request->input('title');
        $invitation->guest_email = $request->input('guest_email');
        $invitation->body = $request->input('body');
        $invitation->status = $request->input('status', $invitation->status);
        $invitation->save();

        return redirect()
            ->route('invitations.index')
            ->with('status', '招待状を更新しました。');
    }

    public function destroy(Invitation $invitation): RedirectResponse
    {
        // BUG-3: 所有者チェックなし（他ユーザーの招待状を削除できてしまう）
        $invitation->delete();

        return redirect()
            ->route('invitations.index')
            ->with('status', '招待状を削除しました。');
    }
}
