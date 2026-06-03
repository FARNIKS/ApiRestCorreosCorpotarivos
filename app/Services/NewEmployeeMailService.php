<?php

namespace App\Services;

use App\Models\NewEmployee;
use App\Models\Message;

class NewEmployeeMailService
{
    public function getProcessedNewEmployees(): ?array
    {
        $phrase = Message::inRandomOrder()->first()?->phrase
            ?? "¡Bienvenidos a nuestro equipo!";

        $newEmployees = NewEmployee::with(['branch.country'])
            ->where('enviado', false)
            ->get();

        if ($newEmployees->isEmpty()) {
            return null;
        }

        $groupedData = $newEmployees->groupBy([
            fn($e) => $e->branch?->country?->name ?? 'Otros Países',
            fn($e) => $e->branch?->company_name ?? 'Empresa no asignada'
        ]);

        return [
            'phrase' => $phrase,
            'newEmployees' => $groupedData,
            'raw_collection' => $newEmployees
        ];
    }
}
