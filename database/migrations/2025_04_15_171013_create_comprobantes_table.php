<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();
            $table->string('clave',50);
            $table->string('consecutivo',20);
            $table->string('estado',20);
            $table->string('cedula',15);
            $table->string('nombre',100);
            $table->string('url_carpeta',100);
            $table->string('url_firmado',100);
            $table->string('url_respuesta',100);
            $table->string('url_pdf',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprobantes');
    }
};
