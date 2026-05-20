<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('no_new_employee_report_rh_configs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('intro_text');
            $table->text('closing_text');
            $table->string('sign_off');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('no_new_employee_report_rh_configs');
    }
};
