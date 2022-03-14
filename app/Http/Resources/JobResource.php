<?php

namespace App\Http\Resources;

use App\Models\Job;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'job_description' => $this->job_description,
            'milestone' => $this->milestone,
            'price_budget' => $this->price_budget,
            'category' => $this->category,
            'job_type' => $this->job_type,
            'skill' => $this->skill,
            'user' => new UserResource($this->user)
        ];
    }

      public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}
