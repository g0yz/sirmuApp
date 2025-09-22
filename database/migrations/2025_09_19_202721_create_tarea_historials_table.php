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
    Schema::create('tarea_historials', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
        $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // técnico o auditor
        $table->string('accion'); // 'finalizada', 'validada', 'rechazada'
        $table->text('observacion')->nullable(); // comentario del auditor
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_historials');
    }
};
