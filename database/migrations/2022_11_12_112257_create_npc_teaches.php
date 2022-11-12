<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('npc_teaches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->string('classes');
            $table->timestamps();
            $table->comment('NPC - TEACHES');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npc_teaches');
    }
};
