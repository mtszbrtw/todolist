<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DemoUserSeeder extends Seeder
{
    public function run()
    {
        // Tworzymy użytkownika demo
        $user = User::updateOrCreate(
            ['email' => 'demo@demo.pl'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('demo123'),
            ]
        );

        // Data seddowania = dziś
        $seedDate = Carbon::today();

        $dates = [
            $seedDate->copy()->subDays(1)->toDateString(), 
            $seedDate->copy()->subDays(2)->toDateString(), // 2 dni wstecz
            $seedDate->toDateString(),                     // dziś
            $seedDate->copy()->addDay()->toDateString(),  // jutro
            $seedDate->copy()->addDays(2)->toDateString(),// pojutrze
        ];

        $tasksData = [
            [
                'title' => 'Wysłać raport tygodniowy',
                'description' => 'Nie zapomnij dodać wykresów.',
                'priority' => 'high',
                'status' => 'to-do',
                'due_date' => $dates[0],
            ],
            [
                'title' => 'Zadzwonić do klienta',
                'description' => null,
                'priority' => 'medium',
                'status' => 'in-progress',
                'due_date' => $dates[1],
            ],
            [
                'title' => 'Zamówić materiały biurowe',
                'description' => 'Potrzebne długopisy, kartki i tusz do drukarki.',
                'priority' => 'low',
                'status' => 'done',
                'due_date' => $dates[2],
            ],
            [
                'title' => 'Zebrać dane do prezentacji',
                'description' => null,
                'priority' => 'medium',
                'status' => 'to-do',
                'due_date' => $dates[3],
            ],
            [
                'title' => 'Sprawdzić postępy zespołu',
                'description' => 'Upewnij się, że każdy zespół ukończył swój moduł.',
                'priority' => 'high',
                'status' => 'in-progress',
                'due_date' => $dates[4],
            ],
        ];

        foreach ($tasksData as $task) {
            $user->tasks()->updateOrCreate(
                ['title' => $task['title']], // unikamy duplikatów
                $task
            );
        }
    }
}