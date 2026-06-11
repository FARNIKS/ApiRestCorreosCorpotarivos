<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>OBGROUP Automation Suite | Documentación Oficial</title>
    <!-- Font Awesome (CDN estable) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ---------- RESET Y BASE ---------- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(145deg, #eef2f6 0%, #e2e8f0 100%);
            line-height: 1.5;
            color: #0f172a;
        }

        /* ---------- UTILIDADES ---------- */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-3 {
            gap: 0.75rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-gray-600 {
            color: #475569;
        }

        .text-gray-700 {
            color: #334155;
        }

        .text-gray-800 {
            color: #1e293b;
        }

        .text-gray-500 {
            color: #64748b;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-bold {
            font-weight: 700;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .p-5 {
            padding: 1.25rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .rounded-xl {
            border-radius: 0.75rem;
        }

        .border {
            border: 1px solid #e2e8f0;
        }

        .bg-white {
            background: white;
        }

        .bg-gray-50 {
            background-color: #f8fafc;
        }

        .bg-gray-100 {
            background-color: #f1f5f9;
        }

        .bg-sky-50 {
            background-color: #f0f9ff;
        }

        .bg-gradient {
            background: linear-gradient(90deg, #f0f9ff, #eef2ff);
        }

        .overflow-x-auto {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .font-mono {
            font-family: 'SF Mono', 'Fira Code', monospace;
        }

        code {
            background-color: #0f172a;
            color: #e2e8f0;
            padding: 0.2rem 0.4rem;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            font-family: 'SF Mono', monospace;
        }

        /* ---------- COMPONENTES ---------- */
        .section-card {
            background: white;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.08), 0 2px 4px -2px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            margin-bottom: 2rem;
            /* Separación entre secciones */
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-card:hover {
            box-shadow: 0 25px 30px -12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, #0f2b3a 0%, #1e4a6e 100%);
            padding: 1.2rem 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .card-header i {
            font-size: 1.6rem;
            color: #7ab7d4;
            filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.1));
        }

        .card-header h2 {
            color: white;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* Texto dentro del header de API (base url) en blanco */
        .card-header .api-subtitle {
            color: #e2e8f0;
            font-size: 0.85rem;
            font-weight: 400;
            margin-left: 0.5rem;
        }

        .card-body {
            padding: 1.8rem;
        }

        /* Grid responsivo */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .grid-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Tarjeta interna */
        .inner-card {
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1.25rem;
            transition: all 0.25s ease;
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .inner-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(59, 130, 246, 0.1);
            border-color: #cbd5e1;
        }

        .badge-label {
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            color: #0369a1;
            font-size: 0.7rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            display: inline-block;
            font-weight: 600;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .inner-card h3 {
            font-family: monospace;
            font-weight: 700;
            margin-top: 0.75rem;
            color: #0c4a6e;
            font-size: 1.05rem;
            word-break: break-word;
        }

        .inner-card p {
            font-size: 0.875rem;
            color: #334155;
            margin-top: 0.5rem;
            line-height: 1.5;
        }

        /* Tabla API */
        .api-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
            min-width: 600px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        .api-table th,
        .api-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1.2rem;
            text-align: left;
            vertical-align: middle;
        }

        .api-table th {
            background-color: #f1f5f9;
            font-weight: 600;
            color: #0f172a;
            border-bottom-width: 2px;
            border-color: #cbd5e1;
        }

        .api-table tr:last-child td {
            border-bottom: none;
        }

        /* Colores métodos HTTP */
        .badge-method {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.3rem 0.8rem;
            border-radius: 999px;
            display: inline-block;
            min-width: 75px;
            text-align: center;
            letter-spacing: 0.3px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .bg-get {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e3a8a;
            border: 1px solid #bfdbfe;
        }

        .bg-post {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #14532d;
            border: 1px solid #bbf7d0;
        }

        .bg-put {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .bg-patch {
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        .bg-delete {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Fondos de fila por nivel de acceso */
        .bg-public {
            background-color: #f0fdf9;
        }

        .bg-authenticated {
            background-color: #ffffff;
        }

        .bg-admin {
            background-color: #f8fafc;
        }

        .text-green-700 {
            color: #166534;
        }

        .border-sky-500 {
            border-left: 4px solid #0ea5e9;
        }

        .text-sky-700 {
            color: #0369a1;
        }

        .underline {
            text-decoration: underline;
        }

        /* ---------- HEADER ---------- */
        .gradient-header {
            background: linear-gradient(135deg, #0a2b3c 0%, #164863 100%);
            color: white;
            box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-inner {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .icon-box {
            width: 2.8rem;
            height: 2.8rem;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-box i {
            font-size: 1.6rem;
            color: #a5d8ff;
        }

        .title h1 {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #fff, #b8e1fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .title p {
            font-size: 0.8rem;
            color: #cbdff2;
        }

        .badges {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .badge {
            background: rgba(56, 189, 248, 0.25);
            backdrop-filter: blur(4px);
            padding: 0.4rem 1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-family: monospace;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .badge-gray {
            background: rgba(100, 116, 139, 0.4);
        }

        /* ---------- SIDEBAR Y LAYOUT ---------- */
        .sidebar {
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.06);
            padding: 1.5rem;
            border: 1px solid #eef2ff;
            height: fit-content;
            transition: all 0.2s;
        }

        .sidebar:hover {
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.08);
        }

        .sidebar h3 {
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .sidebar ul {
            list-style: none;
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .sidebar li a {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: #334155;
            text-decoration: none;
            padding: 0.4rem 0;
            transition: all 0.2s;
            font-weight: 500;
            border-radius: 0.5rem;
        }

        .sidebar li a:hover {
            color: #0284c7;
            transform: translateX(4px);
        }

        .sidebar-footer {
            margin-top: 1.8rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .layout {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding: 2.5rem 1.5rem;
        }

        .main-content {
            flex: 1;
        }

        @media (min-width: 1024px) {
            .layout {
                flex-direction: row;
            }

            .sidebar {
                width: 280px;
                position: sticky;
                top: 6rem;
            }
        }

        @media (max-width: 1023px) {
            .layout {
                padding: 1.5rem 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-header {
                padding: 0.75rem 1rem;
            }

            .card-header h2 {
                font-size: 1.1rem;
            }

            .inner-card h3 {
                font-size: 0.9rem;
            }

            .api-table {
                font-size: 0.75rem;
            }

            .api-table th,
            .api-table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>

    <header class="gradient-header">
        <div class="container header-inner">
            <div class="logo-area">
                <div class="icon-box"><i class="fas fa-gem"></i></div>
                <div class="title">
                    <h1>OBGROUP Automation Suite</h1>
                    <p>Gestión integral de cumpleaños, bienvenidas y reportes RTHH</p>
                </div>
            </div>
            <div class="badges">
                <span class="badge"><i class="fas fa-tag mr-1"></i> v1.0</span>
                <span class="badge badge-gray"><i class="fas fa-calendar-alt mr-1"></i> 2025</span>
            </div>
        </div>
    </header>

    <div class="container layout">
        <aside class="sidebar">
            <h3><i class="fas fa-compass"></i> Índice</h3>
            <ul>
                <li><a href="#env"><i class="fas fa-key"></i> 1. Variables de entorno</a></li>
                <li><a href="#comandos"><i class="fas fa-terminal"></i> 2. Comandos Artisan</a></li>
                <li><a href="#schedule"><i class="fas fa-clock"></i> 3. Programador de tareas</a></li>
                <li><a href="#migraciones"><i class="fas fa-database"></i> 4. Migraciones</a></li>
                <li><a href="#semillas"><i class="fas fa-seedling"></i> 5. Datos iniciales</a></li>
                <li><a href="#api"><i class="fas fa-plug"></i> 6. API REST</a></li>
            </ul>
            <div class="sidebar-footer">
                <p><i class="fas fa-shield-alt"></i> Auth: Sanctum + LDAP</p>
                <p><i class="fas fa-envelope"></i> SMTP con App Password</p>
                <p><i class="fas fa-chart-line"></i> Quórum mínimo: 550 empleados</p>
            </div>
        </aside>

        <main class="main-content">
            <!-- 1. ENV -->
            <section id="env" class="section-card">
                <div class="card-header">
                    <i class="fas fa-key"></i>
                    <h2>1. Configuración del entorno (<span class="font-mono">.env</span>)</h2>
                </div>
                <div class="card-body">
                    <p class="text-gray-700 mb-6">Define las conexiones a bases de datos, servicio de correo y
                        autenticación LDAP. Reemplaza los placeholders con tus valores reales.</p>
                    <div class="grid-2">
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-database text-2xl text-blue-600"></i>
                                <h3 class="font-bold text-lg text-gray-800">Base de datos local</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Almacena histórico, sala de espera, configuraciones.
                                Soporta autenticación Windows o SQL Server Mixta.</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="font-mono text-sm">DB_CONNECTION=sqlsrv</div>
                                <div class="font-mono text-sm">DB_HOST=127.0.0.1</div>
                                <div class="font-mono text-sm">DB_PORT=1433</div>
                                <div class="font-mono text-sm">DB_DATABASE=CorporateHRP</div>
                                <div class="font-mono text-sm">DB_USERNAME=(vacío o usuario)</div>
                                <div class="font-mono text-sm">DB_PASSWORD=(vacío o contraseña)</div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Si usas Windows Auth, deja USERNAME/PASSWORD vacíos.
                            </p>
                        </div>
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-server text-2xl text-purple-600"></i>
                                <h3 class="font-bold text-lg text-gray-800">Base de datos AX</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Origen de empleados activos, fechas de ingreso y
                                cumpleaños. Solo lectura.</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="font-mono text-sm">DB_HOST_AX=IP_DEL_SERVIDOR_AX</div>
                                <div class="font-mono text-sm">DB_DATABASE_AX=Desarrollo_CRM_AX</div>
                                <div class="font-mono text-sm">DB_USERNAME_AX=usuario_consulta</div>
                                <div class="font-mono text-sm">DB_PASSWORD_AX=********</div>
                            </div>
                        </div>
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fab fa-google text-2xl text-red-500"></i>
                                <h3 class="font-bold text-lg text-gray-800">Correo SMTP (Gmail)</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Usa contraseña de aplicación, no la contraseña
                                personal.</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="font-mono text-sm">MAIL_MAILER=smtp</div>
                                <div class="font-mono text-sm">MAIL_HOST=smtp.gmail.com</div>
                                <div class="font-mono text-sm">MAIL_PORT=587</div>
                                <div class="font-mono text-sm">MAIL_USERNAME=tu_correo@gmail.com</div>
                                <div class="font-mono text-sm">MAIL_PASSWORD=contraseña_de_aplicacion</div>
                                <div class="font-mono text-sm">MAIL_ENCRYPTION=tls</div>
                                <div class="font-mono text-sm">MAIL_FROM_ADDRESS=tu_correo@gmail.com</div>
                                <div class="font-mono text-sm">MAIL_FROM_NAME="Notificaciones OBGROUP"</div>
                            </div>
                            <div class="bg-sky-50 p-3 rounded-lg mt-3 text-xs border-l-4 border-sky-500 shadow-sm">
                                <i class="fab fa-google text-red-500 mr-1"></i> <strong>¿Cómo obtener una contraseña de
                                    aplicación?</strong> Activa verificación en dos pasos → Seguridad → Contraseñas de
                                aplicaciones → "Correo" y "Otro".
                                <a href="https://support.microsoft.com/es-ES/accounts-billing/manage/how-to-get-and-use-app-passwords"
                                    target="_blank" class="text-sky-700 underline block mt-1">Más información
                                    (Microsoft)</a>
                            </div>
                        </div>
                        <div class="border rounded-xl p-5 bg-white shadow-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fas fa-lock text-2xl text-indigo-600"></i>
                                <i class="fas fa-ldap text-2xl text-indigo-600"></i>
                                <h3 class="font-bold text-lg text-gray-800">LDAP Active Directory</h3>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">Autenticación de usuarios contra el dominio
                                corporativo.</p>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="font-mono text-sm">LDAP_HOST="IP_CONTROLADOR_DOMINIO"</div>
                                <div class="font-mono text-sm">LDAP_USER='DOMINIO\usuario_lectura'</div>
                                <div class="font-mono text-sm">LDAP_PASSWORD="********"</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. COMANDOS ARTISAN -->
            <section id="comandos" class="section-card">
                <div class="card-header">
                    <i class="fas fa-terminal"></i>
                    <h2>2. Comandos Artisan (lógica de negocio)</h2>
                </div>
                <div class="card-body">
                    <div class="grid-2">
                        <div class="inner-card"><span class="badge-label">Inicialización</span>
                            <h3>db:clonar-historial</h3>
                            <p>Clona histórico de empleados con ingreso anterior a 7 días a
                                <code>history_employees</code> y mueve los recientes a <code>new_employees</code>.
                            </p>
                        </div>
                        <div class="inner-card"><span class="badge-label">Sincronización diaria</span>
                            <h3>employees:sync-new</h3>
                            <p>Sincroniza nuevos empleados desde AX a <code>new_employees</code> evitando duplicados con
                                el histórico.</p>
                        </div>
                        <div class="inner-card"><span class="badge-label">Bienvenida corporativa</span>
                            <h3>app:process-monday-new-employees</h3>
                            <p>Envía correo masivo de bienvenida los lunes y mueve los empleados a
                                <code>history_employees</code>.
                            </p>
                        </div>
                        <div class="inner-card"><span class="badge-label">Reporte RTHH</span>
                            <h3>app:send-friday-hr-report</h3>
                            <p>Notifica a RTHH los nuevos ingresos (o sin novedades) cada viernes.</p>
                        </div>
                        <div class="inner-card"><span class="badge-label">Cumpleaños + frases</span>
                            <h3>app:send-daily-birthdays</h3>
                            <p>Diario a las 7:00 AM: felicitaciones o mensaje motivacional. Verifica quórum (mínimo 550
                                registros).</p>
                        </div>
                        <div class="inner-card"><span class="badge-label">Desarrollo</span>
                            <h3>dev:run</h3>
                            <p>Lanza <code>serve</code> y <code>schedule:work</code> simultáneamente.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. SCHEDULE -->
            <section id="schedule" class="section-card">
                <div class="card-header">
                    <i class="fas fa-clock"></i>
                    <h2>3. Programador de tareas (Laravel Scheduler)</h2>
                </div>
                <div class="card-body">
                    <p class="text-gray-600 mb-4">Automatización con pausas controlables vía API.</p>
                    <div class="grid-2">
                        <div class="inner-card">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-birthday-cake text-pink-500 text-xl"></i>
                                <h3 class="font-mono font-bold text-sky-800">app:send-daily-birthdays</h3>
                            </div>
                            <p><strong>Horario:</strong> Diario 07:00</p>
                            <p><strong>Control de pausa:</strong> <code>birthdays_paused</code></p>
                        </div>
                        <div class="inner-card">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-chart-line text-purple-500 text-xl"></i>
                                <h3 class="font-mono font-bold text-sky-800">app:send-friday-hr-report</h3>
                            </div>
                            <p><strong>Horario:</strong> Viernes 16:40</p>
                            <p><strong>Control de pausa:</strong> <code>new_employees_friday_paused</code></p>
                        </div>
                        <div class="inner-card">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-users text-emerald-600 text-xl"></i>
                                <h3 class="font-mono font-bold text-sky-800">app:process-monday-new-employees</h3>
                            </div>
                            <p><strong>Horario:</strong> Lunes 09:00</p>
                            <p><strong>Control de pausa:</strong> <code>new_employees_monday_paused</code></p>
                        </div>
                        <div class="inner-card">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-sync-alt text-blue-500 text-xl"></i>
                                <h3 class="font-mono font-bold text-sky-800">employees:sync-new</h3>
                            </div>
                            <p><strong>Horario:</strong> Diario a las 07:00 y 16:35 (sin solapamiento)</p>
                            <p><strong>Control de pausa:</strong> —</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg mt-4 text-sm shadow-inner"><i
                            class="fas fa-pause-circle text-amber-600"></i> Las pausas se activan/desactivan desde la
                        API (endpoints de administrador).</div>
                </div>
            </section>

            <!-- 4. MIGRACIONES -->
            <section id="migraciones" class="section-card">
                <div class="card-header">
                    <i class="fas fa-database"></i>
                    <h2>4. Migraciones (estructura de datos)</h2>
                </div>
                <div class="card-body">
                    <div class="grid-2">
                        <div class="inner-card"><i
                                class="fas fa-envelope-open-text text-emerald-600 text-xl mr-2"></i>
                            <h3 class="font-semibold">Plantillas editables</h3>
                            <p class="text-sm">birthday_configs, no_birthday_configs, new_employee_report_configs,
                                reportes TH.</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-globe-americas text-sky-500 text-xl mr-2"></i>
                            <h3 class="font-semibold">Catálogos geográficos</h3>
                            <p class="text-sm">countries, branches (relación país - sucursal).</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-users text-purple-600 text-xl mr-2"></i>
                            <h3 class="font-semibold">Control histórico y sala de espera</h3>
                            <p class="text-sm">history_employees (enviados), new_employees (pendientes).</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-quote-right text-yellow-600 text-xl mr-2"></i>
                            <h3 class="font-semibold">Frases motivacionales</h3>
                            <p class="text-sm">messages (366 frases rotativas).</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs text-gray-500">Todas incluyen timestamps e índices.
                            <code>history_employees</code> guarda fecha_envio.
                        </p>
                        <div class="bg-gray-50 p-3 rounded-lg text-sm mt-3 shadow-sm"><i class="fas fa-terminal"></i>
                            Ejecutar migraciones: <code>php artisan migrate</code></div>
                    </div>
                </div>
            </section>

            <!-- 5. SEMILLAS -->
            <section id="semillas" class="section-card">
                <div class="card-header">
                    <i class="fas fa-seedling"></i>
                    <h2>5. Datos iniciales (Seeders)</h2>
                </div>
                <div class="card-body">
                    <div class="grid-2">
                        <div class="inner-card"><i class="fas fa-flag text-blue-500 mr-2"></i>
                            <h3 class="font-semibold">Países</h3>
                            <p class="text-sm">Nicaragua, Costa Rica, Honduras, Guatemala, El Salvador, Colombia,
                                Panamá.</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-building text-indigo-500 mr-2"></i>
                            <h3 class="font-semibold">Sucursales</h3>
                            <p class="text-sm">ORBE (CEO, CEON, CEOP, CEOC, CEOH, CEOS, CEOG), ATI, NOVA, SISCON.</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-file-alt text-amber-500 mr-2"></i>
                            <h3 class="font-semibold">Plantillas por defecto</h3>
                            <p class="text-sm">Banners, textos, firmas para todos los correos.</p>
                        </div>
                        <div class="inner-card"><i class="fas fa-smile-wink text-pink-500 mr-2"></i>
                            <h3 class="font-semibold">366 frases motivacionales</h3>
                            <p class="text-sm">Rotación en días sin cumpleaños y reportes.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-50 p-3 rounded-lg text-sm shadow-sm"><i class="fas fa-terminal"></i>
                            Ejecutar: <code>php artisan migrate --seed</code></div>
                    </div>
                </div>
            </section>

            <!-- 6. API REST -->
            <section id="api" class="section-card">
                <div class="card-header">
                    <i class="fas fa-plug"></i>
                    <h2>6. API REST (v1)</h2>
                    <span class="api-subtitle">Base: <code>/api/v1</code> · Sanctum + LDAP · JSON</span>
                </div>
                <div class="card-body overflow-x-auto">
                    <table class="api-table">
                        <thead>
                            <tr>
                                <th>Acceso</th>
                                <th>Método</th>
                                <th>Endpoint</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-public">
                                <td class="font-semibold text-green-700">Público</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/login</code></td>
                                <td>Autenticación con LDAP, retorna token Sanctum.</td>
                            </tr>
                            <tr class="bg-public">
                                <td class="font-semibold text-green-700">Público</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/documentacion</code></td>
                                <td>Muestra esta documentación en HTML.</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="font-semibold bg-gray-100">🔐 Autenticado (requiere token)
                                </td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/user</code></td>
                                <td>Perfil del usuario autenticado.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/logout</code></td>
                                <td>Revocar token actual.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/users</code></td>
                                <td>Listado de usuarios (solo admin puede verlo).</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/history-employees</code></td>
                                <td>Historial de empleados notificados.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/new-employees</code></td>
                                <td>Lista de sala de espera.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/new-employees/count</code></td>
                                <td>Conteo de nuevos empleados pendientes.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/new-employees/{newEmployee}</code></td>
                                <td>Detalle de un nuevo empleado.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/employees</code></td>
                                <td>Lista de empleados externos (AX).</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/employees/{employee}</code></td>
                                <td>Ver empleado externo.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/branches</code></td>
                                <td>Lista de sucursales.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/branches/{branch}</code></td>
                                <td>Ver sucursal específica.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/countries</code></td>
                                <td>Lista de países.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/countries/{country}</code></td>
                                <td>Ver país específico.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/status</code></td>
                                <td>Estado de pausa de cumpleaños.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/new-employees-friday-status</code></td>
                                <td>Estado pausa reporte viernes.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/new-employees-monday-status</code></td>
                                <td>Estado pausa proceso lunes.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/birthday</code></td>
                                <td>Ver plantilla cumpleaños.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/no-birthday</code></td>
                                <td>Ver plantilla día sin cumpleaños.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/new-employee-report</code></td>
                                <td>Ver plantilla bienvenida general.</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/new-employee-report-TH</code></td>
                                <td>Ver plantilla reporte TH (con novedades).</td>
                            </tr>
                            <tr class="bg-authenticated">
                                <td>Autenticado</td>
                                <td><span class="badge-method bg-get">GET</span></td>
                                <td><code>/settings/no-new-employee-report-TH</code></td>
                                <td>Ver plantilla reporte TH (sin novedades).</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="font-semibold bg-gray-100">🛡️ Solo administrador
                                    (middleware admin)</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/register</code></td>
                                <td>Crear nuevo usuario.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-patch">PATCH</span></td>
                                <td><code>/users/{user}</code></td>
                                <td>Actualizar usuario.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-patch">PATCH</span></td>
                                <td><code>/users/status/{user}</code></td>
                                <td>Activar/inactivar cuenta.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/new-employees/sync</code></td>
                                <td>Sincronización manual nuevos empleados.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/toggle-pause</code></td>
                                <td>Pausar/reanudar envío de cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/run-manual-send</code></td>
                                <td>Envío manual cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employees-friday/toggle</code></td>
                                <td>Pausar reporte viernes.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employees-friday/run</code></td>
                                <td>Ejecutar reporte viernes manual.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employees-monday/toggle</code></td>
                                <td>Pausar proceso lunes.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employees-monday/run</code></td>
                                <td>Ejecutar bienvenida manual.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-put">PUT</span></td>
                                <td><code>/settings/birthday</code></td>
                                <td>Actualizar plantilla cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/birthday/restore</code></td>
                                <td>Restaurar plantilla cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-put">PUT</span></td>
                                <td><code>/settings/no-birthday</code></td>
                                <td>Actualizar plantilla día sin cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/no-birthday/restore</code></td>
                                <td>Restaurar plantilla día sin cumpleaños.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-put">PUT</span></td>
                                <td><code>/settings/new-employee-report</code></td>
                                <td>Actualizar plantilla bienvenida.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employee-report/restore</code></td>
                                <td>Restaurar plantilla bienvenida.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-put">PUT</span></td>
                                <td><code>/settings/new-employee-report-TH</code></td>
                                <td>Actualizar plantilla reporte TH.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/new-employee-report-TH/restore</code></td>
                                <td>Restaurar plantilla reporte TH.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-put">PUT</span></td>
                                <td><code>/settings/no-new-employee-report-TH</code></td>
                                <td>Actualizar plantilla reporte sin novedades.</td>
                            </tr>
                            <tr class="bg-admin">
                                <td>Admin</td>
                                <td><span class="badge-method bg-post">POST</span></td>
                                <td><code>/settings/no-new-employee-report-TH/restore</code></td>
                                <td>Restaurar plantilla reporte sin novedades.</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-xs text-gray-500 mt-4 pt-3 border-t"><i
                            class="fas fa-info-circle text-sky-500"></i> Todos los endpoints de administrador requieren
                        rol <code>admin</code> y están protegidos por middleware.</p>
                </div>
            </section>
        </main>
    </div>

    <footer class="bg-white border-t mt-12 py-6 text-center text-gray-500 text-sm shadow-inner">
        <p>© 2026 OBGROUP SYSTEM • Gestión Corporativa Global</p>
    </footer>
</body>

</html>
