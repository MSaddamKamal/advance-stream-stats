<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'data' => $this->collection->map(function ($item) {
                return [
                    'title' => $item->title,
                    'statistics' => $item->statistics,
                    'type' => $item->type,

                ];
            }),

            'message' => 'Success'


        ];
    }
}
