<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'body'  => $this->body,
            'created_at' => $this->created_at,
            'status'    => $this->status
        ];
    }

    public function with($request){
        return [
            'version'       => '1.0.1',
            'author_url'    => 'https://avalonbg.com'
        ];
    }
}
