<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\HistoryEmployee;
use App\Http\Resources\HistoryEmployeeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HistoryEmployeeController extends Controller
{
    /**
     * 📊 Listar todo el historial de bienvenida (Solo lectura).
     */
    public function index(): AnonymousResourceCollection
    {
        // Traemos las relaciones locales optimizadas y ordenamos por los más recientes enviados
        $history = HistoryEmployee::with(['branch.country'])
            ->latest('fecha_envio')
            ->get();

        return HistoryEmployeeResource::collection($history);
    }
}
