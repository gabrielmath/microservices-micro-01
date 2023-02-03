<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'identify'   => $this->uuid,
            'name'       => $this->name,
            'url'        => $this->url,
            'category'   => new CategoryResource($this->category),
            'phone'      => $this->phone,
            'whatsapp'   => $this->whatsapp,
            'email'      => $this->email,
            'facebook'   => $this->facebook,
            'instagram'  => $this->instagram,
            'youtube'    => $this->youtube,
            'created_at' => Carbon::make($this->created_at)->format('d/m/Y')
        ];
    }
}
