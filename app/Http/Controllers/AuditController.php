<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    public function activityIndex()
    {
        $activities = Activity::all();

        return view('dashboard.activity.index', compact('activities'));
    }
}
