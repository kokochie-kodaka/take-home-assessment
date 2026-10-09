<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function index(): View
    {
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
        $invitation->delete();

        return redirect()
            ->route('invitations.index')
            ->with('status', '招待状を削除しました。');
    }
}
