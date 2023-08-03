<?php

namespace App\Http\Controllers;

use App\Models\ATC;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    protected $airportList = ['MMAA', 'MMAN', 'MMAS', 'MMBT', 'MMCB', 'MMCE', 'MMCL', 'MMCM', 'MMCN', 'MMCP', 'MMCS', 'MMCT', 'MMCU', 'MMCV', 'MMCZ', 'MMDO', 'MMEP', 'MMES', 'MMGL', 'MMGM', 'MMHO', 'MMIA', 'MMIO', 'MMLM', 'MMLO', 'MMLP', 'MMLT', 'MMMA', 'MMMD', 'MMML', 'MMMM', 'MMMT', 'MMMV', 'MMMX', 'MMMY', 'MMMZ', 'MMNL', 'MMOX', 'MMPA', 'MMPB', 'MMPE', 'MMPG', 'MMPN', 'MMPQ', 'MMPR', 'MMPS', 'MMQT', 'MMRX', 'MMSD', 'MMSL', 'MMSM', 'MMSP', 'MMTC', 'MMTG', 'MMTJ', 'MMTM', 'MMTN', 'MMTO', 'MMTP', 'MMUN', 'MMVA', 'MMVR', 'MMZC', 'MMZH', 'MMZO', 'MMID', 'MMEX', 'MMZT', 'MMTY'];

    public function index()
    {
        $vatsim = Http::get('https://data.vatsim.net/v3/vatsim-data.json')->json();

        // Get all the pilots departing or arriving to/from Mexico airports and save them to an array
        $pilots = [];
        foreach ($vatsim['pilots'] as $pilot) {
            if (isset($pilot['flight_plan']['departure']) && $pilot['flight_plan']['arrival']) {
                if (str_starts_with($pilot['flight_plan']['departure'], 'MM') || str_starts_with($pilot['flight_plan']['arrival'], 'MM')) {
                    array_push($pilots, $pilot);
                }
            }
        }
        $pilotsOnline = count($pilots);

        // Get an array of all the mexico controllers online
        $controllersOnline = [];
        foreach ($vatsim['controllers'] as $controller) {
            if (str_starts_with($controller['callsign'], 'MM')) {
                if (! substr($controller['callsign'], -3, 3) == 'OBS') { // Filter observers (Yes, it happens)
                    array_push($controllersOnline, $controller);
                }
            }
        }

        // Then go through all airports and count the flights for the aiport
        // TODO: Add controller status
        $airportStats = [];
        foreach ($this->airportList as $airport) {
            $departures = 0;
            $arrivals = 0;
            foreach ($pilots as $pilot) {
                if ($pilot['flight_plan']['departure'] == $airport) {
                    $departures++;
                } elseif ($pilot['flight_plan']['arrival'] == $airport) {
                    $arrivals++;
                }
            }

            $data = ['icao' => $airport, 'flights' => $departures + $arrivals, 'departures' => $departures, 'arrivals' => $arrivals];
            array_push($airportStats, $data);
        }

        // Sort the airports by most traffic.
        usort($airportStats, function ($a, $b) {
            return $b['flights'] <=> $a['flights'];
        });

        // Get all ATCs and sum the hours for this and past month
        $atcs = ATC::all();

        $currentMonthHours = 0;
        $lastMonthHours = 0;
        foreach ($atcs as $atc) {
            $currentMonthHours += $atc->current_months_hours;
            $lastMonthHours += $atc->last_month_hours;
        }

        // Get the controllers of the month
        $controllerOfTheMonthCurrent = $atcs->sortByDesc('current_months_hours')->first();
        $controllerOfTheMonthPast = $atcs->sortByDesc('last_month_hours')->first();

        return view('dashboard.index', compact('currentMonthHours', 'lastMonthHours', 'pilotsOnline', 'controllersOnline', 'controllerOfTheMonthCurrent', 'controllerOfTheMonthPast', 'airportStats'));
    }
}
