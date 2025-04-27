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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->string('cliente');
            $table->string('producto');
            $table->string('debe');
            $table->string('abono');
            $table->string('costoC');            
            $table->string('costoP');
            $table->softDeletes(); // Agrega la columna deleted_at
            #$table->string('proveedorCarne');
            #$table->string('costoCarne');
            #$table->string('proveedorQueso');
            #$table->string('costoQueso');
            
            $table->timestamps();

            #$table->decimal('amount', total: 8, places: 2);
            #$table->string('name', length: 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
