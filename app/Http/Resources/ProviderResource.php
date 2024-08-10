<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'currency' => $this->currency,
            'email' => $this->email,
            'status' => $this->status,
            'registration_date' => $this->registration_date,
            'identification' => $this->identification,
            'reference' => $this->reference,
        ];
    }
}
