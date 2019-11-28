<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyCategory extends JsonResource
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
            'category'  => $this->category
        ];
    }

    public function with($request){
        return [
            'version'       => '1.0.1',
            'author_url'    => 'https://avalonbg.com'
        ];
    }
}
