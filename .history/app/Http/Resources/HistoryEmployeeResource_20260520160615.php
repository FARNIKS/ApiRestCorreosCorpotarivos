<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'nombre'        => $this->nombre,
            'departamento'  => $this->departamento,
            'empresa' => [
                'codigo' => $this->empresa_code,
                'nombre' => $this->branch?->company_name ?? 'Sin Empresa',
                'pais'   => $this->branch?->country?->name ?? 'Sin País',
            ],
            'fecha_envio'   => $this->fecha_envio ? $this->fecha_envio->format('Y-m-d H:i:s') : null,

        ];
    }
}
