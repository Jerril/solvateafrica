<?php

namespace App\Http\Resources;

use App\Models\Publication;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
            'publisher' => $this->publisher,
            'description' => $this->description,
            'user' => new UserResource($this->user),
        ];
    }

      public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}