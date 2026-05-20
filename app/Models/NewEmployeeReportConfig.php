<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmployeeReportConfig extends Model
{
    use HasFactory;

    protected $table = 'new_employee_report_configs';

    protected $fillable = [
        'banner_url',
        'intro_text',
        'main_body',
        'closing_text',
        'sign_off'
    ];
}
