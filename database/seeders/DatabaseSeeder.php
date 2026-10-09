<?php

namespace Database\Seeders;

use App\Models\GuestComment;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $alice = User::query()->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
        ]);

        $bob = User::query()->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
        ]);

        foreach (range(1, 12) as $i) {
            $invitation = Invitation::query()->create([
                'user_id' => $alice->id,
                'title' => "Aliceの招待状 #{$i}",
                'guest_email' => "guest{$i}@example.com",
                'body' => "結婚式へのご招待です（{$i}）",
                'status' => $i % 2 === 0 ? 'published' : 'draft',
            ]);

            foreach (range(1, 5) as $j) {
                GuestComment::query()->create([
                    'invitation_id' => $invitation->id,
                    'author_name' => "ゲスト{$j}",
                    'body' => "コメント {$j} on invitation {$i}",
                ]);
            }
        }

        foreach (range(1, 3) as $i) {
            $invitation = Invitation::query()->create([
                'user_id' => $bob->id,
                'title' => "Bobの招待状 #{$i}",
                'guest_email' => "bob-guest{$i}@example.com",
                'body' => "Bobの下書きです（{$i}）",
                'status' => 'draft',
            ]);

            GuestComment::query()->create([
                'invitation_id' => $invitation->id,
                'author_name' => 'Bob Friend',
                'body' => 'Bob宛のコメント',
            ]);
        }
    }
}
