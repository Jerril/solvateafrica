<?php

namespace App\Http\Resources;

use App\Models\Certification;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificationResource extends JsonResource
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
            'year' => $this->year,
            'conferring_organization' => $this->conferring_organization,
            'user' => new UserResource($this->user)
        ];
    }

      public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}
