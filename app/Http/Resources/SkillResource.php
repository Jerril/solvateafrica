<?php

namespace App\Http\Resources;

use App\Models\Skill;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'project_count' => $this->project_count,
            'user_count' => $this->user_count,
            'open_project_count' => $this->open_project_count,
            'active_job_count' => $this->active_job_count,
            'job_count' => $this->job_count,
            'is_active' => $this->is_active,
            'category' => new CategoryResource($this->category),
            'proficiency' => auth()->user()->skills()->findOrFail($this->id)->pivot->proficiency
        ];
    }

    public function offsetExists($offset) 
    {
        return (is_array($offset) || $offset instanceof ArrayAccess) && isset($this->resource[$offset]);
    }
}