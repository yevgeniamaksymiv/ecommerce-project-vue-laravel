<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'products' => $this->products,
            'order_id' => $this->id,
            'delivery_address' => $this->delivery_address,
            'order_amount' => $this->order_amount,
            'user_id' => $this->user_id,
            'delivery_id' => $this->delivery_id,
        ];
    }
}
