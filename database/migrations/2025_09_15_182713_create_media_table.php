<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // Relación con cualquier modelo (en este caso Tarea)
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            
            // Nombre de la colección: 'imagenes' o 'documentos'
            $table->string('collection_name');
            
            $table->string('conversions_disk')->nullable();
            $table->uuid('uuid')->nullable();
            $table->string('name');        // nombre original
            $table->string('file_name');   // nombre en disco
            $table->string('mime_type')->nullable();
            $table->string('disk');        // disco usado, ej. 'tareas_media'
            $table->unsignedBigInteger('size');
            $table->json('manipulations')->nullable();
            $table->json('custom_properties')->nullable();
            $table->json('generated_conversions')->nullable();
            $table->json('responsive_images')->nullable();
            $table->unsignedInteger('order_column')->nullable();
            $table->nullableTimestamps();

            $table->index(['model_type','model_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
