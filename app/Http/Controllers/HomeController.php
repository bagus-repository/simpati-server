<?php

namespace App\Http\Controllers;

use App\Models\Efilling;
use App\Models\Inbox;
use App\Models\Outbox;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $counter = (object)[
            'users' => User::active()->count(),
            'efilling' => Efilling::count(),
            'inboxes' => Inbox::count(),
            'outboxes' => Outbox::count(),
        ];
        return view('dashboard', compact('counter'));
    }

    public function redirect()
    {
        return redirect()->route('home.index');
    }
}
