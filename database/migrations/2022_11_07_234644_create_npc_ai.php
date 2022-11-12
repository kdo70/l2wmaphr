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
        Schema::create('npc_ai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->string('type');
            $table->string('ssCount');
            $table->string('ssRate');
            $table->string('spsCount');
            $table->string('spsRate');
            $table->string('aggro')->nullable();
            $table->string('clan')->nullable();
            $table->string('clanRange')->nullable();
            $table->string('ignoredIds')->nullable();
            $table->string('canMove');
            $table->string('seedable');
            $table->timestamps();
            $table->comment('NPC - Искусственный интеллект');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npc_ai');
    }
};
