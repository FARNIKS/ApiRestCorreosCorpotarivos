<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\NewEmployee;
use App\Http\Requests\Employees\StoreNewEmployeeRequest;
use App\Http\Requests\Employees\UpdateNewEmployeeRequest;
use App\Http\Resources\NewEmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class NewEmployeeController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        // Cargamos branch y country de una vez para que sea rápido
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

    public function store(StoreNewEmployeeRequest $request): JsonResponse
    {
        try {
            return DB::transaction(function () use ($request) {
                $validated = $request->validated();

                // Aseguramos que enviado siempre sea false al crear
                $validated['enviado'] = $validated['enviado'] ?? false;

                $employee = NewEmployee::create($validated);

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Empleado registrado correctamente',
                    'data'    => new NewEmployeeResource($employee->load(['branch.country']))
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al registrar el empleado: ' . $e->getMessage(),
                'file'    => $e->getFile(), // 👈 Añade esto temporalmente
                'line'    => $e->getLine(),
            ], 500);
        }
    }


    public function show(NewEmployee $newEmployee): NewEmployeeResource
    {
        // Cargamos relaciones para que el Resource tenga toda la info
        return new NewEmployeeResource($newEmployee->load(['branch.country']));
    }

    /**
     * Actualizar datos del empleado.
     */
    public function update(UpdateNewEmployeeRequest $request, NewEmployee $newEmployee): JsonResponse
    {
        try {
            $newEmployee->update($request->validated());

            return response()->json([
                'status'  => 'success',
                'message' => 'Datos actualizados correctamente',
                'data'    => new NewEmployeeResource($newEmployee->load(['branch.country']))
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al actualizar: ' . $e->getMessage()
            ], 500);
        }
    }


    public function destroy(NewEmployee $newEmployee): JsonResponse
    {
        try {
            $newEmployee->delete();
            return response()->json([
                'status'  => 'success',
                'message' => 'Registro eliminado permanentemente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'No se pudo eliminar el registro'
            ], 500);
        }
    }
}
