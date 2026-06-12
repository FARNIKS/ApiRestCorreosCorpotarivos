# OBGROUP HR Automation API

API REST especializada construida con Laravel para automatizar flujos de trabajo críticos de comunicación en TH. Su objetivo principal es sincronizar datos de empleados desde un sistema ERP Dynamics AX externo y activar notificaciones automáticas para cumpleaños de empleados y hitos de incorporación de nuevos empleados.

## Características Principales

- **Sincronización de Empleados**: Espejo periódico de datos desde el ERP Dynamics AX (conexión `sqlsrvax`) a la base de datos local
- **Notificaciones de Cumpleaños**: Consulta diaria de cumpleaños desde AX, agrupa por país y compañía, y envía correos celebratorios
- **Bienvenida de Nuevos Empleados**: Proceso de dos etapas que identifica nuevos empleados los viernes para vista previa de TH y envía reporte formal de bienvenida institucional los lunes

## Stack Tecnológico

- **Framework**: Laravel 12.x
- **Bases de Datos**:
    - SQL Server (`sqlsrvax`): Conexión de solo lectura al ERP Dynamics AX
    - SQLite/SQL Server: Base de datos local para configuración y gestión de usuarios
- **Autenticación**:
    - Sanctum: Seguridad basada en tokens para acceso a la API
    - LDAP: Integración para validación de credenciales corporativas durante el login
- **Programación de Tareas**: Facade `Schedule` de Laravel, ejecutado vía `laravel_cron.bat` en entornos Windows

## Instalación

### Requisitos Previos

- PHP 8.x o superior
- Composer
- SQL Server (para conexión AX)
- Servidor LDAP corporativo

### Configuración

1. Clonar el repositorio
2. Instalar dependencias:

```
composer install
```

3. Configurar archivo `.env` con las siguientes variables:

**Base de datos AX:**

```
DB_HOST_AX=IP_DEL_SERVIDOR_AX
DB_DATABASE_AX=Desarrollo_CRM_AX
DB_USERNAME_AX=usuario_consulta
DB_PASSWORD_AX=********
```

**LDAP Active Directory:**

```
LDAP_HOST="IP_CONTROLADOR_DOMINIO"
LDAP_USER='DOMINIO\usuario_lectura'
LDAP_PASSWORD="********"
```

**Correo SMTP (Office365):**

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=tu_correo@office365.com
MAIL_PASSWORD=contraseña_de_aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_correo@office365.com
MAIL_FROM_NAME="Notificaciones OBGROUP"
```

4. Ejecutar migraciones y seeders:

```
php artisan migrate --seed
```

## Comandos Artisan Disponibles

|Comando|Descripción|
|---|---|
|`db:clonar-historial`|Clona histórico de empleados con ingreso anterior a 7 días a `history_employees` y mueve los recientes a `new_employees`|
|`dev:run`|Lanza `serve` y `schedule:work` simultáneamente|
|`employees:sync-new`|Sincroniza nuevos empleados desde AX a `new_employees` evitando duplicados con el histórico|
|`app:process-monday-new-employees`|Envía correo masivo de bienvenida los lunes y mueve los empleados a `history_employees`|
|`app:send-friday-hr-report`|Notifica a TH los nuevos ingresos (o sin novedades) cada viernes|
|`app:send-daily-birthdays`|Diario a las 7:00 AM: felicitaciones o mensaje motivacional. Verifica quórum (mínimo 550 registros)|

## Programador de Tareas

El sistema utiliza el programador de Laravel con la siguiente configuración:

|Tarea|Horario|Control de Pausa|
|---|---|---|
|`app:send-daily-birthdays`|Diario 07:00|`birthdays_paused`|
|`app:send-friday-hr-report`|Viernes 16:40|`new_employees_friday_paused`|
|`app:process-monday-new-employees`|Lunes 09:00|`new_employees_monday_paused`|
|`employees:sync-new`|Diario 07:00 y 16:35|—|

Las pausas se activan/desactivan desde la API (endpoints de administrador).

## API REST

Base URL: `/api/v1`

### Endpoints Públicos

|Método|Endpoint|Descripción|
|---|---|---|
|POST|`/login`|Autenticación con LDAP, retorna token Sanctum|
|GET|`/documentacion`|Muestra la documentación en HTML|

### Endpoints Autenticados (requieren token)

|Método|Endpoint|Descripción|
|---|---|---|
|GET|`/user`|Perfil del usuario autenticado|
|POST|`/logout`|Revocar token actual|
|GET|`/users`|Listado de usuarios (solo admin)|
|GET|`/history-employees`|Historial de empleados notificados|
|GET|`/new-employees`|Lista de sala de espera|
|GET|`/new-employees/count`|Conteo de nuevos empleados pendientes|
|GET|`/new-employees/{newEmployee}`|Detalle de un nuevo empleado|
|GET|`/employees`|Lista de empleados externos (AX)|
|GET|`/employees/{employee}`|Ver empleado externo|
|GET|`/branches`|Lista de sucursales|
|GET|`/branches/{branch}`|Ver sucursal específica|
|GET|`/countries`|Lista de países|
|GET|`/countries/{country}`|Ver país específico|

### Endpoints de Configuración

|Método|Endpoint|Descripción|
|---|---|---|
|GET|`/settings/status`|Estado de pausa de cumpleaños|
|GET|`/settings/new-employees-friday-status`|Estado pausa reporte viernes|
|GET|`/settings/new-employees-monday-status`|Estado pausa proceso lunes|
|GET|`/settings/birthday`|Ver plantilla cumpleaños|
|GET|`/settings/no-birthday`|Ver plantilla día sin cumpleaños|
|GET|`/settings/new-employee-report`|Ver plantilla bienvenida general|
|GET|`/settings/new-employee-report-rh`|Ver plantilla reporte TH (con novedades)|
|GET|`/settings/no-new-employee-report-rh`|Ver plantilla reporte TH (sin novedades)|

### Endpoints de Administrador (requieren rol admin)

Estos endpoints permiten gestionar usuarios, sincronizaciones manuales, pausar/reanudar tareas y actualizar plantillas de correo.

## Estructura de Datos

### Migraciones Principales

- **Plantillas editables**: `birthday_configs`, `no_birthday_configs`, `new_employee_report_configs`, reportes TH
- **Catálogos geográficos**: `countries`, `branches` (relación país - sucursal)
- **Control histórico**: `history_employees` (enviados), `new_employees` (pendientes)
- **Frases motivacionales**: `messages` (366 frases rotativas)

### Seeders

- **Países**: Nicaragua, Costa Rica, Honduras, Guatemala, El Salvador, Colombia, Panamá
- **Sucursales**: ORBE (CEO, CEON, CEOP, CEOC, CEOH, CEOS, CEOG), ATI, NOVA, SISCON
- **Plantillas por defecto**: Banners, textos, firmas para todos los correos
- **366 frases motivacionales**: Rotación en días sin cumpleaños y reportes

## Documentación

Para ver la documentación completa en formato HTML, accede a `/api/v1/documentacion` después de iniciar el servidor.

## Licencia

© 2026 OBGROUP SYSTEM • Gestión Corporativa Global
