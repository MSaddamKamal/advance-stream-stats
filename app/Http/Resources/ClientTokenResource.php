<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientTokenResource extends JsonResource
{

    protected $token;
    public function __construct($token, $collection=[])
    {
        parent::__construct($collection);
        $this->token = $token;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' =>true,
            'data' =>[
                'token' => $this->token
            ],
            'message' => 'Success'
        ];
    }

}
