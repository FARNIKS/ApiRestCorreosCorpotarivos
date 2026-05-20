<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\Birthdays\BirthdayConfigController;
use App\Http\Controllers\Api\Birthdays\NoBirthdayConfigController;
use App\Http\Controllers\Api\Employees\EmployeeController;
use App\Http\Controllers\Api\Employees\HistoryEmployeeController;
use App\Http\Controllers\Api\Employees\NewEmployeeController;
use App\Http\Controllers\Api\Location\BranchController;
use App\Http\Controllers\Api\Location\CountryController;
use App\Http\Controllers\Api\NewEmployeeReports\NewEmployeeReportConfigController;
use App\Http\Controllers\Api\NewEmployeeReports\NewEmployeeReportRhConfigController;
use App\Http\Controllers\Api\NewEmployeeReports\NoNewEmployeeReportRhConfigController;
use App\Http\Controllers\Api\Settings\BirthdaySettingsController;
use App\Http\Controllers\Api\Settings\FridayReportSettingsController;
use App\Http\Controllers\Api\Settings\MondayProcessSettingsController;
use App\Http\Resources\UserResource;

Route::prefix('v1')->group(function () {

    // --- RUTA PÚBLICA ---
    Route::post('login', [AuthController::class, 'login']);

    // --- RUTAS PROTEGIDAS (AUTENTICADAS) ---
    Route::middleware('auth:sanctum')->group(function () {

        // Gestión de Usuario Autenticado
        Route::get('user', fn(Request $request) => new UserResource($request->user()));
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('users', [AuthController::class, 'index']);

        // Empleados y Localización
        Route::get('history-employees', [HistoryEmployeeController::class, 'index']);
        Route::get('new-employees', [NewEmployeeController::class, 'index']);
        Route::get('new-employees/{newEmployee}', [NewEmployeeController::class, 'show']);
        Route::get('employees/departamentos', [EmployeeController::class, 'getDepartamentos']);

        Route::apiResources([
            'employees' => EmployeeController::class,
            'branches'  => BranchController::class,
            'countries' => CountryController::class,
        ]);

        // --- MÓDULO DE CONFIGURACIONES (LECTURA) ---
        Route::prefix('settings')->group(function () {
            // Estados generales
            Route::get('status', [BirthdaySettingsController::class, 'index']);
            Route::get('new-employees-friday-status', [FridayReportSettingsController::class, 'index']);
            Route::get('new-employees-monday-status', [MondayProcessSettingsController::class, 'index']);

            // Plantillas de Cumpleaños
            Route::get('birthday', [BirthdayConfigController::class, 'index']);
            Route::get('no-birthday', [NoBirthdayConfigController::class, 'index']);

            // Plantillas de Correos (Nuevos Ingresos)
            Route::get('new-employee-report', [NewEmployeeReportConfigController::class, 'index']);         // Correo 1
            Route::get('new-employee-report-rh', [NewEmployeeReportRhConfigController::class, 'index']);      // Correo 2
            Route::get('no-new-employee-report-rh', [NoNewEmployeeReportRhConfigController::class, 'index']); // Correo 3
        });

        // --- RUTAS EXCLUSIVAS PARA ADMINISTRADORES ---
        Route::middleware('admin')->group(function () {

            // Administración de Usuarios
            Route::post('register', [AuthController::class, 'register']);
            Route::patch('users/{user}', [AuthController::class, 'update']);
            Route::patch('users/status/{user}', [AuthController::class, 'toggleStatus']);

            // Escritura de Nuevos Empleados
            Route::post('new-employees', [NewEmployeeController::class, 'store']);
            Route::put('new-employees/{newEmployee}', [NewEmployeeController::class, 'update']);
            Route::delete('new-employees/{newEmployee}', [NewEmployeeController::class, 'destroy']);

            // --- ACCIONES DE CONFIGURACIÓN (ESCRITURA / PROCESOS) ---
            Route::prefix('settings')->group(function () {
                // Control de procesos automáticos
                Route::post('toggle-pause', [BirthdaySettingsController::class, 'toggleStatus']);
                Route::post('run-manual-send', [BirthdaySettingsController::class, 'runManualSend']);
                Route::post('new-employees-friday/toggle', [FridayReportSettingsController::class, 'toggleStatus']);
                Route::post('new-employees-friday/run', [FridayReportSettingsController::class, 'runManual']);
                Route::post('new-employees-monday/toggle', [MondayProcessSettingsController::class, 'toggleStatus']);
                Route::post('new-employees-monday/run', [MondayProcessSettingsController::class, 'runManual']);

                // Configuración de Cumpleaños
                Route::put('birthday', [BirthdayConfigController::class, 'update']);
                Route::post('birthday/restore', [BirthdayConfigController::class, 'restore']);
                Route::put('no-birthday', [NoBirthdayConfigController::class, 'update']);
                Route::post('no-birthday/restore', [NoBirthdayConfigController::class, 'restore']);

                // Configuración de Correos (Nuevos Ingresos)
                Route::put('new-employee-report', [NewEmployeeReportConfigController::class, 'update']);                  // Correo 1
                Route::post('new-employee-report/restore', [NewEmployeeReportConfigController::class, 'restore']);
                Route::put('new-employee-report-rh', [NewEmployeeReportRhConfigController::class, 'update']);               // Correo 2
                Route::post('new-employee-report-rh/restore', [NewEmployeeReportRhConfigController::class, 'restore']);
                Route::put('no-new-employee-report-rh', [NoNewEmployeeReportRhConfigController::class, 'update']);         // Correo 3
                Route::post('no-new-employee-report-rh/restore', [NoNewEmployeeReportRhConfigController::class, 'restore']);
            });
        });
    });
});
