<?php

namespace App\Console\Commands;

use App\Models\ATC;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateATCHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atc:hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the calculation of ATC hours for all controllers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controllers = ATC::all();

        foreach ($controllers as $controller) {
            $controllerSessions = Http::get('https://api.vatsim.net/v2/members/'.$controller->user->cid.'/atc?limit=500&offset=0');

            $currentMonthMinutes = 0;
            $lastMonthMinutes = 0;

            foreach ($controllerSessions['items'] as $session) {
                // Parse the dates with carbon
                $startTime = Carbon::parse($session['connection_id']['start']);
                $endTime = Carbon::parse($session['connection_id']['end']);

                $sessionDuration = $endTime->diffInMinutes($startTime);

                // Crunch the numbers for the current month.
                if ($startTime->isCurrentMonth() && $startTime->isCurrentYear()) {
                    // If the callsign is not from Mexico, don't crunch.
                    if (str_starts_with($session['connection_id']['callsign'], 'MM')) {
                        $currentMonthMinutes += $sessionDuration;
                    }
                }

                // Crunch the numbers for last month
                if ($startTime->isLastMonth() && $startTime->isCurrentYear()) {
                    // If the callsign is not from Mexico, don't crunch.
                    if (str_starts_with($session['connection_id']['callsign'], 'MM')) {
                        $lastMonthMinutes += $sessionDuration;
                    }
                }
            }

            $controller->current_month_hours = round($currentMonthMinutes / 60);
            $controller->last_month_hours = round($lastMonthMinutes / 60);
            $controller->save();

            $this->info($controller->user->name.' tiene '.$controller->current_month_hours.' horas este mes y '.$controller->last_month_hours.' horas el mes pasado!');
        }

        activity()
            ->causedByAnonymous()
            ->log('Updated ATC hours for all controllers');

        return Command::SUCCESS;
    }
}
