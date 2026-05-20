<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\HistoryEmployee;
use App\Http\Resources\HistoryEmployeeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HistoryEmployeeController extends Controller
{
    /**
     * 📊 Listar todo el historial de bienvenida.
     */
    public function index(): AnonymousResourceCollection
    {
        // Traemos branch y country optimizados y ordenamos por los más recientes enviados
        $history = HistoryEmployee::with(['branch.country'])
            ->latest('fecha_envio')
            ->get();

        return HistoryEmployeeResource::collection($history);
    }

    /**
     * 🔍 Ver un registro específico del historial.
     */
    public function show(HistoryEmployee $historyEmployee): HistoryEmployeeResource
    {
        return new HistoryEmployeeResource($historyEmployee->load(['branch.country']));
    }
}
