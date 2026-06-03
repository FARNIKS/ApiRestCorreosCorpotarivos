<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalEmployee extends Model
{
    protected $connection = 'sqlsrvax';

    protected $table = 'AX_Usuarios_Cumple';

    public $timestamps = false;

    protected $primaryKey = 'Cedula';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'Cumple'        => 'datetime',
        'Fecha_Ingreso' => 'datetime',
    ];


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'Empresa', 'code');
    }
}
