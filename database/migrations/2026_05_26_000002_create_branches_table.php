<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->string('code', 10)->primary(); // VARCHAR(10) PRIMARY KEY
            $table->string('company_name', 255);

            // Relación con países (Llave Foránea)
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');

            $table->boolean('estado')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
