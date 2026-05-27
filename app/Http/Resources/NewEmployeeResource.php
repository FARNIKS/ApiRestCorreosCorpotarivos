<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewEmployeeResource extends JsonResource
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
            'enviado'       => (bool) $this->enviado,
            'empresa' => [
                'codigo' => $this->empresa_code,
                'nombre' => $this->branch?->company_name ?? 'Sin Empresa',
                'pais'   => $this->branch?->country?->name ?? 'Sin País',
            ],
            'creado_el'     => $this->created_at?->format('Y-m-d'),
        ];
    }
}
