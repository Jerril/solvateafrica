<?php

namespace App\Http\Resources;

use App\Models\WorkProfile;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkProfileResource extends JsonResource
{
     /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'company' => $this->company,
            'from_month' => $this->from_month,
            'from_year' => $this->from_year,
            'to_month' => $this->to_month,
            'to_year' => $this->to_year,
            'user' => new UserResource($this->user)
        ];
    }

      public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}
