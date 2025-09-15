<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sede_id')->constrained('sedes')->cascadeOnDelete();
            $table->foreignId('encargado_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('titulo');
            $table->enum('prioridad', ['alta', 'media', 'baja']);
            $table->enum('tipo', ['mantenimiento', 'presupuesto', 'instalacion']);
            $table->enum('estado', ['pendiente','finalizada','validada','rechazada']);
            $table->text('descripcion',);
            $table->date('fecha_creacion');
            $table->date('fecha_estimada')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->foreignId('tecnico_id')->nullable()->constrained('users')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
