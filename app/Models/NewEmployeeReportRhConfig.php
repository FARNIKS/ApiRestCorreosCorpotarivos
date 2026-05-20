<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmployeeReportRhConfig extends Model
{
    use HasFactory;

    protected $table = 'new_employee_report_rh_configs';

    protected $fillable = [
        'title',
        'intro_text',
        'closing_text',
        'sign_off'
    ];
}
