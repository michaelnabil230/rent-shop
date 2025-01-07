<?php

declare(strict_types=1);

namespace App\Bootstrap;

use Illuminate\Console\Scheduling\Schedule;

final class ScheduleBootstrapper
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('/logs/queue-jobs.log'));

        $schedule->command('model:prune')->daily();
        $schedule->command('auth:clear-resets')->everyFifteenMinutes();

        $schedule->command('telescope:prune')->daily();

        $schedule->command('backup:clean')->weeklyOn(1, '6:30');
        $schedule->command('backup:run')->weeklyOn(1, '7:00');
    }
}
