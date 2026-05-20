<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Employee extends Model
{

    protected $connection = 'sqlsrvax';

    protected $table = 'AX_Usuarios_Cumple';

    public $timestamps = false;

    protected $casts = [
        'Cumple' => 'datetime',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'Empresa', 'code');
    }

    public function newEmployees(): HasMany
    {
        return $this->hasMany(NewEmployee::class, 'departamento', 'Departamento');
    }

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? mb_convert_case($value, MB_CASE_TITLE, "UTF-8") : '',
            set: fn(?string $value) => $value ? mb_strtoupper($value, "UTF-8") : '',
        );
    }
}
