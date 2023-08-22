<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AuditController extends Controller
{
    public function activityIndex()
    {
        $activities = Activity::all();

        return view('dashboard.activity.index', compact('activities'));
    }
}
