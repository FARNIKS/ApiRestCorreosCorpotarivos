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

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/user', function (Request $request) {
            return new \App\Http\Resources\UserResource($request->user());
        });
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/users', [AuthController::class, 'index']);

        Route::get('settings/status', [BirthdaySettingsController::class, 'index']);
        Route::get('settings/new-employees-friday-status', [FridayReportSettingsController::class, 'index']);
        Route::get('settings/new-employees-monday-status', [MondayProcessSettingsController::class, 'index']);

        /* --- RUTAS DE LECTURA (ACCESIBLES POR CUALQUIER USUARIO AUTENTICADO) --- */
        Route::prefix('settings')->group(function () {
            Route::get('/birthday', [BirthdayConfigController::class, 'index']);
            Route::get('/no-birthday', [NoBirthdayConfigController::class, 'index']);

            // Lectura de configuraciones de correos
            Route::get('/new-employee-report', [NewEmployeeReportConfigController::class, 'index']);       // Correo 1
            Route::get('/new-employee-report-rh', [NewEmployeeReportRhConfigController::class, 'index']);    // Correo 2
            Route::get('/no-new-employee-report-rh', [NoNewEmployeeReportRhConfigController::class, 'index']); // Correo 3
        });




        Route::get('new-employees', [NewEmployeeController::class, 'index']);
        Route::get('new-employees/{newEmployee}', [NewEmployeeController::class, 'show']);

        Route::apiResources([
            'employees' => EmployeeController::class,
            'branches'  => BranchController::class,
            'countries' => CountryController::class,
        ]);

        Route::get('employees/departamentos', [NewEmployeeController::class, 'getDepartamentos']);

        /* --- RUTAS EXCLUSIVAS PARA EL ADMINISTRADOR --- */
        Route::middleware('admin')->group(function () {

            Route::post('/register', [AuthController::class, 'register']);
            Route::patch('/users/{user}', [AuthController::class, 'update']);
            Route::patch('/users/status/{user}', [AuthController::class, 'toggleStatus']);

            Route::post('new-employees', [NewEmployeeController::class, 'store']);
            Route::put('new-employees/{newEmployee}', [NewEmployeeController::class, 'update']);
            Route::delete('new-employees/{newEmployee}', [NewEmployeeController::class, 'destroy']);

            Route::prefix('settings')->group(function () {

                Route::post('/toggle-pause', [BirthdaySettingsController::class, 'toggleStatus']);
                Route::post('/run-manual-send', [BirthdaySettingsController::class, 'runManualSend']);

                Route::put('/birthday', [BirthdayConfigController::class, 'update']);
                Route::post('/birthday/restore', [BirthdayConfigController::class, 'restore']);

                Route::put('/no-birthday', [NoBirthdayConfigController::class, 'update']);
                Route::post('/no-birthday/restore', [NoBirthdayConfigController::class, 'restore']);

                Route::post('/new-employees-friday/toggle', [FridayReportSettingsController::class, 'toggleStatus']);
                Route::post('/new-employees-friday/run', [FridayReportSettingsController::class, 'runManual']);

                Route::post('/new-employees-monday/toggle', [MondayProcessSettingsController::class, 'toggleStatus']);
                Route::post('/new-employees-monday/run', [MondayProcessSettingsController::class, 'runManual']);

                /* --- ACCIONES CORREO 1 (MÓDULO NUEVOS INGRESOS GENERAL) --- */
                Route::put('/new-employee-report', [NewEmployeeReportConfigController::class, 'update']);
                Route::post('/new-employee-report/restore', [NewEmployeeReportConfigController::class, 'restore']);

                /* --- ACCIONES CORREO 2 (MÓDULO REPORTE CON DATOS PARA RH) --- */
                Route::put('/new-employee-report-rh', [NewEmployeeReportRhConfigController::class, 'update']);
                Route::post('/new-employee-report-rh/restore', [NewEmployeeReportRhConfigController::class, 'restore']);

                /* --- ACCIONES CORREO 3 (MÓDULO REPORTE SIN DATOS PARA RH) --- */
                Route::put('/no-new-employee-report-rh', [NoNewEmployeeReportRhConfigController::class, 'update']);
                Route::post('/no-new-employee-report-rh/restore', [NoNewEmployeeReportRhConfigController::class, 'restore']);
            });
        });
    });
});
