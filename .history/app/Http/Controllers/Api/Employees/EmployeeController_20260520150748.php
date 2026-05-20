<?php

namespace App\Http\Controllers\Api\Employees;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse; // Asegúrate de importar esto

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['branch.country'])
            ->orderBy('Nombre', 'asc')
            ->get();

        return EmployeeResource::collection($employees);
    }

    /**
     * 🔥 Trae todos los departamentos únicos sin repetirse para el formulario
     */
    public function getDepartamentos(): JsonResponse
    {
        try {
            $departamentos = Employee::query()
                ->select('Departamento')
                ->whereNotNull('Departamento')
                ->where('Departamento', '<>', '')
                ->distinct()
                ->orderBy('Departamento', 'asc')
                ->pluck('Departamento');

            return response()->json([
                'status' => 'success',
                'data'   => $departamentos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al obtener departamentos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Employee $employee): EmployeeResource
    {
        $employee->load(['branch.country']);
        return new EmployeeResource($employee);
    }
}
