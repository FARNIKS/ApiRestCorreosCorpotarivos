<?php

namespace App\Services;

use App\Models\NewEmployee;
use App\Models\WelcomeMessage;

class NewEmployeeMailService
{
    public function getProcessedNewEmployees(): ?array
    {
        $phrase = WelcomeMessage::inRandomOrder()->first()?->phrase
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
            'newEmployees' => $groupedData, // Nombre correcto solicitado
            'raw_collection' => $newEmployees
        ];
    }
}
