<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('new_employee_report_configs', function (Blueprint $table) {
            $table->id();
            $table->string('banner_url');
            $table->text('intro_text');
            $table->text('main_body');
            $table->text('closing_text');
            $table->string('sign_off');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('new_employee_report_configs');
    }
};
