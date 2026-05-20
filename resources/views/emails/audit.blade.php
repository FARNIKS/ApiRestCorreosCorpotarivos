<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Integridad de Datos</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            padding: 40px 24px;
            color: #334155;
            margin: 0;
        }

        /* Contenedor principal elegante */
        .audit-card {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.03);
            border: 1px solid #e2e8f0;
        }

        /* Header con azul corporativo profundo */
        .audit-header {
            background-color: #0f172a;
            padding: 32px 35px;
            border-bottom: 3px solid #1e3a8a;
        }

        .audit-header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 6px 0;
            letter-spacing: -0.3px;
        }

        .audit-header p {
            color: #94a3b8;
            font-size: 14px;
            margin: 0 0 12px 0;
        }

        .audit-date {
            color: #38bdf8;
            font-size: 12.5px;
            font-weight: 500;
        }

        .audit-body {
            padding: 35px;
        }

        /* --- FILA DE MÉTRICAS PREMIUM --- */
        .metrics-row {
            display: flex;
            gap: 16px;
            margin-bottom: 30px;
        }

        .metric-box {
            flex: 1;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 20px;
        }

        /* Bordes de estado sutiles */
        .metric-box.critical {
            border-left: 4px solid #ef4444;
        }

        .metric-box.info {
            border-left: 4px solid #64748b;
        }

        .metric-box.action {
            border-left: 4px solid #2563eb;
        }

        .metric-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 6px;
            display: block;
        }

        .metric-value {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1;
        }

        .metric-value.red-text {
            color: #dc2626;
        }

        .metric-value.blue-text {
            color: #2563eb;
            font-size: 20px;
        }

        /* --- CONTENEDOR DE TABLA CUSTOM --- */
        .table-container-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #e2e8f0;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: #1e3a8a;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 14px 16px;
            vertical-align: middle;
        }

        .table-custom tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #334155;
            vertical-align: middle;
        }

        /* Filas alternas sutiles para facilitar lectura */
        .table-custom tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .emp-name {
            font-weight: 600;
            color: #0f172a;
        }

        .company-name {
            font-weight: 600;
            color: #475569;
        }

        /* Indicadores de error limpios sin pesadez visual */
        .status-text {
            font-weight: 600;
            font-size: 13.5px;
        }

        .status-text.error {
            color: #dc2626;
        }

        .status-text.warning {
            color: #d97706;
        }

        /* Footer técnico */
        .audit-footer {
            background-color: #f8fafc;
            padding: 20px 35px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="audit-card">
        <div class="audit-header">
            <h1>Calidad de Datos: Gestión de Personal</h1>
            <p>Reporte automático de colaboradores con fechas no registradas o rangos de edad inválidos."</p>
            <div class="audit-date">🕒 Generado el: {{ now()->format('d/m/Y') }}</div>
        </div>

        <div class="audit-body">

            <div class="table-container-custom">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th>Colaborador</th>
                            <th>Fecha en Sistema</th>
                            <th>Motivo de Alerta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auditRecords as $employee)
                            <tr>
                                <td class="company-name">{{ $employee->Empresa }}</td>
                                <td class="emp-name">{{ $employee->Nombre }}</td>
                                <td>
                                    @if ($employee->Cumple)
                                        {{ $employee->Cumple->format('d/m/Y') }} <span
                                            style="color: #64748b; font-size: 13px;">({{ $employee->Cumple->age }}
                                            años)</span>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic;">No registrada</span>
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($employee->Cumple))
                                        <span class="status-text warning">⚠️ Fecha no definida</span>
                                    @else
                                        <span class="status-text error">🚫 Edad fuera de rango lógico</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="audit-footer">
            <div> <strong>Este reporte excluye automáticamente registros marcados como "Dynamics Ax 2012</strong></div>
        </div>
    </div>
</body>

</html>
