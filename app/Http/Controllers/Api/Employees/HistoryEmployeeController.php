<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\HistoryEmployee;
use App\Http\Resources\Employees\HistoryEmployeeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HistoryEmployeeController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $history = HistoryEmployee::with(['branch.country'])
            ->latest('fecha_envio')
            ->get();

        return HistoryEmployeeResource::collection($history);
    }
}
