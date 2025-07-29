<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskShare;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskShareController extends Controller
{
    public function generate(Task $task)
    {
        $this->authorize('view', $task);

        // Generuj token na 24h
        $token = Str::random(32);
        $expiresAt = Carbon::now()->addDay();

        $link = route('tasks.shared.show', $token);

        $share = TaskShare::create([
            'task_id' => $task->id,
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return redirect()->back()->with('share_link', $link);
    
    }

    public function show($token)
    {
        $share = TaskShare::where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->firstOrFail();

        $task = $share->task;

        return view('tasks.shared', compact('task'));
    }
}
