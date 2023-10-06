<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
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
            'application' => [
                'id' => $this->id,
                'cid' => $this->user->cid,
                'name' => $this->user->name,
                'email' => $this->email,
                'message' => $this->message
            ]
        ];
    }
}
