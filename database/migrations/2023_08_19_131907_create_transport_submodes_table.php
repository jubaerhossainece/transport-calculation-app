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
        Schema::create('transport_submodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_mode_id')
                    ->constrained(table: 'transport_modes', indexName: 'transport_submodes_transport_mode_id')
                    ->onUpdate('cascade');

            $table->string('name');
            $table->decimal('cost_per_km', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_submodes');
    }
};
