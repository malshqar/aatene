<?php

namespace Modules\HubConnect\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => [
                'id' => $this->userable->id,
                'type' => class_basename($this->userable_type),
                'name' => $this->userable->name,
                'email' => $this->userable->email,
            ]
        ];
    }
}
