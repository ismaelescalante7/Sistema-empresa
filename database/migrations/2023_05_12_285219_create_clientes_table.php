<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_nombre');
            $table->foreignId('tipo_documento_id')
                ->constrained('tipo_documentos');
            $table->string('numero_documento');
            $table->string('domicilio');
            $table->foreignId('provincia_id')
                ->constraint('provincia');
            $table->foreignId('departamento_id')
                ->constraint('departamentos');
            $table->foreignId('localidad_id')
                ->constraint('localidades');
            $table->string('telefono');
            $table->string('celular')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
