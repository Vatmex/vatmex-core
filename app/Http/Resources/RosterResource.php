<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RosterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cid' => $this->cid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'initials' => $this->atc->initials,
            'inactive' => $this->atc->inactive,
            'rating' => $this->atc->rank,
            'delivery' => $this->atc->delivery,
            'ground' => $this->atc->ground,
            'tower' => $this->atc->tower,
            'approach' => $this->atc->approach,
            'center' => $this->atc->center,
            'oceanic' => $this->atc->oceanic,
            'management' => $this->atc->management,
            'current_month_hours' => $this->atc->current_month_hours,
            'last_month_hours' => $this->atc->last_month_hours
        ];
    }
}
