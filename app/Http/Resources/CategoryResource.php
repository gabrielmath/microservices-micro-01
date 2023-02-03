<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
//        return parent::toArray($request);
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->url,
            'description' => $this->description,
            'created_at'  => Carbon::make($this->created_at)->format('d/m/Y')
        ];
    }
}
