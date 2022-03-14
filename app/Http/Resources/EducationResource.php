<?php

namespace App\Http\Resources;

use App\Models\Education;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
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
            'from_year' => $this->from_year,
            'to_year' => $this->to_year,
            'user' => new UserResource($this->user),
            'country' => new CountryResource($this->country)
        ];
    }

      public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}