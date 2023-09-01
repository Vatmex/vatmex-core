<?php

namespace App\Console\Commands;

use App\Models\ATC;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateATCRanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atc:ranks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the Vatsim Rank for all controllers on the roster';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controllers = ATC::all();

        foreach ($controllers as $controller) {
            $controllerInfo = Http::get('https://api.vatsim.net/v2/members/'.$controller->user->cid);

            if ($controllerInfo->getStatusCode() == 200) {
                $controller->rank = $controllerInfo['rating'];
                $controller->save();

                $this->info($controller->user->name.' is rating '.$controller->rank);
            } else {
                $this->error($controller->user->name.' CID was not found on Vatsim!');

                $controller->rank = 1;
                $controller->save();

                $this->info($controller->user->name.' is rating '.$controller->rank);
            }
        }

        return Command::SUCCESS;
    }
}
