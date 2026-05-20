<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #334155;
            line-height: 1.6;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
        }

        .main-card {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.05);
            border: 1px solid #e2e8f0;
        }

        .header-gradient {
            background: #0f172a;
            padding: 30px 25px;
            color: #ffffff;
            border-bottom: 4px solid #3182ce;
        }

        .header-gradient h2 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .header-date {
            font-size: 11px;
            opacity: 0.8;
            margin-top: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 30px 25px;
        }

        .status-container {
            text-align: center;
            margin-bottom: 25px;
            width: 100%;
        }

        .status-badge {
            display: inline-block;
            background-color: #ebf8ff;
            color: #2b6cb0;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-box {
            background-color: #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #e2e8f0;
        }

        .summary-text {
            font-size: 15px;
            color: #334155;
            margin: 0;
        }

        /* --- CORRECCIÓN AQUÍ: Flexbox para alinear el emoji --- */
        .alert-box {
            background-color: #fffbeb;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #fef3c7;
            display: flex;
            align-items: flex-start;
            /* Alinea al inicio verticalmente */
        }

        .alert-icon {
            font-size: 16px;
            margin-right: 10px;
            line-height: 1.6;
            /* Sincronizado con el line-height del texto */
            user-select: none;
        }

        .alert-text {
            font-size: 13.5px;
            color: #92400e;
            margin: 0;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 25px;
            font-size: 11px;
            color: #64748b;
            background-color: #f8fafc;
            border-top: 1px solid #f1f5f9;
        }

        .footer-brand {
            color: #475569;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="main-card">
        <div class="header-gradient">
            <h2>{{ $config->title }}</h2>
            <div class="header-date">Reporte Consolidado Semanal • {{ now()->format('d/m/Y') }}</div>
        </div>

        <div class="content">
            <div class="status-container">
                <div class="status-badge">Sin Novedades</div>
            </div>

            <div class="summary-box">
                <div class="summary-text">
                    {!! nl2br(e($config->intro_text)) !!}
                </div>
            </div>

            <div class="alert-box">
                <div class="alert-icon">⚠️</div>
                <div class="alert-text">
                    <strong>Nota de control:</strong> {!! nl2br(e($config->closing_text)) !!}
                </div>
            </div>
        </div>

        <div class="footer">
            <span class="footer-brand">{{ $config->sign_off }}</span><br>
            Este es un reporte automático generado para el departamento de Recursos Humanos.
        </div>
    </div>
</body>

</html>
