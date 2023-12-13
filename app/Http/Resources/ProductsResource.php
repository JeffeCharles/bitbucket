<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

    return [
        'id' => (string)$this->id,
        'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'augstums' => $this->augstums,
                'garums' => $this->garums,
                'svars' => $this->svars,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'id' => (string) $this->user->id,
                'user name' => $this->user->name,
                'user email' => $this->user->email
            ],
        ];

    }
}
