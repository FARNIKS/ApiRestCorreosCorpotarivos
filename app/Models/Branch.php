<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'branches';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'company_name',
        'country_id',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'Empresa', 'code');
    }

    public function externalEmployees(): HasMany
    {
        return $this->hasMany(ExternalEmployee::class, 'Empresa', 'code');
    }

    public function newEmployees(): HasMany
    {
        return $this->hasMany(NewEmployee::class, 'empresa_code', 'code');
    }
}
