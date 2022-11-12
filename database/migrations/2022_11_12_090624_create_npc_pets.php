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
        Schema::create('npc_pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->string('food1');
            $table->string('food2');
            $table->string('autoFeedLimit');
            $table->string('hungryLimit');
            $table->string('unsummonLimit');
            $table->timestamps();
            $table->comment('NPC - Питомцы');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npc_pets');
    }
};
