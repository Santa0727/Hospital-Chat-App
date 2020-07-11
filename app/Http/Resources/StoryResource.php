<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
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
            'doctor' => User::find($this->doctor_id),
            'title' => $this->title,
            'description' => $this->description,
            'media_url' => $this->media_url,
            'media_type' => $this->media_type,
            'comments' => StoryCommentResource::collection($this->comments),
            'created_at' => $this->created_at->diffForHumans(),
            'diff' => $this->created_at->diffForHumans()
        ];
    }
}
