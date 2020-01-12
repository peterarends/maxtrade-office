<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tasks extends JsonResource
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
            'project_id'    => $this->project_id,
            'title' => $this->title,
            'body'  => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status'    => $this->status,
            'decision' => $this->decision,
            'last_name' => $this->last_name,
            'last_id' => $this->last_id,
            'isfiles' => $this->isfiles
        ];
    }

    public function with($request)
    {
        return [
            'version'       => '1.0.1',
            'author_url'    => 'https://avalonbg.com'
        ];
    }
}