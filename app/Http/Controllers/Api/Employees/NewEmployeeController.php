<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\NewEmployee;
use App\Http\Resources\Employees\NewEmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class NewEmployeeController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $employees = NewEmployee::with(['branch.country'])->latest()->get();
        return NewEmployeeResource::collection($employees);
    }

    public function getCount(): JsonResponse
    {
        try {
            $count = NewEmployee::count();

            return response()->json([
                'status' => 'success',
                'data'   => [
                    'count' => $count
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener el conteo de empleados: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(NewEmployee $newEmployee): NewEmployeeResource
    {
        return new NewEmployeeResource($newEmployee->load(['branch.country']));
    }


    public function syncNow(Request $request): JsonResponse
    {
        try {
            $exitCode = Artisan::call('employees:sync-new');

            if ($exitCode === 0) {
                $output = Artisan::output();
                Log::info('Sincronización manual ejecutada con éxito: ' . $output);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Sincronización con AX completada exitosamente.',
                    'output'  => $output
                ], 200);
            }

            return response()->json([
                'status'  => 'warning',
                'message' => 'El comando terminó con un código de salida: ' . $exitCode
            ], 207);
        } catch (\Exception $e) {
            Log::error("Error en sincronización manual desde AX: " . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Fallo al ejecutar la sincronización: ' . $e->getMessage()
            ], 500);
        }
    }
}
