<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'published_at' => Carbon::parse($this->published_at)->diffForHumans(),
            'user' => new UserResource($this->whenLoaded('user')),
            'comment' => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
