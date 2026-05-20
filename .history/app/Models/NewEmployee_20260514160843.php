<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;


class NewEmployee extends Model
{
    use HasFactory;

    protected $table = "new_employees";

    protected $fillable = [
        'nombre',
        'departamento',
        'empresa_code',
        'enviado',
    ];

    protected $casts = [
        'enviado' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'empresa_code', 'code');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'departamento', 'Departamento');
    }

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? mb_convert_case($value, MB_CASE_TITLE, "UTF-8") : '',
            set: fn(?string $value) => $value ? mb_strtoupper($value, "UTF-8") : '',
        );
    }
}
