<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "istedigimi" => 'eklerim',
            "id" => $this->id,
            "user_id" => $this->user_id,
            "category_id" => $this->category_id,
            "title" => $this->title,
            "content" => $this->content,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            'user' => $this->whenLoaded('user'),
            'category' => $this->whenLoaded('category'),
        ];
    }
}
