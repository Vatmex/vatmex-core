<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Resources\RosterResource;
use App\Models\ATC;
use App\Models\User;

class RosterController extends ApiController
{
    public function index()
    {
        $users = User::has('atc')->get();

        return $this->successResponse(RosterResource::collection($users), 'Returning all roster records');
    }

    public function show($id)
    {
        $user = User::where('cid', $id)->first();

        // Check if User exists AND has a valid ATC Profile
        if (! $user || ! $user->atc) {
            return $this->errorResponse('CID not found in roster', 404);
        }

        return $this->successResponse(new RosterResource($user), 'Roster record found');
    }
}
