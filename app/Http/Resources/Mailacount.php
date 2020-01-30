<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Mailacount extends JsonResource
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
            'user_id' => $this->user_id,
            'created_at'  => $this->created_at,
            'updated_at' => $this->updated_at,
            'host'  => $this->host,
            'port' => $this->port,
            'encryption' => $this->encryption,
            'validate_cert' => $this->validate_cert,
            'username' => $this->username,
            'password' => $this->password,
            'protocol' => $this->protocol
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
