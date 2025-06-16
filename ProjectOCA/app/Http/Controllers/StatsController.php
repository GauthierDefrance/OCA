<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index() {


        $usersPerMonth = User::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $messagesPerMonth = Message::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $conversationsPerMonth = Conversation::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $usersPerDay = User::selectRaw("TO_CHAR(created_at, 'YYYY-MM-DD') as day, COUNT(*) as total")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $messagesPerDay = Message::selectRaw("TO_CHAR(created_at, 'YYYY-MM-DD') as day, COUNT(*) as total")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $conversationsPerDay = Conversation::selectRaw("TO_CHAR(created_at, 'YYYY-MM-DD') as day, COUNT(*) as total")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $activeUsersCount = User::where('last_activity', '>=', now()->subMinutes(5))->count();

        $stats = [
            'active_users' => $activeUsersCount,
            "nb_users" => User::count(),
            "nb_messages" => Message::count(),
            "nb_conversations" => Conversation::count(),
            'usersPerDay' => $usersPerDay,
            'messagesPerDay' => $messagesPerDay,
            'conversationsPerDay' => $conversationsPerDay,
            'usersPerMonth' => $usersPerMonth,
            'messagesPerMonth' => $messagesPerMonth,
            'conversationsPerMonth' => $conversationsPerMonth,
        ];

        return view('pages.statistics.index', compact('stats'));
    }
}
