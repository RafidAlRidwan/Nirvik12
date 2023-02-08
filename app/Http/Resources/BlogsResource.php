<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description'=> $this->description,
            'attachment'=> env('APP_URL').$this->attachment,
            'status'=>$this->status,
            'read_count'=>$this->read_count,
            'posted_by'=> $this->user ? $this->user->name : ''
        ];
    }
}
